<?php
require_once dirname(__FILE__).'/../dao/UsersDao.class.php';

class UsersService{

    private $dao;

    function __construct(){
        $this->dao = new UsersDao();
    }

    public function get_user_by_id($id){

        $db_user = $this->dao->get_user_by_id(1);

        if(!isset($db_user)) throw new Exception("User doesn't exist.");

        return $db_user;
    }

}