<?php

class Allcoins_model extends Model
{
    function __construct() {
        parent::__construct();
    }

    function get_coins() {
        $sql = "SELECT * FROM coins";
        $stm = $this->db->prepare($sql);
        $stm->execute();
        $results = $stm->fetchAll();
        return $results;
    }
}