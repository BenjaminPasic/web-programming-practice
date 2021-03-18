<?php

Flight::register('accountDao','AccountDao');

// get functions based on limiter and delmitier
Flight::route('GET /accounts', function(){
   $accounts = Flight::accountDao()->get_all(0,10);
   Flight::json($accounts);
});

//Get single account by id
Flight::route('GET /accounts/@id', function($id){

   $accounts = Flight::accountDao()->get_by_id($id);
   Flight::json($accounts);

});

// Add new account
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
