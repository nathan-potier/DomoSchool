<?php include('includes/header.php'); ?>

<div class="container" style="max-width: 500px; margin-top: 60px; margin-bottom: 80px;">
    <h1 style="text-align: center; margin-bottom: 20px;">📝 Créer un compte</h1>
    <p style="text-align: center; font-size: 1rem; color: #555; margin-bottom: 30px;">
        Rejoignez <strong>DomoSchool</strong> et accédez à des cours personnalisés, des exercices interactifs et bien plus encore.
    </p>
    
    <?php if (isset($_GET['error'])): ?>
    <div class="alert error">
        <?= htmlspecialchars($_GET['error']) ?>
    </div>
    <?php elseif (isset($_GET['success'])): ?>
        <div class="alert success">
            <?= htmlspecialchars($_GET['success']) ?>
        </div>
    <?php endif; ?>
    <form method="post" action="register_user.php" style="background-color: #fff; padding: 30px; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
        <label for="name" style="font-weight: 600;">👤 Nom complet :</label>
        <input type="text" id="name" name="name" required placeholder="Jean Dupont">
        
        <label for="email" style="font-weight: 600;">📧 Adresse email :</label>
        <input type="email" id="email" name="email" required placeholder="exemple@email.com">
        
        <label for="password" style="font-weight: 600;">🔒 Mot de passe :</label>
        <input type="password" id="password" name="password" required placeholder="********">

        <button type="submit" style="margin-top: 20px;">S'inscrire</button>
    </form>

    <p style="text-align: center; margin-top: 20px;">
        Déjà un compte ? <a href="login.php" style="color: var(--primary); font-weight: 500;">Se connecter</a>
    </p>
</div>

<?php include('includes/footer.php'); ?>
