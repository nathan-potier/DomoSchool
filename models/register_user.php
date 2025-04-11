<?php
require_once __DIR__ . '/../includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('../vue/register.php');
}

// Récupération et validation
$data = [
    'first_name' => sanitizeInput($_POST['first_name'] ?? ''),
    'last_name' => sanitizeInput($_POST['last_name'] ?? ''),
    'email' => sanitizeInput($_POST['email'] ?? ''),
    'password' => $_POST['password'] ?? '',
    'password_confirm' => $_POST['password_confirm'] ?? ''
];

// Validation
if (empty($data['first_name']) || empty($data['last_name']) || empty($data['email']) || empty($data['password']) || empty($data['password_confirm'])) {
    redirect('../vue/register.php?error=Tous les champs sont obligatoires');
}

if (!validateEmail($data['email'])) {
    redirect('../vue/register.php?error=Email invalide');
}

if ($data['password'] !== $data['password_confirm']) {
    redirect('../vue/register.php?error=Les mots de passe ne correspondent pas');
}

if (strlen($data['password']) < 8) {
    redirect('../vue/register.php?error=Le mot de passe doit faire au moins 8 caractères');
}

try {
    $connex = Database::getInstance()->getConnection();
    
    // Vérification email existant
    $stmt = $connex->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$data['email']]);
    
    if ($stmt->fetch()) {
        redirect('../vue/register.php?error=Cet email est déjà utilisé');
    }
    
    // Insertion
    $stmt = $connex->prepare("
    INSERT INTO users (first_name, last_name, email, password, role, last_login) 
    VALUES (?, ?, ?, ?, 'student', NULL)
    ");
    
    $stmt->execute([
        $data['first_name'],
        $data['last_name'],
        $data['email'],
        hashPassword($data['password'])
    ]);
    
    logActivity('user_register', $connex->lastInsertId());
    redirect('../vue/index.php?success=Votre compte a été créé');
    
} catch (PDOException $e) {
    error_log('Registration Error: '.$e->getMessage());
    redirect('../vue/register.php?error=Erreur système. Veuillez réessayer');
}

?>