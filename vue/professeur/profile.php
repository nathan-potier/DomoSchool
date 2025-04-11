<?php
require_once __DIR__ . '/../../includes/functions.php';
startSession();

checkAuth();  // Cette fonction vérifie si l'utilisateur est connecté

// Récupérer les données de session utilisateur
$userSessionData = getUserSessionData();

// Vérifier si l'utilisateur est connecté avant de procéder
if (!$userSessionData['isLoggedIn']) {
    // Si l'utilisateur n'est pas connecté, rediriger vers la page de connexion
    header('Location: login.php');
    exit;
}

// Séparer le nom complet en prénom et nom de famille
$userNameParts = explode(' ', $userSessionData['userName'], 2);
$firstName = $userNameParts[0] ?? '';  // Si le prénom existe, on l'assigne, sinon c'est une chaîne vide
$lastName = $userNameParts[1] ?? '';   // Si le nom de famille existe, on l'assigne, sinon c'est une chaîne vide

// Si le formulaire est soumis, mettre à jour le profil
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = sanitizeInput($_POST['first_name']);
    $lastName = sanitizeInput($_POST['last_name']);
    $email = sanitizeInput($_POST['email']);
    updateUserProfile($_SESSION['user_id'], $firstName, $lastName, $email);
    redirect('profile.php?success=Profil mis à jour');
}
?>

<!-- Inclure le header avec le bon chemin -->
<?php include(__DIR__ . '/../../includes/header.php'); ?>

<div class="container">
    <h1>Modifier votre profil</h1>
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

<!-- Inclure le footer -->
<?php include(__DIR__ . '/../../includes/footer.php'); ?>
