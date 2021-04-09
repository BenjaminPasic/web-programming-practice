<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



require_once dirname(__FILE__).'/../vendor/autoload.php';

// Create the Transport
$transport = (new Swift_SmtpTransport('smtp.googlemail.com', 587, 'tls'))
  ->setUsername('emilsenderweb@gmail.com')
  ->setPassword('amdpulse')
;

// Create the Mailer using your created Transport
$mailer = new Swift_Mailer($transport);

// Create a message
$message = (new Swift_Message('Wonderful Subject'))
  ->setFrom(['emilsenderweb@gmail.com' => 'emailsender'])
  ->setTo(['benjamin.pasic1@gmail.com'])
  ->setBody('Here is the message itself');

// Send the message
$result = $mailer->send($message);

print_r($result);
