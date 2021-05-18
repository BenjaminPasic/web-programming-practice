<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once dirname(__FILE__).'/dao/UsersDao.class.php';

$dao = new UsersDao();

$user = [
    "name" => "Adnan",
    "surname" => "Pasic",
    "password" => "abc123"
];

print_r($dao->add_new_user($user));



