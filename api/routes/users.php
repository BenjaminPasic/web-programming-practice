<?php
/**
 * @OA\Info(title="Online Chatroom", version="1.0.0"),
 * @OA\OpenApi(
 *   @OA\Server(url="https://localhost/web-programming-practice/api/", description="Online chatroom project")
 * ),
 * @OA\SecurityScheme(securityScheme="ApiKeyAuth", type="apiKey", in="header", name="Authentication")
 */

/**
 * @OA\Get(path="/admin/user/{id}", tags={"admin"},
 *    @OA\Parameter(@OA\Schema(type="string"), default=60, name= "id",description = "Id of the user you want to search", in="path", allowReserved=true),
 *    @OA\Response(response="200", description="Token")
 * )
 */
Flight::route('GET /admin/user/@id', function($id){
    Flight::json(Flight::usersService()->get_user_by_id($id));
});

/**
 * @OA\Post(path="/register", tags={"login"},
 *   @OA\RequestBody(description="Basic user info", required=true,
 *       @OA\MediaType(mediaType="application/json",
 *    			@OA\Schema(
 *    				 @OA\Property(property="name", required="true", type="string", example="John",	description="Name of the user" ),
 *     				 @OA\Property(property="surname", required="true", type="string", example="Doe",	description="Surname of the user" ),
 *    				 @OA\Property(property="username", required="true", type="string", example="jdoe",	description="Username of the user" ),
 *             @OA\Property(property="password", required="true", type="string", example="12345",	description="Password"),
 *             @OA\Property(property="email", required="true", type="string", example="myemail@gmail.com",	description="Email of the user")
 *          )
 *       )
 *     ),
 *  @OA\Response(response="200", description="Message that user has been created.")
 * )
 */
Flight::route('POST /register', function(){
    $data = Flight::request()->data->getData();
    Flight::json(Flight::usersService()->register_user($data));
});