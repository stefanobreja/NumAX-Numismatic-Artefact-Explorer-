<?php

class Mycoins extends Controller
{
    private $title;
    private $min_year;
    private $max_year;
    private $country;
    private $shape;
    private $size;
    private $weight;
    private $front_picture;
    private $back_picture;
    private $material;

    private $my_coins;
    private $shown_coins;
    function __construct() {
        parent::__construct();
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
        $this->title =   isset($_POST['title']) ? $_POST['title'] : "Unknown";
        $this->min_year =  isset($_POST['min-year']) ? $_POST['min-year'] : 0;
        $this->max_year =  isset($_POST['max-year']) ? $_POST['max-year'] : 0;
        $this->country = isset($_POST['country']) ? $_POST['country'] : "Unknown";
        $this->shape =  isset($_POST['shape']) ? $_POST['shape'] : "Unknown";
        $this->size =  isset($_POST['size']) ? $_POST['size'] : 0;
        $this->weight =  isset($_POST['weight']) ? $_POST['weight'] : 0;

        $name = $_FILES['front_image']['name'];
        $type = $_FILES['front_image']['type'];
        $data = file_get_contents($_FILES['front_image']['tmp_name']);
        $this->front_picture = $data;
        $name = $_FILES['back_image']['name'];
        $type = $_FILES['back_image']['type'];
        $data = file_get_contents($_FILES['back_image']['tmp_name']);

        $this->back_picture = $data;
        $this->material = isset($_POST['composition']) ? $_POST['composition'] : "Unknown";


        $this->model->addCoinToCollection($this->title, $this->min_year, $this->max_year, $this->country, $this->shape, $this->size, $this->weight, $this->front_picture, $this->back_picture, $this->material);
        Session::set("error", "");
        header("location: /numax/mvc/public/mycoins");
    }

    function getCoins() {
        return $this->shown_coins;
    }

    function searched_coins() {
        $this->shown_coins = $this->my_coins;
        if(isset($_POST['name']) && $_POST['name']!=null && $_POST['name']!="" ) {
            $name = strtolower($_POST['name']);
            $this->shown_coins = array_filter($this->shown_coins,function($value) use ($name) {
                return strpos(strtolower($value['name']),$name)!== false;
            });
        }
        if(isset($_POST['country']) && $_POST['country']!=null && $_POST['country']!="") {
            $name = strtolower($_POST['country']);
            $this->shown_coins = array_filter($this->shown_coins,function($value) use ($name) {
                return strpos(strtolower($value['country']),$name)!== false;
            });
        }
        if(isset($_POST['shape']) && $_POST['shape']!=null && $_POST['shape']!="") {
            $name = strtolower($_POST['shape']);
            $this->shown_coins = array_filter($this->shown_coins,function($value) use ($name) {
                return strpos(strtolower($value['shape']),$name)!== false;
            });
        }
        if(isset($_POST['material']) && $_POST['material']!=null && $_POST['material']!="") {
            $name = strtolower($_POST['material']);
            $this->shown_coins = array_filter($this->shown_coins,function($value) use ($name) {
                return strpos(strtolower($value['material']),$name)!== false;
            });
        }
        if(isset($_POST['year']) && $_POST['year']!=null && $_POST['year']!="") {
            $name = str_replace(" ","",$_POST['year']);
            $name = explode("-",$name);
            if(count($name) == 1) {
                $this->shown_coins = array_filter($this->shown_coins,function($value) use ($name) {
                    return ((intval($value['min_year']) == intval($name[0])) && (intval($value['max_year']) == intval($name[0]))); 
                });
            } else {
                $this->shown_coins = array_filter($this->shown_coins,function($value) use ($name) {
                    return (intval($value['min_year']) >= intval($name[0]) && intval($value['max_year']) <= intval($name[1]));
                });
            }
        }
        $_POST = array();
    }
}
