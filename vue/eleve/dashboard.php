<?php
require_once __DIR__ . '/../../includes/functions.php';

checkAuth();  // Cette fonction vérifie si l'utilisateur est connecté

$user = getUserSessionData();

if ($user === null) {
    header('Location: ' . BASE_URL . '/login');
    exit();
}

$fullName = $user['userName'];

// Charger les vraies statistiques
$userStats = getUserStats($user['userId']);

$nbCoursesRead = $userStats['courses_read'];
$nbExercisesDone = $userStats['exercises_done'];
$totalTimeSpent = $userStats['time_spent'];
$progressPercent = $userStats['progress'];
?>

<?php include('../../includes/header.php'); ?>

<div class="container">
    <?php include('../../includes/notif.php'); ?>
    <h1>🎓 Bienvenue, <?= htmlspecialchars($fullName) ?> !</h1>

    <div class="dashboard-info">
        <h2>📊 Mon activité : </h2>
        <div class="stats">
            <div class="stat-box">
                <p class="stat-value"><?= $nbCoursesRead ?></p>
                <p class="stat-label">Cours lus</p>
            </div>
            <div class="stat-box">
                <p class="stat-value"><?= $nbExercisesDone ?></p>
                <p class="stat-label">Exercices faits</p>
            </div>
            <div class="stat-box">
                <p class="stat-value"><?= $totalTimeSpent ?> min</p>
                <p class="stat-label">Temps passé</p>
            </div>
            <div class="stat-box">
                <p class="stat-value"><?= $progressPercent ?>%</p>
                <p class="stat-label">Progression</p>
                <div class="progress-bar">
                    <div class="progress" style="width: <?= $progressPercent ?>%;"></div>
                </div>
            </div>

        </div>
    </div>

    <div class="dashboard-links">
        <a href="<?= BASE_URL . '/eleve/courses' ?>">Voir les Cours</a>
        <a href="<?= BASE_URL . '/exercices' ?>">Voir les Exercices</a>
        <a href="<?= BASE_URL . '/eleve/schedule' ?>">Planification des Cours</a>
        <a href="<?= BASE_URL . '/eleve/profile' ?>">Modifier le Profil</a>
    </div>

    <div class="logout-btn">
        <a href="<?= BASE_URL . '/logout' ?>">Déconnexion</a>
    </div>
</div>

<?php include('../../includes/footer.php'); ?>
