<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require_once "phpmailer/PHPMailer.php";
    require_once "phpmailer/SMTP.php";
    require_once "phpmailer/Exception.php";
    
    function Send_Mailing ( $Sujet, $Message, $Destinataire, $PJS = false, $Reply = 'mon@email.com' ) {

        $mail = new PHPMailer();
        $mail->CharSet = "UTF-8";
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->Username = "mon@email.com";
        $mail->Password = 'motdepasse';
        $mail->Port = 465;  // port
        $mail->SMTPSecure = "ssl";  // tls or ssl
        
        $mail->From = "mon@email.com";
        $mail->FromName = "De la part de...";

        $mail->addAddress($Destinataire);
        $mail->isHTML(true);
        
        if ( $PJS ) {
            $mail->addAttachment($PJS);
        }

        $mail->addReplyTo($Reply, 'Reply to');
        
        $mail->Subject = $Sujet;
        $mail->Body = $Message;

        return $mail->send() ? true : false;
    }
?>