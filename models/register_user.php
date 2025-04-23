<?php
require_once __DIR__ . '/../includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('../vue/auth/register.php');
}

// Récupération et validation
$data = [
    'access_code' => sanitizeInput($_POST['access_code'] ?? ''),
    'first_name' => sanitizeInput($_POST['first_name'] ?? ''),
    'last_name' => sanitizeInput($_POST['last_name'] ?? ''),
    'email' => sanitizeInput($_POST['email'] ?? ''),
    'password' => $_POST['password'] ?? '',
    'password_confirm' => $_POST['password_confirm'] ?? '',
    'role' => $_POST['role'] ?? ''
];

// Validation
if (empty($data['access_code']) || empty($data['first_name']) || empty($data['last_name']) || 
    empty($data['email']) || empty($data['password']) || empty($data['password_confirm']) || empty($data['role'])) {
    redirect('../vue/auth/register.php?error=Tous les champs sont obligatoires');
}

if (!validateEmail($data['email'])) {
    redirect('../vue/auth/register.php?error=Email invalide');
}

if ($data['password'] !== $data['password_confirm']) {
    redirect('../vue/auth/register.php?error=Les mots de passe ne correspondent pas');
}

if (strlen($data['password']) < 8) {
    redirect('../vue/auth/register.php?error=Le mot de passe doit faire au moins 8 caractères');
}

try {
    $connex = Database::getInstance()->getConnection();
    
    // Vérifier que le code est valide et non utilisé
    $stmt = $connex->prepare("SELECT id FROM access_codes WHERE code = ? AND used = FALSE");
    $stmt->execute([$data['access_code']]);
    
    if (!$stmt->fetch()) {
        redirect('../vue/auth/register.php?error=Code invalide ou déjà utilisé');
    }
    
    // Vérification email existant
    $stmt = $connex->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$data['email']]);
    
    if ($stmt->fetch()) {
        redirect('../vue/auth/register.php?error=Cet email est déjà utilisé');
    }
    
    // Commencer une transaction
    $connex->beginTransaction();
    
    // Insérer l'utilisateur
    $stmt = $connex->prepare("
    INSERT INTO users (first_name, last_name, email, password, role, last_login) 
    VALUES (?, ?, ?, ?, ?, NULL)
    ");
    
    $stmt->execute([
        $data['first_name'],
        $data['last_name'],
        $data['email'],
        hashPassword($data['password']),
        $data['role']
    ]);
    
    $userId = $connex->lastInsertId();
    
    // Marquer le code comme utilisé
    $stmt = $connex->prepare("UPDATE access_codes SET used = TRUE, used_at = NOW() WHERE code = ?");
    $stmt->execute([$data['access_code']]);
    
    // Créer des stats si c'est un élève
    if ($data['role'] === 'student') {
        $stmt = $connex->prepare("INSERT INTO student_stats (student_id) VALUES (?)");
        $stmt->execute([$userId]);
    }
    
    // Valider la transaction
    $connex->commit();
    
    logActivity('user_register', $userId);
    redirect('../vue/auth/index.php?success=Votre compte a été créé');
    
} catch (PDOException $e) {
    if(isset($connex) && $connex->inTransaction()) {
        $connex->rollBack();
    }
    // Ajoutez ceci pour voir l'erreur précise
    $errorMsg = 'Registration Error: '.$e->getMessage();
    error_log($errorMsg);
    
    // Affichez l'erreur complète temporairement (à enlever en production)
    die("Erreur détaillée: " . $errorMsg);
    
    redirect('../vue/auth/register.php?error=Erreur système. Veuillez réessayer');
}
?>