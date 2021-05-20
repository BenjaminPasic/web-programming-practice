<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//Load in FlightPHP
require_once dirname(__FILE__).'/../vendor/autoload.php';

//Load in routes
require_once dirname(__FILE__).'/routes/middleware.php';
require_once dirname(__FILE__).'/routes/users.php';

//Load in services
require_once dirname(__FILE__).'/services/UsersService.class.php';

//Register services
Flight::register("usersService", "UsersService");

//error handling
/*Flight::map('error', function(Exception $ex){
  Flight::json(["message" => $ex->getMessage()], $ex->getCode() ? $ex->getCode() : 500);
});*/


Flight::route('/swagger', function(){
    Flight::redirect('/docs');
});


Flight::start();





