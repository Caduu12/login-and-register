<?php

include 'Database.php';


class Travel extends Database
{
    private $tableName = 'tickets';

    public function __construct()
    {
        parent::__construct($this->tableName);
    }

}
