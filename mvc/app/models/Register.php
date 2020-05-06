<?php

class Register_model extends Model {
    public function __construct(){
        parent::__construct();
    }

    function check_user_exists($username) {
        $sql_query = "SELECT username FROM users WHERE username = ?";
        $stm = $this->db->prepare($sql_query);
        $stm->bindValue(1,$username);
        $stm->execute();
        if($stm->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function register($username, $email, $pass) {
        $sql_query = "INSERT INTO users (username, email, password) VALUES (?,?,?)";
        $stm = $this->db->prepare($sql_query);
        $stm->bindValue(1,$username);
        $stm->bindValue(2,$email);
        $stm->bindValue(3,md5($pass));
        $stm->execute();
    }
}