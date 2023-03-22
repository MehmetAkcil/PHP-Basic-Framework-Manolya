<?php

namespace Core\Config;

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class Email
{
    private static $toEmail;
    private static $toName;

    private static $subject;

    private static $message;

    public function __construct($toName, $toEmail, $subject, $message)
    {
        self::$toName = $toName;
        self::$toEmail = $toEmail;
        self::$subject = $subject;
        self::$message = $message;
    }

    public function send(): bool
    {
        $mail = new PHPMailer(true);

        try {
            //Server settings
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host = Config::SMTP_HOST;                     //Set the SMTP server to send through
            $mail->SMTPAuth = true;                                   //Enable SMTP authentication
            $mail->Username = Config::SMTP_USERNAME;                     //SMTP username
            $mail->Password = Config::SMTP_PASSWORD;                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port = Config::SMTP_PORT;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom(Config::SMTP_USERNAME, Config::SMTP_MAILER);
            $mail->addAddress(self::$toEmail, self::$toName);     //Add a recipient



//            //Attachments
//            $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
//            $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = self::$subject;
            $mail->Body = self::$message;
            $mail->AltBody = self::$message;

            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}