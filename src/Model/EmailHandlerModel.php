<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class EmailHandlerModel {
    public function sendEmail($message, $addresses = []){
        $mail = new PHPMailer(true);

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
            $mail->setFrom(EMAIL_FROM_ADDRESS, EMAIL_FROM_NAME);
            $mail->addReplyTo(EMAIL_REPLY_TO_ADDRESS, EMAIL_REPLY_TO_NAME);
            foreach($addresses as $uniqueId => $person) {
                $mail->addAddress($person->emailAddress);

                // personalise the message for each recipient - used for tracking - uses the individual's uniqueId
                $body_content = str_replace("{id}", $uniqueId, $message);

                // content
                $mail->isHTML(true);
                $mail->Subject = EMAIL_SUBJECT_LINE;
                $mail->Body = $body_content;
            
                //
            //    $mail->send();
                echo $body_content . "\n";
                break;
            }
        }
        catch (Exception $e) {
            print('Execption: ' . $mail->ErrorInfo . '\n');
        }
    }
}

?>