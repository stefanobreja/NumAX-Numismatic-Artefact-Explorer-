<?php

class Login extends Controller
{

    public function index()
    {
        $this->view('login/login');
        $db = new Database();
        $db->populateDB('romania');
    }

    function create($username, $password, $email)
    {

    }

    function authenticate()
    {
        if ($username = isset($_REQUEST['email']) && $password = isset($_REQUEST['password'])) {
            if ($this->isValidLogin($username, $password)) {
                session_start();
                $user = new UserLogin($username);
                $_SESSION['user'] = $user;
                return true;
            }
        }
    }

    static function isValidLogin($user, $pass)
    {
        $authentic = false;
        if ($user == 'user' && $pass == 'pass')
            $authentic = true;
        return $authentic;

    }

    function logout()
    {
        session_start();
        session_destroy();
    }

}