<?php
require_once __DIR__ . '/../includes/functions.php';
startSession();

if (empty($_SESSION['user_id'])) {
    redirect('login.php');
}

$user = getUserData($_SESSION['user_id']);
if (!$user) {
    redirect('login.php');
}

$fullName = $user['first_name'] . ' ' . $user['last_name'];
?>

<?php include('../includes/header.php'); ?>

<div class="container">
    <h1>Bienvenue, <?= htmlspecialchars($fullName) ?> !</h1>

    <div class="dashboard-info">
        <p><strong>Email :</strong> <?= htmlspecialchars($user['email']) ?></p>
        <p><strong>Dernière connexion :</strong> <?= date('d/m/Y H:i', strtotime($user['last_login'])) ?></p>
    </div>

    <div class="dashboard-links">
        <a href="courses.php" class="btn">Voir les Cours</a>
        <a href="exercises.php" class="btn">Voir les Exercices</a>
        <a href="schedule.php" class="btn">Planification des Cours</a>
        <a href="profile.php" class="btn">Modifier le Profil</a>
    </div>
</div>

<?php include('../includes/footer.php'); ?>
