<?php include('includes/header.php'); ?>

<div class="container">
    <h1>Connexion</h1>
    <?php include('includes/notif.php'); ?>
    <form method="post" action="authenticate.php">
        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required>
        
        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" required>
        
        <button type="submit">Se connecter</button>
    </form>
    <p>Pas encore de compte ? <a href="register.php">S'inscrire</a></p>
</div>

<?php include('includes/footer.php'); ?>
