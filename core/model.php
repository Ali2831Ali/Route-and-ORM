<?php

class Model
{

    public static $conn = '';

    public string $ModelName = '';

    public static $sql = '';
    public $object = [];
    public $VforWheres = [];


    function __construct($ModelName='')
    {
        try {
            $attr = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
            self::$conn = new PDO('mysql:host=' . hostname . ';dbname=' . DBname, DBusername,DBpassword, $attr);
            self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
        if ($ModelName!=''){
            $this->ModelName = $ModelName;
            self::$sql='select * from tbl_'.$this->ModelName;
            $this->object = $this->where();
        }else{
            $ModelName='index';
        }

    }


    function Where($where = '' , $values = [])
    {
        if ($where!='') self::$sql = "select * from tbl_".$this->ModelName." where ".$where."=?";
        $result = $this->doSelect(self::$sql,$values);
        if ($result){
            foreach ($values as $value){
                $this->VforWheres[] = $value;
            }
            return $result;
        }else{
            return 'natije ii peida nashod';
        }
    }

    function AndWhere($where = '' , $values=[]){
        if ($this->WhereChecker()){
            if ($where!='') {
                $values = array_merge($this->VforWheres, $values);
                self::$sql = self::$sql . " and " . $where . "=?";
                $result = $this->doSelect(self::$sql, $values);
                if ($result) {
                    $this->VforWheres = array_unique($values);
                    return $result;
                }else return 'natije ii peida nashod';
            }else return 'shart khod ra vared konid';
        }else return 'aval where ro vared konid bad andwhere bezanid';
    }
    
    function OrWhere($where = '' , $values=[]){
        if ($this->WhereChecker()) {
            if ($where!='') {
                $values = array_merge($this->VforWheres, $values);
                self::$sql = self::$sql . " or " . $where . "=?";
                $result = $this->doSelect(self::$sql, $values);
                if ($result) {
                    $this->VforWheres = array_unique($values);
                    return $result;
                } else return 'natije ii peida nashod';
            }else return 'shart khod ra vared konid';
        }else return 'aval where ro vared konid bad andwhere bezanid';
    }

    function Endwhere(){
        foreach ($this->VforWheres as $key => $row){
            unset($this->VforWheres[$key]);
        }
        self::$sql = '';
    }

    function WhereChecker(){
        if (count($this->VforWheres)!=0){
            return TRUE;
        }else{
            return false;
        }
    }

     function doSelect($sql, $values = [], $fetch = '', $fetchstyle = PDO::FETCH_ASSOC)
    {
        $stmt = self::$conn->prepare($sql);
        foreach ($values as $key => $value) {
            $stmt->bindValue($key + 1, $value);
        }
        $stmt->execute();
        if ($fetch == '') {
            $result = $stmt->fetchAll($fetchstyle);
        } else {
            $result = $stmt->fetch($fetchstyle);
        }
        if (count($result)==0) return false;
        else return $result;
    }



}

?>