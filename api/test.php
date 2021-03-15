<?php
  require_once dirname(__FILE__)."/dao/UserDao.class.php";

  $user_dao = new UserDao();

  $user = [
    "password" => "ada61adi"
  ];

  $user_dao->update_user(18,$user);





 ?>
