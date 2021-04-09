<?php

require_once dirname(__FILE__).'/../../vendor/autoload.php';
require_once dirname(__FILE__).'/../config.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class SMTPClient{

  private $mailer;

  public function __construct(){
    $transport = (new Swift_SmtpTransport(Config::SMTP_HOST, Config::SMTP_PORT))
      ->setUsername(Config::SMTP_USER)
      ->setPassword(Config::SMTP_PASSWORD)
    ;
    // Create the Mailer using your created Transport
    $this->mailer = new Swift_Mailer($transport);
  }

  public function send_register_user_token($user){

    $message = (new Swift_Message('Confirm your account'))
      ->setFrom(['emailsenderweb@gmail.com' => 'Autoresponder'])
      ->setTo([$user['email']])
      ->setBody('Here is the confirmation link: http://localhost/folder/api/users/confirm/'.$user['token']);

      $this->mailer->send($message);
  }
}
