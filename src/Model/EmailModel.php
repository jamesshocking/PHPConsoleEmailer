<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class EmailModel {
    public function sendEmail($message, $addresses = []){
        try {
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->Host = 'smtp-relay.sendinblue.com';
            $mail->SMTPAuth = true;
            $mail->Username = EMAIL_USER_NAME;
            $mail->Password = EMAIL_PASSWORD;
        //    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 587;
        
            // recipients
            $mail->setFrom('from@example.com', 'Mailer');
            foreach($addresses as $email_address) {
                $mail->addAddress($email_address);
            }
            $mail->addReplyTo('from@example.com', 'Mailer');
        
            // content
            $mail->isHTML(true);
            $mail->Subject = 'Hello from an email';
            $mail->Body = $message;
        
            //
        //    $mail->send();
        
        }
        catch (Exception $e) {
            print('Execption: ' . $mail->ErrorInfo . '\n');
        }
    }
}

?>