<?php
// Vos fonctions (token, traitement des fichiers etc...)
// PHPMailer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

function sendMail($email) {
    try {
        $mail = new PHPMailer(true);
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP(); 
        $mail->Host = 'dwwm2324.fr'; 
        $mail->SMTPAuth = true;
        $mail->Username = 'contact@dwwm2324.fr'; 
        $mail->Password = 'm%]E5p2%o]yc';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465; 

        $mail->setFrom('contact@dwwm2324.fr', 'Mailer');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = 'Compte créé';
        $mail->Body = "Compte bien créé à l'adresse $email. <br> Bienvenue !";
        $mail->AltBody = 'Bienvenue chez nous !';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
}
?>