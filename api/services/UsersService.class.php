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

    public function register_user($data){

        $db_user = $this->dao->get_user_by_email($data['email']);

        if(isset($db_user['id'])) throw new Exception("User with the given email already exists.");

        if(!isset($data['name'])) throw new Exception("You must enter your name.");
        if(!isset($data['surname'])) throw new Exception("You must enter your surname.");
        if(!isset($data['username'])) throw new Exception("You must enter your username.");
        if(!isset($data['password'])) throw new Exception("You must enter your password.");
        if(!isset($data['email'])) throw new Exception("You must enter your email.");


        $filtered_data = [
            'name' => $data['name'],
            "surname" => $data['surname'],
            "username" => $data['username'],
            "password" => $data['password'],
            "email" => $data['email']
        ];

        $this->dao->add_new_user($filtered_data);

        return ["message" => "New user added"];

    }

}