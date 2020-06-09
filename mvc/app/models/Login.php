<?php

class Login_model extends Model
{
    function __construct() {
        parent::__construct();
        // Session::init();
    }

    function check_user_in_db($username,$password) {
        $sql = "SELECT isAdmin FROM users WHERE username = ? AND password = ?";
        $stm = $this->db->prepare($sql);
        $stm->bindValue(1, $username);
        $stm->bindValue(2,md5($password));
        $stm->execute();
        
        if($stm->rowCount() > 0) {
            $admin = $stm->fetch();
            print_r($admin[0]);
            Session::set("isAdmin",boolval($admin[0]));
            return true;
        } else return false;
    }
}