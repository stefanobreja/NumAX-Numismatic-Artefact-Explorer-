<?php

class Allcoins extends Controller
{
    private $all_coins;
    private $shown_coins;
    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->all_coins = $this->model->get_coins();
        $this->shown_coins = $this->all_coins;
        $this->view('all_coins/all_coins');
    }

    function getCoins()
    {
        return $this->shown_coins;
    }

    function searched_coins()
    {
        $this->shown_coins = $this->all_coins;
        if (isset($_POST['name']) && $_POST['name'] != null && $_POST['name'] != "") {
            $name = strtolower($_POST['name']);
            $this->shown_coins = array_filter($this->shown_coins, function ($value) use ($name) {
                return strpos(strtolower($value['name']), $name) !== false;
            });
        }
        if (isset($_POST['country']) && $_POST['country'] != null && $_POST['country'] != "") {
            $name = strtolower($_POST['country']);
            $this->shown_coins = array_filter($this->shown_coins, function ($value) use ($name) {
                return strpos(strtolower($value['country']), $name) !== false;
            });
        }
        if (isset($_POST['shape']) && $_POST['shape'] != null && $_POST['shape'] != "") {
            $name = strtolower($_POST['shape']);
            $this->shown_coins = array_filter($this->shown_coins, function ($value) use ($name) {
                return strpos(strtolower($value['shape']), $name) !== false;
            });
        }
        if (isset($_POST['material']) && $_POST['material'] != null && $_POST['material'] != "") {
            $name = strtolower($_POST['material']);
            $this->shown_coins = array_filter($this->shown_coins, function ($value) use ($name) {
                return strpos(strtolower($value['material']), $name) !== false;
            });
        }
        if (isset($_POST['year']) && $_POST['year'] != null && $_POST['year'] != "") {
            $name = str_replace(" ", "", $_POST['year']);
            $name = explode("-", $name);
            if (count($name) == 1) {
                $this->shown_coins = array_filter($this->shown_coins, function ($value) use ($name) {
                    return ((intval($value['min_year']) == intval($name[0])) && (intval($value['max_year']) == intval($name[0])));
                });
            } else {
                $this->shown_coins = array_filter($this->shown_coins, function ($value) use ($name) {
                    return (intval($value['min_year']) >= intval($name[0]) && intval($value['max_year']) <= intval($name[1]));
                });
            }
        }
        $_POST = array();
    }

    function AddCoin()
    {
        if (isset($_POST['coin__add'])) {
            $coinId = $_POST['coin-id'];
            $this->model->AddCoinToCollection($coinId);
            header("location: /numax/mvc/public/mycoins");
        }
    }
}
