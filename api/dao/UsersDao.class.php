<?php

require_once dirname(__FILE__).'/BaseDao.class.php';

class UsersDao extends BaseDao{

    function __construct(){
        parent::__construct('users');
    }

    public function get_user_by_id($id){
        return $this->query_unique("SELECT * FROM users WHERE id = :id", ['id' => $id]);
    }

    public function get_user_by_email($email){
        return $this->query_unique("SELECT * FROM users WHERE email = :email", ['email' => $email]);
    }

    public function add_new_user($user){
        return $this->insert($user);
    }

    public function update_user($user, $id){
        return $this->update($user, $id);
    }

}