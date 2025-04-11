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
    <h1>Bienvenue, Professeur <?= htmlspecialchars($fullName) ?> !</h1>

    <div class="dashboard-links">
        <a href="create-course.php" class="btn">Créer un Cours</a>
        <a href="create-exercise.php" class="btn">Créer un Exercice</a>
        <a href="students.php" class="btn">Liste des Élèves</a>
        <a href="messages.php" class="btn">Messagerie</a>
        <a href="profile.php" class="btn">Modifier le Profil</a>
    </div>
</div>

<?php include('../includes/footer.php'); ?>
