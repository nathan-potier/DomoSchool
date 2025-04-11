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

$schedule = getStudentSchedule($_SESSION['user_id']);
?>

<?php include('../includes/header.php'); ?>

<div class="container">
    <h1>Planification des Cours</h1>

    <?php foreach ($schedule as $session): ?>
        <div class="session">
            <h3><?= htmlspecialchars($session['course_name']) ?> - <?= htmlspecialchars($session['date']) ?></h3>
            <p>Professeur : <?= htmlspecialchars($session['teacher_name']) ?></p>
        </div>
    <?php endforeach; ?>
</div>

<?php include('../includes/footer.php'); ?>
