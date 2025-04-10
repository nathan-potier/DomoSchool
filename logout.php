<?php
// Inclure les fichiers nécessaires
require_once __DIR__ . '/includes/functions.php';

// Démarrer la session
startSession();

// Détruire la session pour déconnecter l'utilisateur
session_unset();
session_destroy();

// Rediriger vers la page de connexion avec un message de succès
redirect('login.php?success=Vous êtes déconnecté avec succès');
?>
