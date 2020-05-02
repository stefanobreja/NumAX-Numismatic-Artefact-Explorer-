<?php

class Controller
{
    protected $View = null;

    public function __construct()
    {

        if (session_id() == "") {
            session_start();
        }
    }

    function view($view, $data=[])
    {
        require_once '../app/views/' . $view . '.php';
    }

}