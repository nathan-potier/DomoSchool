<?php
require_once __DIR__ . '/../includes/functions.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('../vue/auth/register.php');
}

// Vérification du code d'accès
$access_code = sanitizeInput($_POST['access_code'] ?? '');
$check_result = check_access_code($access_code); // ['valid' => true, 'role' => 'student']

if (!$check_result['valid']) {
    $message = $check_result['message'] ?? 'Code invalide ou déjà utilisé';
    $_SESSION['old_inputs'] = $_POST;
    redirect('../vue/auth/register.php?error=' . urlencode($message));
}

$role = $check_result['role'];

$data = [
    'access_code' => $access_code,
    'first_name' => sanitizeInput($_POST['first_name'] ?? ''),
    'last_name' => sanitizeInput($_POST['last_name'] ?? ''),
    'email' => sanitizeInput($_POST['email'] ?? ''),
    'password' => $_POST['password'] ?? '',
    'password_confirm' => $_POST['password_confirm'] ?? '',
    'role' => $role
];

if (in_array('', $data)) {
    $_SESSION['old_inputs'] = $data;
    redirect('../vue/auth/register.php?error=Tous les champs sont obligatoires');
}

if (!validateEmail($data['email'])) {
    $data['email'] = ''; 
    $_SESSION['old_inputs'] = $data;
    redirect('../vue/auth/register.php?error=Email invalide');
}

if ($data['password'] !== $data['password_confirm']) {
    $data['password'] = ''; 
    $data['password_confirm'] = '';
    $_SESSION['old_inputs'] = $data;
    redirect('../vue/auth/register.php?error=Les mots de passe ne correspondent pas');
}

if (strlen($data['password']) < 8) {
    $data['password'] = ''; 
    $data['password_confirm'] = '';
    $_SESSION['old_inputs'] = $data;
    redirect('../vue/auth/register.php?error=Le mot de passe doit faire au moins 8 caractères');
}

try {
    $connex = Database::getInstance()->getConnection();

    $stmt = $connex->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$data['email']]);

    if ($stmt->fetch()) {
        $data['email'] = ''; // on vide l'email seulement dans ce cas
        $_SESSION['old_inputs'] = $data;
        redirect('../vue/auth/register.php?error=Cet email est déjà utilisé');
    }

    $connex->beginTransaction();

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

    if ($data['role'] === 'student') {
        $stmt = $connex->prepare("INSERT INTO student_stats (student_id) VALUES (?)");
        $stmt->execute([$userId]);
    }

    $stmt = $connex->prepare("UPDATE access_codes SET used = TRUE, used_at = NOW() WHERE code = ?");
    $stmt->execute([$data['access_code']]);

    $connex->commit();

    logActivity('user_register', $userId);

    $_SESSION['user_id'] = $userId;
    $_SESSION['role'] = $data['role'];
    $_SESSION['email'] = $data['email'];

    unset($_SESSION['old_inputs']);

    redirect('../vue/index.php?success=Votre compte a été créé et vous êtes maintenant connecté.');

} catch (PDOException $e) {
    if (isset($connex) && $connex->inTransaction()) {
        $connex->rollBack();
    }
    error_log('Registration Error: ' . $e->getMessage());
    die("Erreur détaillée: " . $e->getMessage());
}
