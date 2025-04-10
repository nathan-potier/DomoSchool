<?php
require_once __DIR__ . '/../config/config.php';

class Database {
    private static $instance = null;
    private $connection;

    private function __construct() {
        try {
            // DSN de la connexion à la base de données
            $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
            
            // Tentative de connexion avec PDO
            $this->connection = new PDO($dsn, DB_USER, DB_PASS, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,  // Activer le mode d'erreur
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Mode de récupération des résultats
                PDO::ATTR_EMULATE_PREPARES => false // Désactiver l'émulation des requêtes préparées
            ]);
            
            // Optionnel: Message pour indiquer que la connexion a réussi
            // echo "Connexion réussie à la base de données!";
        } catch (PDOException $e) {
            // Si une exception est levée (connexion échouée), loguer l'erreur
            error_log('[' . date('Y-m-d H:i:s') . '] DB Error: ' . $e->getMessage() . PHP_EOL, 3, LOG_DIR . '/database.log');
            
            // Afficher un message d'erreur plus clair
            die("Erreur de connexion à la base de données. Veuillez vérifier les paramètres de connexion.");
        }
    }

    public static function getInstance() {
        // Si l'instance n'existe pas, en créer une nouvelle
        if (!self::$instance) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->connection;
    }
}

// Initialisation
try {
    $db = Database::getInstance();
    $connex = $db->getConnection();
    // Optionnel: message pour indiquer que la connexion a réussi
    // echo "Connexion établie avec succès!";
} catch (Exception $e) {
    // Gérer l'erreur au niveau global
    die("Le système est actuellement indisponible. Veuillez réessayer plus tard.");
}
?>
