<?php
require_once __DIR__ . '/../includes/functions.php';
startSession();

if (empty($_SESSION['user_id'])) {
    redirect('login.php');
}

$user = getUserData($_SESSION['user_id']);
if (!$user || !isAdmin($user)) {
    redirect('login.php');
}
?>

<?php include('../includes/header.php'); ?>

<div class="container">
    <h1>Administration</h1>

    <div class="admin-links">
        <a href="users.php" class="btn">Gestion des Utilisateurs</a>
        <a href="courses.php" class="btn">Validation des Cours</a>
        <a href="logs.php" class="btn">Logs d’Activité</a>
        <a href="settings.php" class="btn">Paramètres</a>
    </div>
</div>

<?php include('../includes/footer.php'); ?>
