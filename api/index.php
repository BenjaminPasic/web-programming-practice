<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require dirname(__FILE__).'/../vendor/autoload.php';
require dirname(__FILE__).'/dao/AccountDao.class.php';

Flight::register('accountDao','AccountDao');

Flight::route('GET /accounts', function(){
   $accounts = Flight::accountDao()->get_all(0,10);
   Flight::json($accounts);
});

Flight::route('GET /accounts/@id', function($id){

   $accounts = Flight::accountDao()->get_by_id($id);
   Flight::json($accounts);

});

Flight::route('POST /accounts', function(){
   $request = Flight::request();
   $data = $request->data->getData();

   $account = Flight::accountDao()->add($data);
   print_r($account);
});

//Update existing account
Flight::route('PUT /accounts/@id', function($id){
  $request = Flight::request();
  $data = $request->data->getData();

  Flight::accountDao()->update($id,$data);
  $updatedAccount = Flight::accountDao()->get_by_id($id);
  Flight::json($updatedAccount);
});


Flight::start();

?>
