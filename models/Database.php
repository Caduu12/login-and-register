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

        $this->conn = new \PDO('mysql:host' . $host . '=;dbname=' . $database, $username, $password);
        $this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        return $this->conn;
    }

// Select

    public function select($attrArray = null, $argSelect = '*')
    {
        if (isset($attrArray)) {
            $attrNames = array_keys($attrArray);
            $arrayLength = count($attrArray) - 1;
            $attributes = "";

            for ($x = 0; $x <= $arrayLength; ++$x) {

                $condition = " WHERE ";
                if ($x >= 1) {
                    $condition = " AND ";
                }
                $attributes .= $condition . $attrNames[$x] . " = " . "'" . $attrArray[$attrNames[$x]] . "'";
            }
            return $this->conn->query("SELECT " . $argSelect . " FROM " . $this->tableName . $attributes)->fetchAll();
        }

        return $this->conn->query("SELECT " . $argSelect . " FROM " . $this->tableName)->fetchAll();
    }

// Select com duas tabelas

    public function selectJoin( $typeOfJoin, $nameOfJoinTable, $joinCondition, $argSelect = "*")
    {
        $joinConditionUntrim = "";

        foreach($joinCondition as $key => $value) {
            $joinConditionUntrim .= $key . "." . $value . " = ";
            $joinConditionTrim = rtrim($joinConditionUntrim, " = ");
        }
       
        return $this->conn->query("SELECT " . $argSelect . " FROM `" . $this->tableName . "` " . $typeOfJoin . " `" . $nameOfJoinTable . "`  ON " . $joinConditionTrim)->fetchAll();
    }

// Select somente com um resultado

    public function selectOne($arraySelectOne, $argSelectOne = '*')
    {
        $attributes = "";
        $attrNames = array_keys($arraySelectOne);
        $arrayIndexes = count($arraySelectOne) - 1;

        for ($x = 0; $x <= $arrayIndexes; ++$x) {
            if ($x >= 1 ) {
                $attributes .= " AND ";
            } 

            $attributes .= "`" . $attrNames[$x] . "` = '" . $arraySelectOne[$attrNames[$x]] . "'";
        }
        return $this->conn->query("SELECT " . $argSelectOne . " FROM " . $this->tableName . " WHERE " . $attributes . " LIMIT 1")->fetchAll();
    }

// Insert Into

    public function insert($attrValues)
    {
        $attrNames = array_keys($attrValues);
        $arrayIndex = count($attrValues) - 1;
        $tableAttr = "";
        $values = "";

        for ($x = 0; $x <= $arrayIndex; ++$x) {
            $tableAttr .= " `" . $attrNames[$x] . "`";

            $values .= " '" . $attrValues[$attrNames[$x]] . "'";
            
            if ($x < $arrayIndex) {
                $tableAttr .= ",";
                $values .= ",";
            }
        }
        return $this->conn->query("INSERT INTO " . $this->tableName . " ( " . $tableAttr . " ) VALUES (" . $values .  ")")->fetchAll();
    }

// Update

    // public function update($valuesToUpdate, $attrCompared)
    // {
    //     return $this->conn->query("UPDATE " . $this->tableName . " SET " . $attrToUpdate . " = " . $valueUpdated . " WHERE " . $attrCompared . " = " . $valueCompared);
    // }

// Delete

    public function delete($attrDelete = "id", $valueDelete)
    {
        return $this->conn->query("DELETE FROM " . $this->tableName . " WHERE " . $attrDelete . " = " . $valueDelete);
    }
}
