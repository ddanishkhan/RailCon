<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';

include '../logs/LOGGER.php';
require_once __DIR__ . '/../config.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);
$LOGPATH = '../logs/logs.log';
session_start();

try {
    
    if(!isset($_SESSION['emailid'])){
        logger::logWithPath("ERROR", "No email", $LOGPATH);
        return;
    }
    
    logger::logWithPath("INFO", "Message being sent: ". $_SESSION['emailid'], $LOGPATH );
    
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_CLIENT;                                       //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = SMTP_HOST;                             //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = SMTP_USERNAME;                          //SMTP username
    $mail->Password   = SMTP_PASSWORD;                          //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
    $mail->Port       = SMTP_PORT;                              //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom(SMTP_FROM, SMTP_FROM_NAME);
    $mail->addAddress($_SESSION['emailid'], $_SESSION['fullnameemail']);     //Add a recipient
    
    //Attachments
    //     $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    //     $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
    
    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Railway Concession Pass Processed';
    $mail->Body    = 'Your Railway Concession Pass has been <strong>processed<strong>. <br>Please collect it from office during working hours if issued. Closed on Friday and Sunday';
    $mail->AltBody = 'Your Railway Concession Pass has been processed. Please collect it from office during working hours if issued. Closed on Friday and Sunday';
    
    $mail->send();
    logger::logWithPath("INFO", "Message has been sent: ". $_SESSION['emailid'], $LOGPATH);
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    logger::logWithPath("ERROR", $e . "\n" . $mail->ErrorInfo, $LOGPATH );
}

unset($_SESSION['fullnameemail']);
unset($_SESSION['emailid']);
?>