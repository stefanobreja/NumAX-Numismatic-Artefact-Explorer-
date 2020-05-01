<?php


class UserLogin
{
    private $username;

    function UserLogin($username)
    {
        $this->username = $username;
    }

    function getUsername()
    {
        return $this->username;
    }

    function setUsername($username)
    {
        $this->username = $username;
    }


}