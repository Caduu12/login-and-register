<?php

include 'Database.php';


class Tickets extends Database
{
    private $tableName = 'tickets';

    public function __construct()
    {
        parent::__construct($this->tableName);
    }

}
