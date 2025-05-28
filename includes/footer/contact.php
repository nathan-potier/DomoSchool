<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../includes/PHPMailer/src/Exception.php';
require '../../includes/PHPMailer/src/PHPMailer.php';
require '../../includes/PHPMailer/src/SMTP.php';

$config = require '../../../private_mail.php';

$message_envoye = false;
$erreur = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name    = htmlspecialchars(trim($_POST['name'] ?? ''));
    $email   = htmlspecialchars(trim($_POST['email'] ?? ''));
    $message = htmlspecialchars(trim($_POST['message'] ?? ''));

    if ($name && filter_var($email, FILTER_VALIDATE_EMAIL) && $message) {
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host       = $config['SMTP_HOST'];
            $mail->SMTPAuth   = true;
            $mail->Username   = $config['SMTP_USER'];
            $mail->Password   = $config['SMTP_PASS'];
            $mail->SMTPSecure = 'tls';
            $mail->Port       = $config['SMTP_PORT'];

            $mail->setFrom($config['MAIL_FROM'], $config['MAIL_FROM_NAME']);
            $mail->addAddress($config['MAIL_TO']);

            $mail->isHTML(true);
            $mail->Subject = 'Nouveau message de contact';
            $mail->Body    = "
                <strong>Nom :</strong> {$name}<br>
                <strong>Email :</strong> {$email}<br>
                <strong>Message :</strong><br>" . nl2br($message);

            $mail->send();
            $message_envoye = true;
        } catch (Exception $e) {
            $erreur = "Erreur lors de l'envoi du message : {$mail->ErrorInfo}";
        }
    } else {
        $erreur = "Veuillez remplir tous les champs correctement.";
    }
}

require_once __DIR__ . '/../../includes/functions.php';
startSession();

include('../../includes/header.php');
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
            <input type="text" id="name" name="name" required value="<?= htmlspecialchars($_POST['name'] ?? '') ?>">

            <label for="email">Email :</label>
            <input type="email" id="email" name="email" required value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">

            <label for="message">Message :</label>
            <textarea id="message" name="message" required><?= htmlspecialchars($_POST['message'] ?? '') ?></textarea>

            <button type="submit">Envoyer</button>
        </form>
    <?php endif; ?>
</div>

<?php include('../../includes/footer.php'); ?>
