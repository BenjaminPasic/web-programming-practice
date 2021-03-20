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
   $data = Flight::request()->data->getData();;
   Flight::accountService()->add($data);
});

//Update existing account
Flight::route('PUT /accounts/@id', function($id){
  $data = Flight::request()->data->getData();
  Flight::json(Flight::accountService()->update($id,$data));
});
