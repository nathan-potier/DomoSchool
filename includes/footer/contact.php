<?php
require_once __DIR__ . '/../../includes/functions.php';
startSession();
?>

<?php include('../../includes/header.php'); ?>

<div class="container">
    <h1>Contact</h1>
    <p>Pour toute question ou demande d'information, vous pouvez nous contacter en utilisant le formulaire ci-dessous ou en nous envoyant un email à l'adresse suivante : contact@domoschool.com</p>

    <form action="#" method="post">
        <label for="name">Nom :</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required>

        <label for="message">Message :</label>
        <textarea id="message" name="message" required></textarea>

        <button type="submit">Envoyer</button>
    </form>
</div>

<?php include('../../includes/footer.php'); ?>
