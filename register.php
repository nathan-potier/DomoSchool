<?php include('includes/header.php'); ?>

<div class="container">
    <h1>Inscription</h1>
    <form method="post" action="register_user.php">
        <label for="name">Nom :</label>
        <input type="text" id="name" name="name" required>
        
        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required>
        
        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" required>
        
        <button type="submit">S'inscrire</button>
    </form>
    <p>Déjà un compte ? <a href="login.php">Se connecter</a></p>
</div>

<?php include('includes/footer.php'); ?>
