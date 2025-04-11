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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = sanitizeInput($_POST['first_name']);
    $lastName = sanitizeInput($_POST['last_name']);
    $email = sanitizeInput($_POST['email']);
    updateUserProfile($_SESSION['user_id'], $firstName, $lastName, $email);
    redirect('profile.php?success=Profil mis à jour');
}
?>

<?php include('../includes/header.php'); ?>

<div class="container">
    <h1>Modifier votre profil</h1>
    <form method="post">
        <label for="first_name">Prénom</label>
        <input type="text" name="first_name" value="<?= htmlspecialchars($user['first_name']) ?>" required>

        <label for="last_name">Nom</label>
        <input type="text" name="last_name" value="<?= htmlspecialchars($user['last_name']) ?>" required>

        <label for="email">Email</label>
        <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>

        <button type="submit">Mettre à jour</button>
    </form>
</div>

<?php include('../includes/footer.php'); ?>
