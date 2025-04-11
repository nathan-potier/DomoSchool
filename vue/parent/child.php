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

// Exemple de suivi d'un enfant
$child = getChildByParent($_SESSION['user_id']);
?>

<?php include('../includes/header.php'); ?>

<div class="container">
    <h1>Suivi de l'Enfant</h1>

    <p><strong>Nom :</strong> <?= htmlspecialchars($child['name']) ?></p>
    <p><strong>Progrès :</strong> <?= $child['progress'] ?>%</p>
    <a href="child-details.php?id=<?= $child['id'] ?>" class="btn">Voir les Détails</a>
</div>

<?php include('../includes/footer.php'); ?>
