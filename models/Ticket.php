<?php

include 'Database.php';


class Ticket extends Database
{
    private $tableName = 'tickets';

    public function __construct()
    {
        parent::__construct($this->tableName);
    }

}
