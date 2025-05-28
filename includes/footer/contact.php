<?php
// Enable error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Load private mail configuration
$config = require 'C:\xampp\htdocs\DomoSchool\private_mail.php';

// Initialize variables
$message_envoye = false;
$erreur = '';
$name = '';
$email = '';
$message = '';

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name    = htmlspecialchars(trim($_POST['name'] ?? ''));
    $email   = htmlspecialchars(trim($_POST['email'] ?? ''));
    $message = htmlspecialchars(trim($_POST['message'] ?? ''));

    if ($name && filter_var($email, FILTER_VALIDATE_EMAIL) && $message) {
        $to      = $config['MAIL_TO'];
        $subject = 'Nouveau message de contact';
        $headers = "From: {$config['MAIL_FROM_NAME']} <{$config['MAIL_FROM']}>\r\n";
        $headers .= "Reply-To: {$email}\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

        $email_content = "
            <strong>Nom :</strong> {$name}<br>
            <strong>Email :</strong> {$email}<br>
            <strong>Message :</strong><br>" . nl2br($message);

        if (mail($to, $subject, $email_content, $headers)) {
            $message_envoye = true;
        } else {
            $erreur = "Erreur lors de l'envoi du message.";
        }
    } else {
        $erreur = "Veuillez remplir tous les champs correctement.";
    }
}

// Include header
include('C:\xampp\htdocs\DomoSchool\includes\header.php');
?>

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
            <input type="text" id="name" name="name" required value="<?= htmlspecialchars($name) ?>">

            <label for="email">Email :</label>
            <input type="email" id="email" name="email" required value="<?= htmlspecialchars($email) ?>">

            <label for="message">Message :</label>
            <textarea id="message" name="message" required><?= htmlspecialchars($message) ?></textarea>

            <button type="submit">Envoyer</button>
        </form>
    <?php endif; ?>
</div>

<?php include('C:\xampp\htdocs\DomoSchool\includes\footer.php'); ?>
