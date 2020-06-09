<?php
class AllcoinsAdmin extends Controller
{
    function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        if (Session::get("isLogged") == false || Session::get("isLogged") == null) {
            header("location: /numax/mvc/public/login");
        }
        if (Session::get("isAdmin") == false) {
            header("location: /numax/mvc/public/mycoins");
        }
        $this->all_coins = $this->model->get_coins();
        $this->shown_coins = $this->all_coins;
        $this->view('all_coins/all_coins_admin');
    }
    function manageCoin()
    {
        if (isset($_POST['coin__modify'])) {
            $coinId = $_POST['coin-id-admin'];
            $_SESSION['modify-coin'] = true;
            $_SESSION['coin-id-admin'] = $coinId;
            header("location:/numax/mvc/public/allcoinsadmin");
        }
        if (isset($_POST['coin__delete'])) {
            $coinId = $_POST['coin-id-admin'];
            $this->model->DeleteCoinFromDB($coinId);
            header("location:/numax/mvc/public/allcoinsadmin");
        }
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

    function getCoinById()
    {
        if (isset($_SESSION['coin-id-admin'])) {
            return $this->model->getCoin($_SESSION['coin-id-admin']);
        }
    }
    function modifyCoin()
    {
        if (isset($_POST['modify_coin_submit'])) {
            $this->title =   isset($_POST['title']) ? $_POST['title'] : "Unknown";
            $this->years =  isset($_POST['years']) ? $_POST['years'] : 0;
            $this->country = isset($_POST['country']) ? $_POST['country'] : "Unknown";
            $this->shape =  isset($_POST['shape']) ? $_POST['shape'] : "Unknown";
            $this->size =  isset($_POST['size']) ? $_POST['size'] : 0;
            $this->weight =  isset($_POST['weight']) ? $_POST['weight'] : 0;
            $this->material = isset($_POST['composition']) ? $_POST['composition'] : "Unknown";

            $this->model->updateCoin($this->title, $this->years, $this->country, $this->shape, $this->size, $this->weight, $this->material);
            header("location: /numax/mvc/public/allcoinsadmin");
        }
    }
}
