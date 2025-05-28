<?php
require_once __DIR__ . '/../../includes/functions.php';
startSession();

?>

<?php include('../../includes/header.php'); ?>

<div class="container">
    <h1>Contact</h1>

    <?php if ($message_envoye): ?>
        <p style="color: green;">Votre message a bien été envoyé !</p>
    <?php elseif (!empty($erreur)): ?>
        <p style="color: red;"><?= $erreur ?></p>
    <?php else: ?>
        <p>Pour toute question ou demande d'information, vous pouvez nous contacter en utilisant le formulaire ci-dessous ou en nous envoyant un email à : <strong>contact@domoschool.com</strong></p>
    <?php endif; ?>

    <?php if (!$message_envoye): ?>
        <form action="" method="post">
            <label for="name">Nom :</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email :</label>
            <input type="email" id="email" name="email" required>

            <label for="message">Message :</label>
            <textarea id="message" name="message" required></textarea>

            <button type="submit">Envoyer</button>
        </form>
    <?php endif; ?>
</div>

<?php include('../../includes/footer.php'); ?>
