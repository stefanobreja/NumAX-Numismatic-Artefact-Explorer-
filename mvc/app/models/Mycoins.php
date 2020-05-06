<?php

class Mycoins_model extends Model
{
    function __construct() {
        parent::__construct();
    }

    function get_user_coins($username) {
        $sql = "SELECT coins.* FROM coins join user_coin as uc on coins.id = uc.coin_id join users on uc.user_id = users.id 
        WHERE users.username = ?";
        $stm = $this->db->prepare($sql);
        $stm->bindValue(1,$username);
        $stm->execute();
        $results = $stm->fetchAll();
        return $results;
    }
}