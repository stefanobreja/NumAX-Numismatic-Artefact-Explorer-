<?php

class Register extends Controller
{
    function __construct(){
        parent::__construct();
        // Session::init();
        if(Session::get("error") == "Invalid username or password!") {
            Session::set("error","");
        }
    }

    public function index()
    {
        $this->view('register/register');
    }

    function register() {
        if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['pass']) && isset($_POST['repeat_pass'])){
            $username = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['pass'];
            $repeat_password = $_POST['repeat_pass'];
            if($password != $repeat_password) {
                Session::set("error","Passwords don't match!");
                header("location: /numax/mvc/public/register");
            } else {
                if($this->model->check_user_exists($username) == true) {
                    Session::set("error","Username already exists!");
                    header("location: /numax/mvc/public/register");
                } else {
                    $this->model->register($username,$email,$password);
                    Session::set("error","");
                    Session::destroy();
                    header("location: /numax/mvc/public/login");
                }
            }
        } else {
            Session::set("error","Fill all the fields!");
            header("location: /numax/mvc/public/register");
        }
    }
}