<?php

class Allcoins_model extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    function get_coins()
    {
        $sql = "SELECT * FROM coins";
        $stm = $this->db->prepare($sql);
        $stm->execute();
        $results = $stm->fetchAll();
        return $results;
    }

    function get_user_coins($username)
    {
        $sql = "SELECT coins.* FROM coins join user_coin as uc on coins.id = uc.coin_id join users on uc.user_id = users.id 
        WHERE users.username = ?";
        $stm = $this->db->prepare($sql);
        $stm->bindValue(1, $username);
        $stm->execute();
        $results = $stm->fetchAll();
        return $results;
    }


    function AddCoinToCollection($coin_id)
    {
        $sql = "SELECT id FROM users WHERE username = '" . $_SESSION["username"] . "'";
        $stm = $this->db->prepare($sql);
        $stm->execute();
        $userId = $stm->fetch();

        $sql = "INSERT INTO user_coin VALUES(" . $userId[0] . "," . $coin_id . ")";
        $stm = $this->db->prepare($sql);
        $stm->execute();
        $stm->errorInfo();
    }
}
