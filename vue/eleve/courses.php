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

// Exemple de récupération des cours
//$courses = getCoursesByStudent($_SESSION['user_id']);
?>

<?php include('../includes/header.php'); ?>

<div class="container">
    <h1>Mes Cours</h1>

    <?php foreach ($courses as $course): ?>
        <div class="course">
            <h3><?= htmlspecialchars($course['title']) ?></h3>
            <p><?= htmlspecialchars($course['description']) ?></p>
            <a href="course-details.php?id=<?= $course['id'] ?>" class="btn">Voir Détails</a>
        </div>
    <?php endforeach; ?>
</div>

<?php include('../includes/footer.php'); ?>
