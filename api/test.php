<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

  require_once dirname(__FILE__)."/dao/UserDao.class.php";
  require_once dirname(__FILE__)."/dao/AccountDao.class.php";
  require_once dirname(__FILE__)."/dao/CampaignDao.class.php";

  $dao = new UserDao();

  $users = $dao->get_all();
  echo json_encode($users,JSON_PRETTY_PRINT);


 ?>
