<?php

class user extends Model
{

    function __construct($modelname)
    {
        parent::__construct($modelname);
    }

    function user(){
        var_dump($this->where('id',[48]));
        var_dump($this->Andwhere('name',['ali']));
        $this->Endwhere();
        var_dump($this->where('id',[49]));
        var_dump($this->Andwhere('name',['آرمین']));
        var_dump($this->OrWhere('email',['www.arminarm11ita@gmail.com']));
    }


}

?>