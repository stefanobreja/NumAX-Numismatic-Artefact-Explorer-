<?php

class Database
{

    private static $_Database = null;
    private $_PDO = null;
    private $_query = null;
    private $_error = false;
    private $_results = [];
    private $_count = 0;

    private function __construct()
    {
        try {
            $host = "";
            $name = "";
            $username = "";
            $password = "";
            $this->_PDO = new PDO("mysql:host={$host};dbname={$name}", $username, $password);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
}