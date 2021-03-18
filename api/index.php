<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once dirname(__FILE__).'/../vendor/autoload.php';
require_once dirname(__FILE__).'/dao/AccountDao.class.php';
require_once dirname(__FILE__).'/routes/accounts.php';

Flight::register('accountDao','AccountDao');

Flight::map('query',function($name, $default_value = NULL){
    $request = Flight::request();
    $queryparam = @$request->query->getData()[$name];
    $query_param = $queryparam ? $queryparam : $default_value;

    return $query_param;
});

Flight::start();

?>
