<?php

class Controller
{
    // protected $view;
    protected $model;

    public function __construct()
    {
        // if (session_id() == "") {
        //     session_start();
        //     $_SESSION['login'] = "";
        // }
    }

    function loadModel($name) {
        $path = '../app/models/' .$name. '.php';
        if(file_exists($path)) {
            require $path;
        $modelName = $name . "_model";
            $this->model = new $modelName();
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