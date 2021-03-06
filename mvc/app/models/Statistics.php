<?php

class Statistics_model extends Model
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

    function filterByMaterial()
    {
        $coins = $this->get_coins();
        foreach ($coins as $coin) {
        }
    }

    function getSmallestCoins() {
        $sql = "select * from coins where size > 0 order by size";
        $stm = $this->db->prepare($sql);
        $stm->execute();
        $results = $stm->fetchAll();
        return array_slice($results, 0, 10);
    }

    function getMostPopularCoins()
    {
        $sql = "select c.* from coins as c join user_coin as uc on c.id = uc.coin_id group by uc.coin_id order by count(uc.coin_id) desc";
        $stm = $this->db->prepare($sql);
        $stm->execute();
        $results = $stm->fetchAll();
        return array_slice($results, 0, 10);
    }

    function getRarestCoins(){
        $sql = "select * from coins order by rarity_index desc";
        $stm = $this->db->prepare($sql);
        $stm->execute();
        $results = $stm->fetchAll();
        return array_slice($results, 0, 10);
    }
}
