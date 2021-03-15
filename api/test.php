<?php
  require_once dirname(__FILE__)."/dao/UserDao.class.php";

  $user_dao = new UserDao();

  $user1 = [
    "name" => "John Doe",
    "email" => "jdoe@gmail.com",
    "password" => "bruuhjdoe",
    "account_id" => 1
  ];

  //$returned = $user_dao->add_user($user1);
  //print_r($returned);
 ?>
