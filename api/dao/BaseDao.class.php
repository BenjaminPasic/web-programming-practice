<?php

  require_once dirname(__FILE__)."/../config.php";

    class BaseDao {
        private $connection;
      //Constructor
      public function __construct(){
        try {
            $this->connection = new PDO("mysql:host=".Config::DB_HOST.";dbname=".Config::DB_SCHEMA, Config::DB_USERNAME, Config::DB_PASSWORD);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       } catch(PDOException $e){
            echo "Connection failed: " . $e->getMessage();
          }

        }

      //Insert Data into Database
      public function insert($query,$params){
        $stmt = $this->connection->prepare($query);
        $stmt->execute($params);
        $params['id'] = $this->connection->lastInsertId();
        $array = (array) $params;
        return $array;
      }

      //Update data in the database
      public function update($query,$params){
        $stmt = $this->connection->prepare($query);
        $stmt->execute($params);
      }

      //Executes Queries
      public function query($query, $params){
        $stmt = $this->connection->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
      }

      //Execute query on a single row in database
      public function query_unique($query,$params){
        $results = $this->query($query,$params);
        return reset($results);
      }

    }

?>
