<?php
  require_once dirname(__FILE__)."/BaseDao.class.php";

  //Extended BaseDao to inherit basic CRUD operations
  class UserDao extends BaseDao{

    public function get_user_by_email($email){
      return $this->query_unique("SELECT * FROM users WHERE email = :email",["email" => $email]);
    }

    public function get_user_by_id($id){
      return $this->query_unique("SELECT * FROM users WHERE id = :id",["id" => $id]);
    }

    public function add_user($user){
      $a = $this->insert("INSERT INTO users (name,email,password,account_id) VALUES (:name, :email, :password, :account_id)",$user);
      return $a;
    }

    public function update_user($id, $user){
      $sql = "UPDATE users SET ";
      foreach ($user as $key => $value) {
        $sql .= $key."= :".$key.", ";
      }
      $sql = substr($sql,0,-2);
      $sql = $sql. " WHERE id = :id";
      $user['id'] = $id;

      $this->update($sql,$user);
    }


  }

?>
