<?php

class AllcoinsAdmin_model extends Model
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

    function DeleteCoinFromDB($coin_id)
    {
        try {
            $sql = "DELETE FROM user_coin WHERE coin_id =?";
            $stm = $this->db->prepare($sql);
            $stm->bindValue(1, $coin_id);
            $stm->execute();
            $stm->errorInfo();

            $sql = "DELETE FROM coins WHERE id =?";
            $stm = $this->db->prepare($sql);
            $stm->bindValue(1, $coin_id);
            $stm->execute();
            $stm->errorInfo();
            $_SESSION['action-finised'] = "delete";
        } catch (Exception $e) {
            $_SESSION['action-finised'] = "deleteError";
        }
    }
    function getCoin($id)
    {
        $sql = "SELECT * FROM coins WHERE id = ?";
        $stm = $this->db->prepare($sql);
        $stm->bindValue(1, $id);
        $stm->execute();
        $results = $stm->fetchAll();
        if ($results != null)
            return $results[0];
    }
    function updateCoin($title, $years, $country, $shape, $size, $weight, $material)
    {
        try {
            $sql = "UPDATE coins SET name=?, country=?,years=?,shape=?,material=?,size=?,weight=?  WHERE id=?;";
            $stm = $this->db->prepare($sql);
            $stm->bindValue(1, $title);
            $stm->bindValue(2, $country);
            $stm->bindValue(3, $years);
            $stm->bindValue(4, $shape);
            $stm->bindValue(5, $material);
            $stm->bindValue(6, $size);
            $stm->bindValue(7, $weight);
            $stm->bindValue(8, $_SESSION['coin-id']);
            $stm->execute();
            $_SESSION['action-finised'] = "update";
        } catch (Exception $e) {
            $stm->errorInfo();
            $_SESSION['action-finised'] = "updateError";
        }
    }
}
