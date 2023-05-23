<?php

class Database
{
    private $tableName = '';
    private $conn;

    public function __construct($tableName)
    {
        $this->tableName = $tableName;
        $username = 'root';
        $password = null;
        $database = 'teste_developer';
        $host = '127.0.0.1';

        $this->conn = new \PDO('mysql:host'.$host.'=;dbname='.$database, $username, $password);
        $this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        return $this->conn;
    }

    public function select($argSelect = '*')
    {
        return $this->conn->query("SELECT ". $argSelect ." FROM " . $this->tableName)->fetchAll();
    }

    public function selectOne($argSelectOne = '*', $attrSelectOne, $valueSelectOne)
    {
        return $this->conn->query("SELECT ". $argSelectOne ." FROM " . $this->tableName . " WHERE " . $attrSelectOne . " = '" . $valueSelectOne ."' LIMIT 1")->fetchAll();

    }

    public function insert($tableAttr, $attrValues)
    {
        return $this->conn->query("INSERT INTO " . $this->tableName . " ( " . $tableAttr . " ) " . $tableAttr . " VALUES (" . $attrValues .  ")")->fetchAll();
    }

    public function update($valueToUpdate, $valueToComparate)
    {
        return $this->conn->query("UPDATE " . $this->tableName . " SET " . $valueToUpdate . " WHERE " . $valueToComparate);
    }

    public function delete($attrDelete, $valueDelete)
    {
        return $this->conn->query("DELETE FROM " . $this->tableName . " WHERE " . $attrDelete . " = " . $valueDelete);
    }

}
