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

    function deleteCoinFromUser($username, $coin_id) {
        $sql = "DELETE uc FROM user_coin as uc join users on uc.user_id = users.id 
        WHERE users.username = ? and uc.coin_id = ?";
        $stm = $this->db->prepare($sql);
        $stm->bindValue(1, $username);
        $stm->bindValue(2, $coin_id);
        $stm->execute();
        // return $stm->rowCount();
    }

    function addCoinToCollection($title, $years, $country, $shape, $size, $weight, $front_picture, $back_picture, $material)
    {
       $this->insertIntoCoins($title, $years, $country, $shape, $size, $weight, $front_picture, $back_picture, $material);
       $this->insertIntoUserCoins($title,$years,$country);
    }

    private function insertIntoCoins($title, $years, $country, $shape, $size, $weight, $front_picture, $back_picture, $material)
    {
        $sql = 'INSERT INTO coins (name,years,country,shape,size,weight,front_picture,back_picture,material)
        VALUES (?,?,?,?,?,?,?,?,?)';
        $stm = $this->db->prepare($sql);
        $stm->bindValue(1, $title);
        $stm->bindValue(2, $years);
        $stm->bindValue(3, $country);
        $stm->bindValue(4, $shape);
        $stm->bindValue(5, $size);
        $stm->bindValue(6, $weight);
        $stm->bindValue(7, $front_picture);
        $stm->bindValue(8, $back_picture);
        $stm->bindValue(9, $material);
        $stm->execute();
        $stm->errorInfo();
    }

    private function insertIntoUserCoins($title,$years, $country)
    {
        $sql = "SELECT id FROM coins WHERE `name`= ? and `years`=? and `country`=?";
        $stm = $this->db->prepare($sql);
        $stm->bindValue(1, $title);
        $stm->bindValue(2, $years);
        $stm->bindValue(3, $country);
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

    function delete_user_coin($coin_id){
        $sql = "DELETE FROM user_coin WHERE coin_id=?";
        $stm = $this->db->prepare($sql);
        $stm->bindValue(1, $coin_id);
        $stm->execute();
        $stm->errorInfo();
        header("location: /numax/mvc/public/mycoins");
    } 
}
