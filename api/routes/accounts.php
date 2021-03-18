<?php

Flight::register('accountDao','AccountDao');

// get functions based on limiter and delmitier
Flight::route('GET /accounts', function(){
  $offset = Flight::query('offset',0);
  $limit = Flight::query('limit',10);
  $search = Flight::query('search');
  Flight::json(Flight::accountService()->get_accounts($search,$offset,$limit));
});

//Get single account by id
Flight::route('GET /accounts/@id', function($id){
   Flight::json(Flight::accountService()->get_by_id($id));
});

// Add new account
Flight::route('POST /accounts', function(){
   $request = Flight::request();
   $data = $request->data->getData();
   $account = Flight::accountService()->add($data);
   print_r($account);
});

//Update existing account
Flight::route('PUT /accounts/@id', function($id){
  $request = Flight::request()->data->getData();
  Flight::json(Flight::accountService()->update($id,$data));
});
