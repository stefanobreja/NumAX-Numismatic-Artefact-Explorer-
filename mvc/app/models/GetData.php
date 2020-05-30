<?php
ini_set("max_execution_time", 0);

class GetData_model extends Model
{
    function __construct()
    {
        parent::__construct();
    }


    private function getListOfCoinsByCountry($country)
    {
        $opts = array(
            'http' => array(
                'method' => "GET"
            )
        );

        $context = stream_context_create($opts);

        $jsonResponse = file_get_contents("https://qmegas.info/numista-api/country/coins?limit=100&country_id=" . $country, false, $context);

        return json_decode($jsonResponse, true)['list'];
    }

    private function getCoinDetails($id)
    {
        $getdata = http_build_query(
            array(
                'coin_id' => $id
            )
        );

        $opts = array(
            'http' => array(
                'method' => "GET"
            )
        );

        $context = stream_context_create($opts);
        $jsonResponse = file_get_contents("https://qmegas.info/numista-api/coin?" . $getdata, false, $context);
        $model = json_decode($jsonResponse, true);
        return $model;
    }

    function populateDB($countries)
    {
        $dropUserCoin = 'DELETE FROM user_coin';
        $stm = $this->db->prepare($dropUserCoin);
        $stm->execute();
        $dropCoins = 'DELETE FROM coins';
        $stm = $this->db->prepare($dropCoins);
        $stm->execute();

        foreach ($countries as $country) {

            $list = $this->getListOfCoinsByCountry($country);

            for ($i = 0; $i < count($list); $i++) {
                if ($i % 10 == 0) {
                    $id = $list[$i]['id'];
                    $coinDetails = $this->getCoinDetails($id);

                    if ($coinDetails != null) {
                        $this->parseCoinDetailsAndAddToDB($coinDetails);
                    }
                }
            }
        }
        echo ("done");
    }

    private function parseCoinDetailsAndAddToDB($coinDetails)
    {
        $index = 0;
        try {
            $title = array_key_exists('title', $coinDetails) ? $coinDetails['title'] : "Unknown";
            $years = array_key_exists('years_range', $coinDetails) ? $coinDetails['years_range'] : "";
            if (array_key_exists('country', $coinDetails)) {
                $country = array_key_exists('name', $coinDetails['country']) ? $coinDetails['country']['name'] : "Unknown";
            }
            $shape = array_key_exists('shape', $coinDetails) ? $coinDetails['shape'] : "Unknown";
            $size = array_key_exists('diameter', $coinDetails) ? $coinDetails['diameter'] : 0;
            $weight = array_key_exists('weight', $coinDetails) ? $coinDetails['weight'] : 0;

            if (array_key_exists('images', $coinDetails)) {
                if (array_key_exists('obverse', $coinDetails['images'])) {
                    $front_picture = array_key_exists('preview', $coinDetails['images']['obverse']) ? $coinDetails['images']['obverse']['preview'] : "https://cdn.blankstyle.com/files/imagefield_default_images/notfound_0.png";
                }
            }

            if (array_key_exists('images', $coinDetails)) {
                if (array_key_exists('reverse', $coinDetails['images'])) {
                    $back_picture = array_key_exists('preview', $coinDetails['images']['reverse']) ? $coinDetails['images']['reverse']['preview'] : "https://cdn.blankstyle.com/files/imagefield_default_images/notfound_0.png";
                }
            }

            $material = array_key_exists('metal', $coinDetails) ? $coinDetails['metal'] : "Unknown";
            $rarityIndex = array_key_exists('rarity_index', $coinDetails) ? $coinDetails['rarity_index'] : "Unknown";

            $sql = 'INSERT INTO coins (name,years,country,shape,size,weight,front_picture,back_picture,material,rarity_index)
         VALUES (:name,:years,:country,:shape,:size,:weight,:front_picture,:back_picture,:material,:rarity_index)';
            $stm = $this->db->prepare($sql);
            $stm->bindValue(':name', $title);
            $stm->bindValue(":years", $years);
            $stm->bindValue(":country", $country);
            $stm->bindValue(":shape", $shape);
            $stm->bindValue(":size", $size, PDO::PARAM_INT);
            $stm->bindValue(":weight", $weight, PDO::PARAM_INT);
            $stm->bindValue(":front_picture", file_get_contents($front_picture));
            $stm->bindValue(":back_picture", file_get_contents($back_picture));
            $stm->bindValue(":material", $material);
            $stm->bindValue("rarity_index", $rarityIndex);
            $stm->execute();
            $stm->errorInfo();
            echo (($index + 1) . ' item added<\br>');
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
