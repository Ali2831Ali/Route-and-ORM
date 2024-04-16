<?php

class user extends Model
{

    function __construct($modelname)
    {
        parent::__construct($modelname);
    }

    function user(){
        var_dump($this->where('id',[22]));
    }


}

?>