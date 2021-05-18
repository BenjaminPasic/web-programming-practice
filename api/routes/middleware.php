<?php

require_once dirname(__FILE__).'/../Config.php';
use Firebase\JWT\JWT;

Flight::route('/admin/*', function(){

    $headers = getallheaders();
    $token = $headers['Authentication'];
    $decoded = (array) JWT::decode($token, Config::JWT_SECRET, ["HS256"]);

    Flight::set('user', $decoded);
    
    if($decoded['role'] != 'ADMIN') throw new Exception("You need administrator privilages to continue.");

    return TRUE;
});

Flight::route('/user/*', function(){

    $headers = getallheaders();

    if(!isset($headers['Authentication'])) throw new Exception("You have to log in first to continue.");

    $token = $headers['Authentication'];
    $decoded = (array) JWT::decode($token, Config::JWT_SECRET, ["HS256"]);

    Flight::set('user', $decoded);

    return TRUE;
});
