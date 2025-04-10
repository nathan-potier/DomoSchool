<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../includes/db.php'; // Inclure les fonctions de gestion de la base de données
require_once __DIR__ . '/../includes/functions.php'; // Inclure les fonctions génériques

// Démarrer la session si ce n'est pas déjà fait
startSession();

// Si l'utilisateur est déjà authentifié, rediriger vers la page d'accueil ou le tableau de bord
if (isset($_SESSION['user_id'])) {
    redirect('../vue/dashboard.php'); // Remplacer par la page vers laquelle rediriger après authentification
}

// Vérification des informations de connexion
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données envoyées via le formulaire
    $email = sanitizeInput($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    // Validation des données
    if (empty($email) || empty($password)) {
        redirect('../vue/login.php?error=Tous les champs sont obligatoires');
    }

    // Connexion à la base de données
    try {
        $db = Database::getInstance();
        $connex = $db->getConnection();

        // Vérification de l'existence de l'utilisateur dans la base de données
        $stmt = $connex->prepare("SELECT id, password, role FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && verifyPassword($password, $user['password'])) {
            // Mot de passe valide, connecter l'utilisateur
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_role'] = $user['role']; // Rôle de l'utilisateur (optionnel)

                // Mise à jour de la colonne last_login avec la date et l'heure actuelles
            $stmt = $connex->prepare("UPDATE users SET last_login = NOW() WHERE id = ?");
            $stmt->execute([$user['id']]);
            logActivity('user_login', $user['id']); // Loguer l'activité de connexion

            // Rediriger vers le tableau de bord ou une page protégée
            redirect('../vue/dashboard.php');
        } else {
            // Authentification échouée
            redirect('../vue/login.php?error=Identifiants incorrects');
        }

    } catch (PDOException $e) {
        error_log('Authentication Error: '.$e->getMessage());
        redirect('../vue/login.php?error=Erreur système. Veuillez réessayer');
    }
}

// Si la requête est GET, afficher la page de connexion
?>