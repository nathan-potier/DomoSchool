<?php
require_once __DIR__ . '/../../includes/functions.php';
startSession();
checkAuth();

// Récupérer les informations de l'utilisateur connecté
$user = getUserSessionData();

if ($user === null || $user['userRole'] !== 'teacher') {
    header('Location: ' . BASE_URL . '/vue/login.php');
    exit();
}

$fullName = $user['userName'];
?>

<?php include('../../includes/header.php'); ?>

<div class="container">
    <h1>Bienvenue, <?= htmlspecialchars($fullName) ?> (Parent) !</h1>

    <div class="dashboard-info">
        <p><strong>Email :</strong> <?= htmlspecialchars($user['userEmail']) ?></p>
        <p><strong>Dernière connexion :</strong> <?= date('d/m/Y H:i', strtotime($user['lastLogin'])) ?></p>
    </div>

    <div class="dashboard-links">
        <a href="child.php" class="btn">Suivi de mon enfant</a>
        <a href="messages.php" class="btn">Messagerie avec les professeurs</a>
        <a href="profile.php" class="btn">Modifier le profil</a>
    </div>

    <!-- Bouton de déconnexion -->
    <div class="logout-btn">
        <a href="<?= BASE_URL . '/models/logout.php' ?>" class="btn">Déconnexion</a>
    </div>
</div>

<?php include('../../includes/footer.php'); ?>
