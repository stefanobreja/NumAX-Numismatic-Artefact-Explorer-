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

    function populateDB()
    {
        $getdata = http_build_query(
            array(
                'q' => 'romania',
                'page' => '1',
                'count' => '2',
                'lang' => 'en'
            )
        );

        $opts = array(
            'http' => array(
                'method' => "GET",
                'header' => "accept: application/json \n" .
                    "Numista-API-Key: 4RFQtlWBhBdYre1hMZ48JnVt1dIfUfsFisWkoQJA"
            )
        );
        $context = stream_context_create($opts);

        $jsonResponse = file_get_contents("https://api.numista.com/api/v1/coins?" . $getdata, false, $context);

        $model = json_decode($jsonResponse, true);
//        print_r(var_dump($model['coins']));

        $id = $model['coins'][0]['id'];
        $jsonResponse = file_get_contents("https://api.numista.com/api/v1/coins/$id", false, $context);
        $model = json_decode($jsonResponse, true);
        $picture = $model['obverse']['picture'];
        echo "<img src=$picture alt='error'>";


    }
}

