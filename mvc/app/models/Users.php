<?php
class Users_model extends Model {
    function __construct()
    {
        parent::__construct();
    }

    function getUsers() {
        $sql = "SELECT username FROM users WHERE isAdmin = ?";
        $stm = $this->db->prepare($sql);
        $stm->bindValue(1, false);
        $stm->execute();
        $results = $stm->fetchAll();
        print_r($results);
        return $results;
    }

    function getUserCoins($username) {
        $sql = "SELECT coins.* FROM coins join user_coin as uc on coins.id = uc.coin_id join users on uc.user_id = users.id 
        WHERE users.username = ?";
        $stm = $this->db->prepare($sql);
        $stm->bindValue(1, $username);
        $stm->execute();
        $results = $stm->fetchAll();
        return $results;
    }

    function deleteCoin($username,$coin_id) {
        $sql = "DELETE uc FROM user_coin as uc join users on uc.user_id = users.id 
        WHERE users.username = ? and uc.coin_id = ?";
        $stm = $this->db->prepare($sql);
        $stm->bindValue(1, $username);
        $stm->bindValue(2, $coin_id);
        $stm->execute();
    }

    function deleteUser($username) {
        $sql = "DELETE uc FROM user_coin as uc join users on uc.user_id = users.id 
        WHERE users.username = ?";
        $stm = $this->db->prepare($sql);
        $stm->bindValue(1, $username);
        $stm->execute();

        $sql = "DELETE FROM users WHERE users.username = ?";
        $stm = $this->db->prepare($sql);
        $stm->bindValue(1, $username);
        $stm->execute();
    }
}