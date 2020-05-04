<?php

class Register extends Controller
{
    function __construct(){
        parent::__construct();
        Session::init();
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
            echo $username,$email,$password;
            if($password != $repeat_password) {
                header("location: /numax/mvc/public/register");
                echo "<p>Passwords don't match!</p>";
            } else {
                if($this->model->check_user_exists($username) == true) {
                    header("location: /numax/mvc/public/register");
                    echo "<p>Username already exists! Choose another one</p>";  
                } else {
                    $this->model->register($username,$email,$password);
                    header("location: /numax/mvc/public/login");
                    echo "<p>Acccount created!</p>";
                }
            }
        } else {
            header("location: /numax/mvc/public/register");
            echo "<p>Fill all the fields!</p>";
        }
    }
}