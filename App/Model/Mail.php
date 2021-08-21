<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Mail
{
    private $Mail;
    private $user;
    private $pass;
    public function __construct()
    {
        $this->Mail=new PHPMailer(true);
        $this->user=$_ENV["sms_user"];
        $this->pass=$_ENV["sms_pass"];
    }

    public function sendConfirm($message,$dest,$img)
    {
        $mail=$this->Mail;
        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'ssl://smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->Mailer="smtp";
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'kingwebmaster019@gmail.com';                     //SMTP username
            $mail->Password   = 'Script95@os';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 465;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mail->setFrom($_ENV["sms_user"], 'PMP');
            $mail->addAddress($dest);

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'PMP';
            $mail->addEmbeddedImage($img,"logo");
            $mail->Body    = $message;

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

    }


    public function sendB($message,$dest,$img)
    {
        $mail=$this->Mail;
        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_OFF;
            $mail->isSMTP();
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Host =  $_ENV['mail_host'];
            $mail->Port = 465;
            $mail->Username = $_ENV['mail_user'];
            $mail->Password =$_ENV['mail_pass'] ;

            //Recipients
            $mail->setFrom($_ENV["sms_user"], 'PMP');
            $mail->addAddress($dest);

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'PMP';
            $mail->addEmbeddedImage($img,"logo");
            $mail->Body    = $message;

            $mail->send();
            return 'Message has been sent';
        } catch (Exception $e) {
            return "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

    }



}