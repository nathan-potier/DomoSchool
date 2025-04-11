<?php include('../includes/header.php'); ?>

<div class="container signup-container">
    <h1 class="signup-title">📝 Créer un compte</h1>
    <p class="signup-description">
        Rejoignez <strong>DomoSchool</strong> et accédez à des cours personnalisés, des exercices interactifs et bien plus encore.
    </p>
    
    <?php include('../includes/notif.php'); ?>
    
    <form method="post" action="../models/register_user.php" class="signup-form">
        <label for="first_name" class="signup-label">👤 Prénom :</label>
        <input type="text" id="first_name" name="first_name" required placeholder="Jean" class="signup-input">
        
        <label for="last_name" class="signup-label">👤 Nom :</label>
        <input type="text" id="last_name" name="last_name" required placeholder="Dupont" class="signup-input">
        
        <label for="email" class="signup-label">📧 Adresse email :</label>
        <input type="email" id="email" name="email" required placeholder="exemple@email.com" class="signup-input">
        
        <label for="password" class="signup-label">🔒 Mot de passe :</label>
        <input type="password" id="password" name="password" required placeholder="********" class="signup-input">
        
        <label for="password_confirm" class="signup-label">🔒 Confirmer le mot de passe :</label>
        <input type="password" id="password_confirm" name="password_confirm" required placeholder="********" class="signup-input">
        
        <label for="role" class="signup-label">🎓 Choisissez votre rôle :</label>
        <select id="role" name="role" class="signup-input" required>
            <option value="student">Étudiant</option>
            <option value="teacher">Professeur</option>
            <option value="parent">Parent</option>
            <option value="admin">Administrateur</option>
        </select>
        
        <button type="submit" class="signup-btn">S'inscrire</button>
    </form>

    <p class="signup-login-link">
        Déjà un compte ? <a href="login.php" class="signup-login-link-text">Se connecter</a>
    </p>
</div>

<?php include('../includes/footer.php'); ?>
