<?php include('../includes/header.php'); ?>

<div class="container signup-container">
    <h1 class="signup-title">Connexion</h1>
    <?php include('../includes/notif.php'); ?>
    <form method="post" action="../models/authenticate.php" class="signup-form">
        <label for="email" class="signup-label">Email :</label>
        <input type="email" id="email" name="email" required class="signup-input">
        
        <label for="password" class="signup-label">Mot de passe :</label>
        <input type="password" id="password" name="password" required class="signup-input">
        
        <button type="submit" class="signup-btn">Se connecter</button>
    </form>
    <p class="signup-login-link">
        Pas encore de compte ? 
        <a href="register.php" class="signup-login-link-text">S'inscrire</a>
    </p>
</div>

<?php include('../includes/footer.php'); ?>
