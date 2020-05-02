<?php

class Database
{

    private static $_Database = null;
    private $_PDO = null;

    function __construct()
    {
        try {
            $host = "localhost";
            $name = "NumAX";
            $username = "root";
            $password = "";
            $this->_PDO = new PDO("mysql:host={$host};dbname={$name}", $username, $password);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public static function getInstance()
    {
        if (!isset(self::$_Database)) {
            self::$_Database = new Database();
        }
        return (self::$_Database);
    }

    public function getAll($sql)
    {
        $sth = $this->_PDO->prepare($sql);
        $sth->execute();
        $list = $sth->fetchAll();
        print_r($list);
    }
}

