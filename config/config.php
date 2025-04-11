<?php
// Configuration de l'application
define('APP_ENV', 'development'); // 'production' en live
define('APP_DEBUG', true);

// Chemins absolus
define('ROOT_DIR', __DIR__ . '/..');
define('LOG_DIR', ROOT_DIR . '/logs');
define('UPLOAD_DIR', ROOT_DIR . '/uploads');
define('BASE_URL', '/DomoSchool');  // Utilise le chemin relatif à partir de la racine du serveur


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

// Définir les paramètres du cookie de session avant session_start()
if (session_status() === PHP_SESSION_NONE) { // Vérifie si la session n'est pas déjà démarrée
    session_set_cookie_params([
        'lifetime' => SESSION_TIMEOUT,  // Durée de vie du cookie (en secondes)
        'path' => '/',                  // Le chemin où le cookie est disponible
        'secure' => APP_ENV === 'production', // Sécurisé si l'environnement est 'production'
        'httponly' => true,             // Empêche l'accès via JavaScript
        'samesite' => 'Strict'          // Restriction des cookies de session
    ]);
    session_start(); // Démarre la session après avoir défini les paramètres
}

if (APP_DEBUG) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
}
?>