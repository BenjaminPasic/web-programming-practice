<?php



  require_once dirname(__FILE__)."/../config.php";

    class BaseDao {
        private $connection;
        private $table;
      //Constructor
      public function __construct($table){
            $this->table = $table;
        try {
            $this->connection = new PDO("mysql:host=".Config::DB_HOST.";dbname=".Config::DB_SCHEMA, Config::DB_USERNAME, Config::DB_PASSWORD);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       } catch(PDOException $e){
            echo "Connection failed: " . $e->getMessage();
          }

        }

      //Insert Data into Database
      protected function insert($tablename,$entity){
        $sql = "INSERT INTO {$tablename} (";
        foreach ($entity as $key => $value){
          $sql = $sql.$key.",";
        }
        $sql = substr($sql,0,-1);
        $sql = $sql.") VALUES (";
        foreach($entity as $key => $value){
          $sql = $sql.":".$key.", ";
        }
        $sql = substr($sql,0,-2);
        $sql = $sql.")";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute($entity);

        $entity['id'] = $this->connection->lastInsertId();
        $array = (array) $entity;
        return $array;
      }

      //Update data in the database, note: "$id_column = "id" " essentialy means
      //that if the parameter isn't given, the default value is "id", however
      // if we pass an attribute for the id column, it gets overided by that value!
      protected function execute_update($table,$id,$entity, $id_column = "id"){

        $sql = "UPDATE {$table} SET ";
        foreach ($entity as $key => $value) {
          $sql .= $key."= :".$key.", ";
        }
        $sql = substr($sql,0,-2);
        $sql = $sql. " WHERE {$id_column} = :id";
        $entity['id'] = $id;

        $stmt = $this->connection->prepare($sql);
        $stmt->execute($entity);
      }

      //Executes Queries
      protected function query($query, $params){
        $stmt = $this->connection->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
      }

      //Execute query on a single row in database
      protected function query_unique($query,$params){
        $results = $this->query($query,$params);
        return reset($results);
      }

      public function add($entity){
        return $this->insert($this->table,$entity);
      }

      public function update($id,$entity){
        $this->execute_update($this->table,$id,$entity);
      }

      public function get_by_id($id){
        return $this->query_unique("SELECT * FROM {$this->table} WHERE id = :id",["id" => $id]);
      }

  }



?>
