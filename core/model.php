<?php

class Model
{

    public static $conn = '';

    public string $ModelName = '';

    private $object = [];
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
            $this->object = $this->doSelect('select * from tbl_'.$this->ModelName);
            var_dump($this->object);
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
        return $result;
    }

    function where($where = '' , $values = [], $fetch = '', $fetchstyle = PDO::FETCH_ASSOC)
    {
        $sql = "select * from tbl_".$this->ModelName." where ".$where."=?";
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
        return $result;
    }




}

?>