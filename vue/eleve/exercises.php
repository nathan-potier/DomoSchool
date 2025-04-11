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

$exercises = getExercisesByStudent($_SESSION['user_id']);
?>

<?php include('../includes/header.php'); ?>

<div class="container">
    <h1>Exercices à faire</h1>

    <?php foreach ($exercises as $exercise): ?>
        <div class="exercise">
            <h3><?= htmlspecialchars($exercise['title']) ?></h3>
            <p><?= htmlspecialchars($exercise['description']) ?></p>
            <a href="exercise-details.php?id=<?= $exercise['id'] ?>" class="btn">Commencer l'exercice</a>
        </div>
    <?php endforeach; ?>
</div>

<?php include('../includes/footer.php'); ?>
