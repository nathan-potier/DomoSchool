<?php
require_once __DIR__ . '/../../includes/functions.php';
startSession();

checkAuth(); // Vérifie que l'utilisateur est connecté

// Récupération des données de session
$userSessionData = getUserSessionData();

// Redirection si l'utilisateur n'est pas connecté
if (!$userSessionData['isLoggedIn']) {
    header('Location: ' . BASE_URL . '/login');
    exit;
}

// Séparer le nom complet
$userNameParts = explode(' ', $userSessionData['userName'], 2);
$firstName = $userNameParts[0] ?? '';
$lastName = $userNameParts[1] ?? '';

// Si formulaire soumis, on met à jour le profil
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = sanitizeInput($_POST['first_name']);
    $lastName = sanitizeInput($_POST['last_name']);
    $email = sanitizeInput($_POST['email']);

    updateUserProfile($_SESSION['user_id'], $firstName, $lastName, $email);

    // Redirection propre après succès
    header('Location: ' . BASE_URL . '/professeur/profile?success=Profil mis à jour');
    exit;
}
?>

<?php include(__DIR__ . '/../../includes/header.php'); ?>

<div class="container">
    <h1>Modifier votre profil</h1>

    <?php if (isset($_GET['success'])): ?>
        <p class="success-message"><?= htmlspecialchars($_GET['success']) ?></p>
    <?php endif; ?>

    <form method="post">
        <label for="first_name">Prénom</label>
        <input type="text" name="first_name" value="<?= htmlspecialchars($firstName) ?>" required>

        <label for="last_name">Nom</label>
        <input type="text" name="last_name" value="<?= htmlspecialchars($lastName) ?>" required>

        <label for="email">Email</label>
        <input type="email" name="email" value="<?= htmlspecialchars($userSessionData['userEmail'] ?? '') ?>" required>

        <button type="submit">Mettre à jour</button>
    </form>
</div>

<?php include(__DIR__ . '/../../includes/footer.php'); ?>
