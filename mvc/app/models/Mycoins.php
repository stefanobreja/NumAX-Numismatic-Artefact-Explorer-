<?php

class Mycoins_model extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    function get_user_coins($username)
    {
        // echo $username . "!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!";
        $sql = "SELECT coins.* FROM coins join user_coin as uc on coins.id = uc.coin_id join users on uc.user_id = users.id 
        WHERE users.username = ?";
        $stm = $this->db->prepare($sql);
        $stm->bindValue(1, $username);
        $stm->execute();
        $results = $stm->fetchAll();
        return $results;
    }

    function getCoinById($id, $username) {
        $sql = "SELECT coins.* FROM coins join user_coin as uc on coins.id = uc.coin_id join users on uc.user_id = users.id 
        WHERE users.username = ? and uc.coin_id = ?";
        $stm = $this->db->prepare($sql);
        $stm->bindValue(1, $username);
        $stm->bindValue(2, $id);
        $stm->execute();
        $results = $stm->fetchAll();
        return $results[0];
    }

    function addCoinToCollection($title, $min_year, $max_year, $country, $shape, $size, $weight, $front_picture, $back_picture, $material)
    {
       $this->insertIntoCoins($title, $min_year, $max_year, $country, $shape, $size, $weight, $front_picture, $back_picture, $material);
       $this->insertIntoUserCoins($title,$min_year,$max_year,$country);
    }

    private function insertIntoCoins($title, $min_year, $max_year, $country, $shape, $size, $weight, $front_picture, $back_picture, $material)
    {
        $sql = 'INSERT INTO coins (name,min_year,max_year,country,shape,size,weight,front_picture,back_picture,material)
        VALUES (?,?,?,?,?,?,?,?,?,?)';
        $stm = $this->db->prepare($sql);
        $stm->bindValue(1, $title);
        $stm->bindValue(2, $min_year);
        $stm->bindValue(3, $max_year);
        $stm->bindValue(4, $country);
        $stm->bindValue(5, $shape);
        $stm->bindValue(6, $size);
        $stm->bindValue(7, $weight);
        $stm->bindValue(8, $front_picture);
        $stm->bindValue(9, $back_picture);
        $stm->bindValue(10, $material);
        $stm->execute();
        $stm->errorInfo();
        
    }

    private function insertIntoUserCoins($title, $min_year,$max_year, $country)
    {
        $sql = "SELECT id FROM coins WHERE `name`= ? and `min_year`= ? and `max_year`=? and `country`=?";
        $stm = $this->db->prepare($sql);
        $stm->bindValue(1, $title);
        $stm->bindValue(2, $min_year);
        $stm->bindValue(3, $max_year);
        $stm->bindValue(4, $country);
        $stm->execute();
        $coinId = $stm->fetch();
        
        $username = Session::get("username");
        $sql = "SELECT id FROM users WHERE username = ?";
        $stm = $this->db->prepare($sql);
        $stm->bindValue(1, $username);
        $stm->execute();
        $userId = $stm->fetch();

        $sql = 'INSERT INTO user_coin(user_id,coin_id) VALUES (?,?)';
        $stm = $this->db->prepare($sql);
        $stm->bindValue(1, $userId[0]);
        $stm->bindValue(2, $coinId[0]);
        $stm->execute();
        $stm->errorInfo();

    }

   
}
