<?php
  require_once dirname(__FILE__)."/dao/UserDao.class.php";

  $user_dao = new UserDao();

  $user = [
    "name" => "Suada Pasic",
    "email" => "ada61dejo.pasic@gmail.com",
    "password" => "ddd123",
    "account_id" => 1
  ];

  $user_dao->update_user(18,$user);





 ?>
