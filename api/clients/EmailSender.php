<?php


require_once dirname(__FILE__).'/../../vendor/autoload.php';
require_once dirname(__FILE__).'/../Config.php';


class EmailSender{


    private $mailer;

    function __construct(){

        // Create the Transport
        $transport = (new Swift_SmtpTransport(Config::SMTP_HOST, Config::SMTP_PORT, 'ssl'))
        ->setUsername(Config::SMTP_EMAIL)
        ->setPassword(Config::SMTP_PASSWORD);

        // Create the Mailer using your created Transport
        $this->mailer = new Swift_Mailer($transport);

    }

    public function send_registration_token($user){

        $message = (new Swift_Message('Registration Token'))
        ->setFrom(Config::SMTP_EMAIL)
        ->setTo([$user['email']])
        ->setBody("This is your registration token: https://localhost/web-programming-practice/api/confirm/".$user['token']);

        // Send the message
        $result = $this->mailer->send($message);
    }


}