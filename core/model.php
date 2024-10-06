<?php

class Model
{

    public static $conn = '';

    public string $ModelName = '';

    public static $sql = '';
    public $VforWhere = [];
    public $VforSql = [];

    public $error = [];

    function __construct($ModelName = '')
    {
        try {
            $attr = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
            self::$conn = new PDO('mysql:host=' . hostname . ';dbname=' . DBname, DBusername, DBpassword, $attr);
            self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
        if ($ModelName != '') {
            $this->ModelName = $ModelName;
        } else {
            $ModelName = 'index';
        }

    }


    function Where($where = '', $value = '')
    {
        if ($this->SqlChecker()) $this->error[] = "sql digari dar hal ejrast";
        if ($where == '') $this->error[] = 'shart where khod ra vared konid';
        if ($value == '') $this->error[] = 'value where ro vared konid';
        self::$sql = "select * from tbl_" . $this->ModelName . " where " . $where . "=?";
        $value = array($value);
        $this->VforWhere = $value;
    }

    function AndWhere($where = '', $value = '')
    {
        if (!$this->WhereChecker()) $this->error[] = 'aval where ro vared konid bad andwhere bezanid';
        if ($where == '') $this->error[] = 'shart khod ra vared konid';
        if ($value == '') $this->error[] = 'value where ro vared konid';
        $values = array_merge($this->VforWhere, [$value]);
        self::$sql = self::$sql . " and " . $where . "=?";
        $this->VforWhere = $values;

    }

    function OrWhere($where = '', $value = '')
    {
        if (!$this->WhereChecker()) $this->error[] = 'aval where ro vared konid bad andwhere bezanid';
        if ($where == '') $this->error[] = 'shart khod ra vared konid';
        if ($value == '') $this->error[] = 'value where ro vared konid';
        $values = array_merge($this->VforWhere, [$value]);
        self::$sql = self::$sql . " or " . $where . "=?";
        $this->VforWhere = $values;
    }

    function InsertInto($fields = [], $values = [])
    {
        if ($this->SqlChecker()) $this->error[] = 'sql digari dar hal ejrast';
        $FieldStr = implode(",", $fields);
        $ValuesStr = '';
        for ($i = 0; $i < count($values) - 1; $i++) {
            $ValuesStr = $ValuesStr . "?,";
        }
        $ValuesStr = $ValuesStr . "?";

        if (count(explode(',', $ValuesStr)) != count(explode(',', $FieldStr))) $this->error[] = 'tedad value ba filed yeki nis';
        self::$sql = 'insert into tbl_' . $this->ModelName . ' (' . $FieldStr . ') VALUES (' . $ValuesStr . ')';
        $this->VforSql = $values;
    }


    function Update($fields = [], $where = '', $values = [])
    {
        //akarin value bara shart where
        if ($this->SqlChecker()) $this->error[] = 'sql digari dar hal ejrast';
        $SetValues = '';
        for ($i = 0; $i < count($fields) - 1; $i++) {
            $SetValues = $SetValues . $fields[$i] . ' =? , ';
        }
        $SetValues = $SetValues . $fields[count($fields) - 1] . ' =?';

        if (count($values) - 1 != count($fields)) $this->error[] = 'tedad value ba filed yeki nis';
        self::$sql = 'update tbl_' . $this->ModelName . ' set ' . $SetValues . ' where ' . $where . '=?';
        $this->VforSql = $values;
    }

    function Delete($where = '', $value = '')
    {
        if ($this->SqlChecker()) $this->error[] = 'sql digari dar hal ejrast';
        self::$sql = 'DELETE FROM tbl_' . $this->ModelName . ' WHERE ' . $where . '=?';
    }


    function SqlChecker()
    {
        if (self::$sql != '') {
            return TRUE;
        }
    }

    // function haye karbordi
    function WhereChecker()
    {
        if (count($this->VforWhere) != 0) {
            return TRUE;
        } else {
            return false;
        }
    }

    function finishQuery(){
        if (count($this->error) != 0){
            return $this->error;
        }elseif ($this->WhereChecker()){
            $result = $this->doSelect(self::$sql, $this->VforWhere);
            if (!$result) return 'natije ii peida nashod';
            foreach ($this->VforWhere as $key => $row) {
                unset($this->VforWhere[$key]);
            }
            self::$sql = '';
            return $result;
        }elseif ($this->SqlChecker()){
            $this->doQuary(self::$sql,$this->VforSql);
            self::$sql='';
            return 'sql ba movafaghiat anjam shod';
        }
    }

    function doQuary($sql, $values = [])
    {
        $stmt = self::$conn->prepare($sql);

        if (gettype($values) == "array") {
            foreach ($values as $key => $value) {
                $stmt->bindValue($key + 1, $value);
            }
        } else {
            $stmt->bindValue(1, $values);
        }

        try {
            $stmt->execute();
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }


    }


    function doSelect($sql, $values = [], $fetch = '', $fetchstyle = PDO::FETCH_ASSOC)
    {
        $stmt = self::$conn->prepare($sql);
        foreach ($values as $key => $value) {
            $stmt->bindValue($key + 1, $value);
        }

        try {
            $stmt->execute();
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }

        if ($fetch == '') {
            $result = $stmt->fetchAll($fetchstyle);
        } else {
            $result = $stmt->fetch($fetchstyle);
        }

        return $result;
    }


}

?>