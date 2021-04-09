<?php

/**
 * @OA\Info(title="Practice API", version="0.1")
 */

/**
 * @OA\Get(path="/accounts",
 *     @OA\Response(response="200", description="List accounts from database")
 * )
 */

Flight::route('GET /accounts', function(){
  $offset = Flight::query('offset', 0);
  $limit = Flight::query('limit', 25);
  $search = Flight::query('search');
  $order = Flight::query('order', "-id");

  Flight::json(Flight::accountService()->get_accounts($search, $offset, $limit, $order));
});

/**
 * @OA\Get(path="/accounts/{id}",
 *    @OA\Response(response="200", description="List accounts from database")
 *
 * )
 */

Flight::route('GET /accounts/@id', function($id){
  Flight::json(Flight::accountService()->get_by_id($id));
});

/**
 * @OA\Post(path="/accounts/{id}",
 *    @OA\Parameter(@OA\Schema(type="integer"), description = "Update account"),
 *    @OA\Response(response="200", description="Add account")
 *
 * )
 */

Flight::route('POST /accounts', function(){
  $data = Flight::request()->data->getData();
  Flight::json(Flight::accountService()->add($data));
});

/**
 * @OA\Put(path="/accounts/{id}",
 *    @OA\Parameter(@OA\Schema(type="integer"), in="path", allowReserved=true, name="id", default="1"),
 *    @OA\Response(response="200", description="Update account from database based on id")
 */

Flight::route('PUT /accounts/@id', function($id){
  $data = Flight::request()->data->getData();
  Flight::json(Flight::accountService()->update($id, $data));
});

?>
