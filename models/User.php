<?php

include 'Database.php';


class User extends Database
{
    private $tableName = 'users';

    public function __construct()
    {
        parent::__construct($this->tableName);
    }

}
