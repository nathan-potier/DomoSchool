<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../includes/PHPMailer/src/Exception.php';
require '../../includes/PHPMailer/src/PHPMailer.php';
require '../../includes/PHPMailer/src/SMTP.php';

$config = require '../../../private_mail.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name    = htmlspecialchars($_POST['name'] ?? '');
    $email   = htmlspecialchars($_POST['email'] ?? '');
    $message = htmlspecialchars($_POST['message'] ?? '');

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
        header('Location: merci.php');
        exit;
    } catch (Exception $e) {
        echo "Erreur : {$mail->ErrorInfo}";
    }
}
