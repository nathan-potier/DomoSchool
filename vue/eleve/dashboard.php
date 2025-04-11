<?php
require_once __DIR__ . '/../../includes/functions.php';
startSession();
checkAuth();  // Cette fonction vérifie si l'utilisateur est connecté

// Récupérer les informations de l'utilisateur connecté
$user = getUserSessionData();

if ($user === null) {
    // Si l'utilisateur n'est pas connecté, rediriger vers la page de connexion
    header('Location: ' . BASE_URL . '/vue/login.php');
    exit();
}

$fullName = $user['userName'];
?>

<?php include('../../includes/header.php'); ?>

<div class="container">
    <h1>Bienvenue, <?= htmlspecialchars($fullName) ?> !</h1>

    <div class="dashboard-info">
        <p><strong>Email :</strong> <?= htmlspecialchars($user['userEmail']) ?></p>
        <p><strong>Dernière connexion :</strong> <?= date('d/m/Y H:i', strtotime($user['lastLogin'])) ?></p>
    </div>

    <div class="dashboard-links">
        <a href="courses.php" class="btn">Voir les Cours</a>
        <a href="exercises.php" class="btn">Voir les Exercices</a>
        <a href="schedule.php" class="btn">Planification des Cours</a>
        <a href="profile.php" class="btn">Modifier le Profil</a>
    </div>

    <!-- Bouton de déconnexion -->
    <div class="logout-btn">
        <a href="<?= BASE_URL . '/models/logout.php' ?>" class="btn">Déconnexion</a>
    </div>
</div>

<?php include('../../includes/footer.php'); ?>
