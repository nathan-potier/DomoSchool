<?php
session_start();
$old = $_SESSION['old_inputs'] ?? [];
unset($_SESSION['old_inputs']);
?>

<?php include('../../includes/header.php'); ?>

<div class="container signup-container">
    <h1 class="signup-title">📝 Créer un compte</h1>
    <p class="signup-description">
        Rejoignez <strong>DomoSchool</strong> avec votre code d'accès unique.
    </p>
    <?php include('../../includes/notif.php'); ?>

    <form method="post" action="../../models/register_user.php" class="signup-form">
        <label for="access_code" class="signup-label">🔑 Code d'accès :</label>
        <input type="text" id="access_code" name="access_code" required placeholder="Entrez votre code unique" class="signup-input"
            value="<?= htmlspecialchars($old['access_code'] ?? '') ?>">

        <p class="buy-code-link">
            Besoin d'un code ? <a href="../purchase/purchase_code.php" class="signup-login-link-text">Acheter un code d'accès</a>
        </p>

        <label for="first_name" class="signup-label">👤 Prénom :</label>
        <input type="text" id="first_name" name="first_name" required placeholder="Jean" class="signup-input"
            value="<?= htmlspecialchars($old['first_name'] ?? '') ?>">

        <label for="last_name" class="signup-label">👤 Nom :</label>
        <input type="text" id="last_name" name="last_name" required placeholder="Dupont" class="signup-input"
            value="<?= htmlspecialchars($old['last_name'] ?? '') ?>">

        <label for="email" class="signup-label">📧 Adresse email :</label>
        <input type="email" id="email" name="email" required placeholder="exemple@email.com" class="signup-input"
            value="<?= htmlspecialchars($old['email'] ?? '') ?>">

        <label for="password" class="signup-label">🔒 Mot de passe :</label>
        <input type="password" id="password" name="password" required placeholder="********" class="signup-input"
            value="<?= htmlspecialchars($old['password'] ?? '') ?>">

        <label for="password_confirm" class="signup-label">🔒 Confirmer le mot de passe :</label>
        <input type="password" id="password_confirm" name="password_confirm" required placeholder="********" class="signup-input"
            value="<?= htmlspecialchars($old['password_confirm'] ?? '') ?>">

        <button type="submit" class="signup-btn">S'inscrire</button>
    </form>

    <p class="signup-login-link">
        Déjà un compte ? <a href="login.php" class="signup-login-link-text">Se connecter</a>
    </p>
</div>

<?php include('../../includes/footer.php'); ?>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('error')) {
        const errorMsg = urlParams.get('error');
        if (errorMsg.includes('Code invalide') || errorMsg.includes('déjà utilisé')) {
            localStorage.removeItem('purchased_code');
        }
    }

    const storedCode = localStorage.getItem('purchased_code');
    if (storedCode && !document.getElementById("access_code").value) {
        document.getElementById("access_code").value = storedCode;
    }
});
</script>
