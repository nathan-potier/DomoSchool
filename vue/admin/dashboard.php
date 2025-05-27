<?php
require_once __DIR__ . '/../../includes/functions.php';
startSession();
checkAuth();

// Récupérer les informations de l'utilisateur connecté
$user = getUserSessionData();

if ($user === null || $user['userRole'] !== 'admin') {
    header('Location: ' . BASE_URL . '/login');
    exit();
}

$fullName = $user['userName'];
?>

<?php include('../../includes/header.php'); ?>

<div class="container">
    <h1>Bienvenue, <?= htmlspecialchars($fullName) ?> (Admin) !</h1>

    <div class="dashboard-info">
        <p><strong>Email :</strong> <?= htmlspecialchars($user['userEmail']) ?></p>
        <p><strong>Dernière connexion :</strong> <?= date('d/m/Y H:i', strtotime($user['lastLogin'])) ?></p>
    </div>

    <div class="dashboard-links">
        <a href="<?= BASE_URL . '/admin/users' ?>" class="btn">Gérer les utilisateurs</a>
        <a href="<?= BASE_URL . '/admin/courses' ?>" class="btn">Valider les cours</a>
        <a href="<?= BASE_URL . '/admin/logs' ?>" class="btn">Consulter les logs</a>
        <a href="<?= BASE_URL . '/admin/settings' ?>" class="btn">Paramètres généraux</a>
    </div>

    <!-- Bouton de déconnexion -->
    <div class="logout-btn">
        <a href="<?= BASE_URL . '/logout' ?>" class="btn">Déconnexion</a>
    </div>
</div>

<?php include('../../includes/footer.php'); ?>
