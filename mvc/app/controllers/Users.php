<?php

class Users extends Controller {
    private $user_coins = [];
    private $users = [];
    private $username_selected = null;

    function __construct() {
        // print_r("login controller");
        parent::__construct();
        if(Session::get("error") != "Invalid username or password!") {
            Session::set("error","");
        }
        if (Session::get("isLogged") == false || Session::get("isLogged") == null) {
            header("location: /numax/mvc/public/login");
        }
        if (Session::get("username_selected") != false) {
            $this->username_selected = Session::get("username_selected");
        }
    }

    public function index()
    {
        $this->view('users/users');
    }

    function getUsername() {
        return $this->username_selected;
    }

    function getUserCoins() {
        $this->user_coins = $this->model->getUserCoins($this->username_selected);
        return $this->user_coins;
    }

    function getUsers() {
        $this->users = $this->model->getUsers();
        print_r($this->users);
        return $this->model->getUsers();
    }

    function selectOption() {
        if(isset($_POST['name'])) {
            $username = $_POST['name'];
            Session::set("username_selected",$username);
            $this->username_selected = $username;
            $this->user_coins = $this->model->getUserCoins($username);
        }
    }

    function deleteUser() {
        if(isset($_POST['delete_user'])) {
            $this->model->deleteUser($_POST['del_user']);
            Session::set("username_selected",null);
            header("location: /numax/mvc/public/users");
        }
    }

    function deleteCoin() {
        if(isset($_POST['coin__delete'])) {
            $this->model->deleteCoin($_POST['username'], $_POST['coin-id']);
            header("location: /numax/mvc/public/users");
        }
    }
}