<?php

class avatar extends Model
{

    public $dbname = 'avatar';
    function __construct()
    {
        parent::__construct($this->dbname);
    }

    function addavatar(){
        //var_dump($this->InsertInto(['img','coin'],['reza','20']));
    }


}