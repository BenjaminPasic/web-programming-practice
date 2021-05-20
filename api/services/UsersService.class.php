<?php

require_once dirname(__FILE__).'/../dao/UsersDao.class.php';
require_once dirname(__FILE__).'/../clients/EmailSender.php';
require_once dirname(__FILE__).'/../Config.php';

use Firebase\JWT\JWT;

class UsersService{

    private $dao;
    private $emailSender;

    function __construct(){
        $this->dao = new UsersDao();
        $this->emailSender = new EmailSender();
    }

    public function get_user_by_id($id){

        $db_user = $this->dao->get_user_by_id($id);

        if(!isset($db_user)) throw new Exception("User doesn't exist.");

        return $db_user;
    }

    public function register($data){

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
            "email" => $data['email'],
            "token" => md5(random_bytes(16)),
            "token_created_at" => date(Config::DATE_FORMAT)
        ];

        try{
            $filtered_data = [
                'name' => $data['name'],
                "surname" => $data['surname'],
                "username" => $data['username'],
                "password" => $data['password'],
                "email" => $data['email'],
                "token" => md5(random_bytes(16)),
                "token_created_at" => date(Config::DATE_FORMAT)
            ];

            //Adds user to the database
            $this->dao->add_new_user($filtered_data);

            //Sends email with the registration token
            $this->emailSender->send_registration_token($filtered_data);
        }catch(Exception $e){
            throw new Exception($e);
        }
        

        return ["message" => "New user added"];

    }

    public function login($data){
        
        $db_user = $this->dao->get_user_by_email($data['email']);

        if(!isset($db_user['email'])) throw new Exception("User with the given email doesn't exist.");
        if($db_user['password'] != $data['password']) throw new Exception("Invalid password.");

        $payload = [
            "exp" => (time() + Config::JWT_TOKEN_TIME),
            "id" => $db_user['id'],
            "role" => $db_user['role']
        ];

        $jwt = JWT::encode($payload, Config::JWT_SECRET);

        return ["token" => $jwt];

    }

    public function confirm_token($token){

        $db_user = $this->dao->get_user_by_token($token);

        if(!isset($db_user['id'])) throw new Exception("No registration token available");
        
        $this->dao->update_user(['status' => 'ACTIVE', 'token' => NULL], $db_user['id']);

        return ['message' => "Registration successful."];
    }

}