<?php
  require_once dirname(__FILE__)."/dao/UserDao.class.php";

  $user_dao = new UserDao();

  $user = $user_dao->get_user_by_email("benjamin.pasic@gmail.com");
  print_r($user);

  $user2 = $user_dao->get_user_by_id("1");
  print_r($user2);


 ?>
