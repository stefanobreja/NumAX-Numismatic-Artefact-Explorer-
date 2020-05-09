<?php

class Login extends Controller
{
    function __construct() {
        // print_r("login controller");
        parent::__construct();
        if(Session::get("error") != "Invalid username or password!") {
            Session::set("error","");
        }
        if (Session::get("isLogged") == true) {
            header("location: /numax/mvc/public/mycoins");
        }
    }

    public function index()
    {
        $this->view('login/login');
        // $db = new Database();
        // $db->populateDB('romania');
    }

    function authenticate() {
        if (Session::get("isLogged") == null || Session::get("isLogged") == false) {
            echo Session::get("isLogged");
            echo "ajung aici";
            if (isset($_POST['username']) && isset($_POST['pass'])) {
                $username = $_POST['username'];
                $password = $_POST['pass'];
                if ($this->model->check_user_in_db($username,$password) == true) {
                    Session::set("username",$username);
                    Session::set("password",$password);
                    Session::set("isLogged",true);
                    Session::set("error","");
                    // Session::destroy();
                    header("location: /numax/mvc/public/mycoins");
                } else {
                    Session::set("error","Invalid username or password!");
                    header("location: /numax/mvc/public/login");
                }
            }
        } else {
            Session::set("error","");
            header("location: /numax/mvc/public/mycoins");
        }
    }

    function logout() {
        Session::set("error","");
        Session::set("isLogged",false);
        Session::destroy();
        header("location: /numax/mvc/public/login");
    }

}