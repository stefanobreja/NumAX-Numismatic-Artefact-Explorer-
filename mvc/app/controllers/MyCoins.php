<?php

class Mycoins extends Controller
{
    private $my_coins;
    function __construct() {
        parent::__construct();
    }

    public function index() {
        $username = Session::get("username");
        $this->my_coins = $this->model->get_user_coins($username);
        $this->view('my_coins/my_coins');

    }

    function getCoins() {
        return $this->my_coins;
    }

}