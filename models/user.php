<?php

class user extends Model
{
    public $dbname = 'user';
    function __construct()
    {
        parent::__construct($this->dbname);
    }


}

?>