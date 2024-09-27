<?php

class user extends Model
{

    function __construct($modelname)
    {
        parent::__construct($modelname);
    }

    function user(){
        var_dump($this->where('id',48));
        var_dump($this->Andwhere('name','ali'));
        $this->Endwhere();
        var_dump($this->where('id',49));
        var_dump($this->Andwhere('name','آرمین'));
        var_dump($this->OrWhere('email','www.arminarm11ita@gmail.com'));
        $this->Endwhere();
        //var_dump($this->InsertInto(['name','email'],['reza','hasan']));
        var_dump($this->update(['name','email'],'id',['reza','ali@gmail.com',22]));
        var_dump($this->Delete('id',62));
    }

    function edit($attr){
        var_dump($this->Update(['name'],'id',['reza',$attr]));
    }
    function deleteuser($attr){
        var_dump($this->delete('id',$attr));
    }

}

?>