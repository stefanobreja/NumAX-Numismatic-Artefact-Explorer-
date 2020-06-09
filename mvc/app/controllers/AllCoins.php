<?php

class Allcoins extends Controller
{
    private $all_coins;
    private $shown_coins;
    function __construct()
    {
        parent::__construct();
        if (Session::get("isLogged") == false || Session::get("isLogged") == null) {
            header("location: /numax/mvc/public/login");
        }
        if(Session::get("isAdmin") == true){
            header("location: /numax/mvc/public/allcoinsadmin");
        }
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
                    $year = str_replace(" ", "", $value['years']);
                    $year = str_replace(")", "", $year);
                    $year = str_replace("(", "-", $year);
                    $year = explode("-", $year);
                    if (count($year) == 1) {
                        return (intval($year[0]) == intval($name[0]));
                    } else {
                        return ((intval($year[0]) == intval($name[0])) || (intval($year[1]) == intval($name[0])));
                    }
                });
            } else {
                $this->shown_coins = array_filter($this->shown_coins, function ($value) use ($name) {
                    $year = str_replace(" ", "", $value['years']);
                    $year = str_replace(")", "", $year);
                    $year = str_replace("(", "-", $year);
                    $year = explode("-", $year);
                    if (count($year) == 1) {
                        return (intval($year[0]) >= intval($name[0]) && intval($year[0]) <= intval($name[1]));
                    } else {
                        return ((intval($year[0]) >= intval($name[0])) && (intval($year[1]) <= intval($name[1])));
                    }
                });
            }
        }
        $_POST = array();
    }

    function AddCoin()
    {
        if (isset($_POST['coin__add'])) {
            $coinId = $_POST['coin-id'];
            $coinAlreadyExists = $this->verifyCoinExists($coinId);

            if ($coinAlreadyExists) {
                $_SESSION["error"]="error";
                header("location: /numax/mvc/public/allcoins");
            } else {
                $this->model->AddCoinToCollection($coinId);
                header("location: /numax/mvc/public/mycoins");
            }
        }
    }

    function verifyCoinExists($coinId)
    {
        $userCoins = $this->model->get_user_coins($_SESSION["username"]);
        $coinAlreadyExists = false;
        foreach ($userCoins as $coin) {
            if ($coin["id"] == $coinId) {
                $coinAlreadyExists = true;
                break;
            }
        }
        return $coinAlreadyExists;
    }
}
