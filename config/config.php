<?php
// Configuration de l'application
define('APP_ENV', 'development'); // 'production' en live
define('APP_DEBUG', true);

// Chemins absolus (optimisés)
define('ROOT_DIR', dirname(__DIR__)); // Pointe directement vers /DomoSchool
define('INCLUDE_DIR', ROOT_DIR . '/includes');
define('MODEL_DIR', ROOT_DIR . '/models');
define('VIEW_DIR', ROOT_DIR . '/vue');
define('ASSET_DIR', ROOT_DIR . '/assets');
define('LOG_DIR', ROOT_DIR . '/logs');
define('UPLOAD_DIR', ROOT_DIR . '/uploads');

// URL (optimisée pour flexibilité)

define('BASE_URL', '');
define('ASSET_URL', BASE_URL . '/assets');

// Base de données




$config = require __DIR__ . '/../../private.php';

define('DB_HOST', $config['DB_HOST']);
define('DB_NAME', $config['DB_NAME']);
define('DB_USER', $config['DB_USER']);
define('DB_PASS', $config['DB_PASS']);
define('DB_CHARSET', 'utf8mb4');

// Sécurité
define('PASSWORD_COST', 12);
define('SESSION_TIMEOUT', 3600); // 1 heure

// Initialisation des dossiers
if (!file_exists(LOG_DIR)) mkdir(LOG_DIR, 0755, true);
if (!file_exists(UPLOAD_DIR)) mkdir(UPLOAD_DIR, 0755, true);

// Configuration des sessions
if (session_status() === PHP_SESSION_NONE) {
    session_set_cookie_params([
        'lifetime' => SESSION_TIMEOUT,
        'path' => BASE_URL ?: '/',
        'domain' => $_SERVER['HTTP_HOST'] ?? 'localhost',
        'secure' => APP_ENV === 'production',
        'httponly' => true,
        'samesite' => 'Strict'
    ]);
    session_start();
}

// Gestion des erreurs
if (APP_DEBUG) {
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    ini_set('log_errors', '1');
    ini_set('error_log', LOG_DIR . '/php_errors.log');
} else {
    error_reporting(0);
    ini_set('display_errors', '0');
}

// Autoloader personnalisé (optionnel mais recommandé)
spl_autoload_register(function ($class) {
    $paths = [
        MODEL_DIR . "/$class.php",
        INCLUDE_DIR . "/$class.php"
    ];
    
    foreach ($paths as $path) {
        if (file_exists($path)) {
            require_once $path;
            return;
        }
    }
});
?>