<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Symfony\Component\HttpClient\HttpClient;

require 'vendor/autoload.php';

function LogMessage($str) {
    print("* " . $str . "\n");
}


$mail = new PHPMailer(true);

LogMessage("Starting");

$httpClient = HttpClient::create();
$response = $httpClient->request('GET', 'https://mail2ru.org');

LogMessage("Downloaded email addresses from mail2ru.org");

$addresses = [];

if($response->getStatusCode() == 200) {
    $findStart = "var addresses=[";
    $findEnd = "];";

    $content = $response->getContent();
//    print($content);
    $startPos = strpos($content, $findStart);
    if($startPos != FALSE) {
        $endPos = strpos($content, $findEnd, $startPos);
        if($endPos != FALSE) {
            $addressesRaw = substr($content, $startPos+strlen($findStart), $endPos-($startPos+strlen($findStart)));

            //
            $addressArray = explode(',', $addressesRaw);
            foreach($addressArray as $value) {
                // clean up the addresses and load into the $address array
                array_push($addresses, str_replace("\"", "", $value));
            }
        }
    }
}

LogMessage("Number of email addresses downloaded: " . count($addresses));
LogMessage("Setting up email");

try {
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->Host = 'smtp-relay.sendinblue.com';
    $mail->SMTPAuth = true;
    $mail->Username = '';
    $mail->Password = '';
//    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = 587;

    // recipients
    $mail->setFrom('from@example.com', 'Mailer');
//    $mail->addAddress('<address to send to>');

    LogMessage("Adding addresses to email");
    foreach($addresses as $email_address) {
        $mail->addAddress($email_address);
    }

    LogMessage("Addresses added");

    $mail->addReplyTo('from@example.com', 'Mailer');

    // content
    $mail->isHTML(true);
    $mail->Subject = 'Hello from an email';
    $mail->Body = '<h1>Hello World</h1>';
    $mail->AltBody = 'hello world - no HTML';

    //
//    $mail->send();

    //
    LogMessage("Email sent");
}
catch (Exception $e) {
    LogMessage('Execption: ' . $mail->ErrorInfo . '\n');
}

LogMessage("End")

?>