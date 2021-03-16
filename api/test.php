<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

  require_once dirname(__FILE__)."/dao/UserDao.class.php";
  require_once dirname(__FILE__)."/dao/AccountDao.class.php";

  $dao = new UserDao();

  $resultset = $dao->get_user_by_email("benjamin.pasic@gmail.com");

  print_r($resultset);


 ?>
