<?php
require_once __DIR__ . '/db.php';

function startSession() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
        $_SESSION['last_activity'] = time();
    }
}

function redirect($url, $statusCode = 303) {
    header('Location: ' . $url, true, $statusCode);
    exit;
}

function sanitizeInput($data) {
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function hashPassword($password) {
    return password_hash($password, PASSWORD_BCRYPT, ['cost' => PASSWORD_COST]);
}

function verifyPassword($password, $hash) {
    return password_verify($password, $hash);
}

function checkAuth() {
    startSession();
    if (empty($_SESSION['user_id'])) {
        redirect('/login.php');
    }
    
    // Vérification du timeout
    if (time() - $_SESSION['last_activity'] > SESSION_TIMEOUT) {
        session_unset();
        session_destroy();
        redirect('/login.php?timeout=1');
    }
    
    $_SESSION['last_activity'] = time();
}

function logActivity($action, $userId = null) {
    $log = sprintf(
        "[%s] %s: %s %s\n",
        date('Y-m-d H:i:s'),
        $userId ?? 'guest',
        $action,
        $_SERVER['REMOTE_ADDR']
    );
    file_put_contents(LOG_DIR.'/activity.log', $log, FILE_APPEND);
}

function getUserData($userId) {
    global $connex;
    $stmt = $connex->prepare("SELECT id, first_name, last_name, email, role, last_login FROM users WHERE id = ?");
    $stmt->execute([$userId]);
    return $stmt->fetch();
}
?>