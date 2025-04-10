<?php
// Inclure les fichiers nécessaires
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/db.php';

// Démarrer la session
startSession();

// Vérifier si l'utilisateur est connecté
if (empty($_SESSION['user_id'])) {
    redirect('login.php');
}

// Connexion à la base de données
try {
    $db = Database::getInstance();
    $connex = $db->getConnection();

    // Récupérer les données de l'utilisateur connecté
    $stmt = $connex->prepare("SELECT id, first_name, last_name, email, role FROM users WHERE id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $user = $stmt->fetch();

    if (!$user) {
        redirect('login.php');
    }

    // Si le formulaire a été soumis, mettre à jour les informations de l'utilisateur
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $firstName = sanitizeInput($_POST['first_name']);
        $lastName = sanitizeInput($_POST['last_name']);
        $email = sanitizeInput($_POST['email']);

        // Mettre à jour l'utilisateur dans la base de données
        $stmt = $connex->prepare("UPDATE users SET first_name = ?, last_name = ?, email = ? WHERE id = ?");
        $stmt->execute([$firstName, $lastName, $email, $_SESSION['user_id']]);

        redirect('edit-profile.php?success=Profil mis à jour avec succès');
    }
} catch (PDOException $e) {
    error_log('Profile Update Error: ' . $e->getMessage());
    redirect('edit-profile.php?error=Erreur lors de la mise à jour du profil');
}
?>

<?php include('../includes/header.php'); ?>

<div class="container">
    <h1>Modifier votre profil</h1>

    <?php include('../includes/notif.php'); ?>
    <form method="post">
        <label for="first_name">Prénom :</label>
        <input type="text" id="first_name" name="first_name" value="<?= htmlspecialchars($user['first_name']) ?>" required>

        <label for="last_name">Nom :</label>
        <input type="text" id="last_name" name="last_name" value="<?= htmlspecialchars($user['last_name']) ?>" required>

        <label for="email">Email :</label>
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>

        <button type="submit">Mettre à jour</button>
    </form>
</div>

<?php include('../includes/footer.php'); ?>
