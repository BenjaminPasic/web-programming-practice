<?php

  require_once dirname(__FILE__)."/dao/UserDao.class.php";
  require_once dirname(__FILE__)."/dao/AccountDao.class.php";

  $dao = new AccountDao();

  $account = [
    "name" => "Green Hosting",
    "created_at" => date("Y-m-d H:i:s")
  ];

  $resultset = $dao->add_account($account);
  print_r($resultset);


 ?>
