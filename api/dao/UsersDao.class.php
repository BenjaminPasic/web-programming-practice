<?php

require_once dirname(__FILE__).'/BaseDao.class.php';

class UsersDao extends BaseDao{

    function __construct(){
        parent::__construct('users');
    }

    public function get_user_by_id($id){
        return $this->query("SELECT * FROM users WHERE id = :id", ['id' => $id]);
    }

    public function add_new_user($user){
        return $this->insert($user);
    }

}