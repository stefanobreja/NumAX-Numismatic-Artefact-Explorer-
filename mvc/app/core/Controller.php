<?php

class Controller
{
    protected $View = null;

    public function __construct()
    {
        if (session_id() == "") {
            session_start();
            $_SESSION['login'] = "";
        }
    }

    function view($view, $data = array())
    {
//        if ($_SESSION['login'] != "") {
        require_once '../app/views/' . $view . '.php';
//        } else {
//            print $_SESSION['login'];
//            require_once '../app/views/login/Login.php';
//        }

    }

}