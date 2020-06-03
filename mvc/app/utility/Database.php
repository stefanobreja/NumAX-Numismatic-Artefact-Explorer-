<?php

class Database
{

    private static $_Database = null;
    public $_PDO;

    function __construct()
    {
        try {
            $host = "localhost";
            $name = "numax";
            $username = "root";
            $password = "";
            $this->_PDO = new PDO("mysql:host={$host};dbname={$name};charset=utf8", $username, $password);
            // $this->_PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // $this->_PDO->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            // $this->_PDO->setAttribute(PDO::ATTR_PERSISTENT, TRUE);
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

    public function getAllCoins()
    {
        $sql = "SELECT * FROM coins";
        $sth = $this->_PDO->prepare($sql);
        $sth->execute();
        return $sth->fetchAll();
    }

    function populateDB($q)
    {
        $drop = 'DELETE FROM coins';
        $stm = $this->_PDO->prepare($drop);
        $stm->execute();
        $list = $this->getCoinsFromNumista($q);
        for ($i = 0; $i < count($list['coins']); $i++) {
            $id = $list['coins'][$i]['id'];
            $coinDetails = $this->getCoinDetailsFromNumista($id);

            if ($coinDetails != null) {

                $title = array_key_exists('title', $coinDetails) ? $coinDetails['title'] : "Unknown";
                $min_year = array_key_exists('minYear', $coinDetails) ? $coinDetails['minYear'] : 0;
                $max_year = array_key_exists('maxYear', $coinDetails) ? $coinDetails['maxYear'] : 0;
                if (array_key_exists('issuer', $coinDetails)) {
                    $country = array_key_exists('name', $coinDetails['issuer']) ? $coinDetails['issuer']['name'] : "Unknown";
                }
                $shape = array_key_exists('shape', $coinDetails) ? $coinDetails['shape'] : "Unknown";
                $size = array_key_exists('size', $coinDetails) ? $coinDetails['size'] : 0;
                $weight = array_key_exists('weight', $coinDetails) ? $coinDetails['weight'] : 0;
                if (array_key_exists('obverse', $coinDetails)) {
                    $front_picture = array_key_exists('picture', $coinDetails['obverse']) ? $coinDetails['obverse']['picture'] : "https://cdn.blankstyle.com/files/imagefield_default_images/notfound_0.png";
                }
                if (array_key_exists('reverse', $coinDetails)) {
                    $back_picture = array_key_exists('picture', $coinDetails['reverse']) ? $coinDetails['reverse']['picture'] : "https://cdn.blankstyle.com/files/imagefield_default_images/notfound_0.png";
                }
                if (array_key_exists('composition', $coinDetails)) {
                    $material = array_key_exists('text', $coinDetails['composition']) ? $coinDetails['composition']['text'] : "Unknown";
                }

                $sql = 'INSERT INTO coins (name,min_year,max_year,country,shape,size,weight,front_picture,back_picture,material)
                    VALUES (?,?,?,?,?,?,?,?,?,?)';
                $stm = $this->_PDO->prepare($sql);
                $stm->bindValue(1, $title);
                $stm->bindValue(2, $min_year);
                $stm->bindValue(3, $max_year);
                $stm->bindValue(4, $country);
                $stm->bindValue(5, $shape);
                $stm->bindValue(6, $size);
                $stm->bindValue(7, $weight);
                $stm->bindValue(8, file_get_contents($front_picture));
                $stm->bindValue(9, file_get_contents($back_picture));
                $stm->bindValue(10, $material);

                $stm->execute();
                $stm->errorInfo();
            }
        }
    }

    private
    function getCoinsFromNumista($q)
    {
        $getdata = http_build_query(
            array(
                'q' => $q,
                'page' => '1',
                'count' => '5',
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

        return json_decode($jsonResponse, true);
    }

    private
    function getCoinDetailsFromNumista($id)
    {
        $opts = array(
            'http' => array(
                'method' => "GET",
                'header' => "accept: application/json \n" .
                    "Numista-API-Key: 4RFQtlWBhBdYre1hMZ48JnVt1dIfUfsFisWkoQJA"
            )
        );

        $context = stream_context_create($opts);
        $jsonResponse = file_get_contents("https://api.numista.com/api/v1/coins/$id", false, $context);
        $model = json_decode($jsonResponse, true);
        return $model;
    }
}
