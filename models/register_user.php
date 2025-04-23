<?php
require_once __DIR__ . '/../includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('../vue/auth/register.php');
}

// Vérification du code d'accès
$access_code = sanitizeInput($_POST['access_code'] ?? '');
$check_result = check_access_code($access_code); // ['valid' => true, 'role' => 'student']

if (!$check_result['valid']) {
    $message = $check_result['message'] ?? 'Code invalide ou déjà utilisé';
    redirect('../vue/auth/register.php?error=' . urlencode($message));
}

// Assignation automatique du rôle basé sur le code d'accès
$role = $check_result['role'];

// Récupération des données du formulaire
$data = [
    'access_code' => $access_code,
    'first_name' => sanitizeInput($_POST['first_name'] ?? ''),
    'last_name' => sanitizeInput($_POST['last_name'] ?? ''),
    'email' => sanitizeInput($_POST['email'] ?? ''),
    'password' => $_POST['password'] ?? '',
    'password_confirm' => $_POST['password_confirm'] ?? '',
    'role' => $role
];

// Validation des champs
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
    // Connexion à la base de données
    $connex = Database::getInstance()->getConnection();
    
    // Vérification de l'unicité de l'email
    $stmt = $connex->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$data['email']]);
    
    if ($stmt->fetch()) {
        redirect('../vue/auth/register.php?error=Cet email est déjà utilisé');
    }

    // Démarrage de la transaction
    $connex->beginTransaction();

    // Insertion de l'utilisateur
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

    // Marquage du code d'accès comme utilisé
    $stmt = $connex->prepare("UPDATE access_codes SET used = TRUE, used_at = NOW() WHERE code = ?");
    $stmt->execute([$data['access_code']]);

    // Si l'utilisateur est un étudiant, création des statistiques
    if ($data['role'] === 'student') {
        $stmt = $connex->prepare("INSERT INTO student_stats (student_id) VALUES (?)");
        $stmt->execute([$userId]);
    }

    // Commit de la transaction
    $connex->commit();

    // Log de l'activité
    logActivity('user_register', $userId);

    // Démarrer la session et connecter l'utilisateur
    session_start(); // Démarre la session
    $_SESSION['user_id'] = $userId;  // Stocke l'ID utilisateur dans la session
    $_SESSION['role'] = $data['role']; // Stocke le rôle de l'utilisateur dans la session
    $_SESSION['email'] = $data['email']; // Stocke l'email dans la session

    // Redirection vers la page d'accueil avec succès
    redirect('../vue/index.php?success=Votre compte a été créé et vous êtes maintenant connecté.');

} catch (PDOException $e) {
    if (isset($connex) && $connex->inTransaction()) {
        $connex->rollBack();
    }
    // Log de l'erreur
    error_log('Registration Error: ' . $e->getMessage());
    die("Erreur détaillée: " . $e->getMessage()); // ⚠️ à retirer en prod
}
?>
