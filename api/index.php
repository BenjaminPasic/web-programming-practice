<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//Register FLIGHTPhp
require_once dirname(__FILE__).'/../vendor/autoload.php';
//Include Services
require_once dirname(__FILE__).'/services/AccountService.class.php';
require_once dirname(__FILE__).'/services/UserService.class.php';
//Include Routes
require_once dirname(__FILE__).'/routes/accounts.php';
require_once dirname(__FILE__).'/routes/users.php';

//Register Business Logic Layer Services
Flight::register('accountService','AccountService');
Flight::register('userService','UserService');

Flight::map('query',function($name, $default_value = NULL){
    $request = Flight::request();
    $queryparam = @$request->query->getData()[$name];
    $query_param = $queryparam ? $queryparam : $default_value;

    return $query_param;
});

Flight::start();

?>
