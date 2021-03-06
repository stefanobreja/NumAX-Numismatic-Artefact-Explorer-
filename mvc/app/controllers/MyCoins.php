<?php

class Mycoins extends Controller
{
    private $title;
    private $years;
    private $country;
    private $shape;
    private $size;
    private $weight;
    private $front_picture;
    private $back_picture;
    private $material;

    private $my_coins;
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
        $username = Session::get("username");
        $this->my_coins = $this->model->get_user_coins($username);
        $this->shown_coins = $this->my_coins;
        $this->view('my_coins/my_coins');
    }

    function addCoin()
    {
        if (isset($_POST['add_coin_submit'])) {
            $this->title =   isset($_POST['title']) ? $_POST['title'] : "Unknown";
            $this->years =  isset($_POST['years']) ? $_POST['years'] : 0;
            $this->country = isset($_POST['country']) ? $_POST['country'] : "Unknown";
            $this->shape =  isset($_POST['shape']) ? $_POST['shape'] : "Unknown";
            $this->size =  isset($_POST['size']) ? $_POST['size'] : 0;
            $this->weight =  isset($_POST['weight']) ? $_POST['weight'] : 0;
 
            // $name = $_FILES['front_image']['name'];
            // $type = $_FILES['front_image']['type'];
            $data = file_get_contents($_FILES['modal-front_image']['tmp_name']);
            $this->front_picture = $data;
            // $name = $_FILES['back_image']['name'];
            // $type = $_FILES['back_image']['type'];
            $data = file_get_contents($_FILES['modal-back_image']['tmp_name']);
 
            $this->back_picture = $data;
            $this->material = isset($_POST['composition']) ? $_POST['composition'] : "Unknown";
 
 
            $this->model->addCoinToCollection($this->title, $this->years, $this->country, $this->shape, $this->size, $this->weight, $this->front_picture, $this->back_picture, $this->material);
            header("location: /numax/mvc/public/mycoins");
        }
        if (isset($_POST['import-coin'])) {
            $data = $_FILES['import-coin'];
        }
    }

    function getCoins()
    {
        return $this->shown_coins;
    }

    function searched_coins()
    {
        $this->shown_coins = $this->my_coins;
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
                    $year = str_replace(")","", $year);
                    $year = str_replace("(","-",$year);
                    $year = explode("-", $year);
                    if(count($year) == 1) {
                        return (intval($year[0]) == intval($name[0]));
                    } else {
                        return ((intval($year[0]) == intval($name[0])) || (intval($year[1]) == intval($name[0])));
                    }
                });
            } else {
                $this->shown_coins = array_filter($this->shown_coins, function ($value) use ($name) {
                    $year = str_replace(" ", "", $value['years']);
                    $year = str_replace(")","", $year);
                    $year = str_replace("(","-",$year);
                    $year = explode("-", $year);
                    if(count($year) == 1) {
                        return (intval($year[0]) >= intval($name[0]) && intval($year[0]) <= intval($name[1]));
                    } else {
                        return ((intval($year[0]) >= intval($name[0])) && (intval($year[1]) <= intval($name[1])));
                    }
                });
            }
        }
        $_POST = array();
    }

    function actionCoin()
    {
        $username = Session::get("username");
        
        if (isset($_POST['coin__share'])) {
            $this->shareCoin($username, $_POST['coin-id']);
        }
        if(isset($_POST['coin__delete'])) {
            $this->deleteCoin($username, $_POST['coin-id']);
        }
    }

    function shareCoin($username, $coin_id) {
        $coin = $this->model->getCoinById($coin_id, $username);
        $coinModel = new Coin(
            $coin["id"],
            $coin["name"],
            $coin["years"],
            $coin["country"],
            $coin["shape"],
            $coin["size"],
            $coin["weight"],
            $coin["front_picture"],
            $coin["back_picture"],
            $coin["material"],
            $coin["rarity_index"]
        );
        $coinArray = $coinModel->getArray();

        $file_name = "Coin_" . $coin['id'] . ".json";
        header("Content-Type: application/json");
        header("Content-Disposition: attachment; filename=$file_name");
        header("Cache-Control: no-cache, no-store, must-revalidate");
        header("Pragma: no-cache");
        header("Expires: 0");
        $json = json_encode($coinArray);

        // $json = json_encode($coin);
        $error = json_last_error_msg();

        echo $json;
    }

    function deleteCoin($username, $coin_id) {
        $this->model->deleteCoinFromUser($username, $coin_id);
        header("location: /numax/mvc/public/mycoins");
    }
}
