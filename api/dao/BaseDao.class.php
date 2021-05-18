<?php

require_once dirname(__FILE__).'/../Config.php';

class BaseDao {

    private $connection;
    private $table_name;

    function __construct($table_name){
        
        try {
            $this->table_name = $table_name;
            $this->connection = new PDO("mysql:host=".Config::DB_HOST.";dbname=".Config::DB_NAME, Config::DB_USERNAME, Config::DB_PASSWORD);
            // set the PDO error mode to exception
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            }

    }

    protected function query($sql, $params){
        $statement = $this->connection->prepare($sql);
        $statement->execute($params);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    protected function insert($params){
        $sql = "INSERT INTO {$this->table_name} (";
        foreach($params as $key => $value){
            $sql .= $key . ', ';
        }
        $sql = substr($sql, 0, -2) . ') VALUES (';
        foreach($params as $key => $value){
            $sql .= ':' . $key . ', ';
        }
        $sql = substr($sql, 0, -2) . ')';

        $statement = $this->connection->prepare($sql);
        $statement->execute($params);

        $params['id'] = $this->connection->lastInsertId();
        return $params;
    }

    protected function update($params, $id){
        $sql = "UPDATE {$this->table_name} SET ";

        foreach($params as $key => $value){
            $sql .= $key . '= :' . $key . ', '; 
        }

        $sql = substr($sql, 0, -2);
        $sql .= ' WHERE id = :id';

        $params['id'] = $id;

        $statement = $this->connection->prepare($sql);
        $statement->execute($params);
    }
        
}