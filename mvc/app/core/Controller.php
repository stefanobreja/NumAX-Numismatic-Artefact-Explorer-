<?php

class Controller
{
    protected $model;

    public function __construct() {
        Session::init();
    }

    function loadModel($name) {
        $path = '../app/models/' .$name. '.php';
        if(file_exists($path)) {
            require_once $path;
            $modelName = $name . "_model";
            $this->model = new $modelName();
        }
    }

    function view($view, $data = array()) {
        require_once '../app/views/' . $view . '.php';
    }

}