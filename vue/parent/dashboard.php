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
    </div>

    <div class="dashboard-links">
        <a href="child.php" class="btn">Suivi de l'enfant</a>
        <a href="messages.php" class="btn">Messages avec Professeur</a>
        <a href="profile.php" class="btn">Modifier le Profil</a>
    </div>
</div>

<?php include('../includes/footer.php'); ?>
