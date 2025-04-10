<?php
// Configuration de l'application
define('APP_ENV', 'development'); // 'production' en live
define('APP_DEBUG', true);

// Chemins absolus
define('ROOT_DIR', __DIR__ . '/..');
define('LOG_DIR', ROOT_DIR . '/logs');
define('UPLOAD_DIR', ROOT_DIR . '/uploads');

// Base de données
define('DB_HOST', 'localhost');
define('DB_NAME', 'domoschool');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHARSET', 'utf8mb4');

// Sécurité
define('PASSWORD_COST', 12);
define('SESSION_TIMEOUT', 3600); // 1 heure

// Initialisation
if (!file_exists(LOG_DIR)) mkdir(LOG_DIR, 0755, true);
if (!file_exists(UPLOAD_DIR)) mkdir(UPLOAD_DIR, 0755, true);

session_set_cookie_params([
    'lifetime' => SESSION_TIMEOUT,
    'path' => '/',
    'secure' => APP_ENV === 'production',
    'httponly' => true,
    'samesite' => 'Strict'
]);

if (APP_DEBUG) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
}
?>