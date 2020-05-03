<?php

class AllCoins extends Controller
{
    public $list;

    public function __construct()
    {
        $this->getCoins();
    }

    public function index()
    {
        $this->view('all_coins/all_coins', $this->list);
    }


    function getCoins()
    {
        $db = new Database();
        $this->list = $db->getAllCoins();
    }

    function getX()
    {
        {
            {
                $db = new Database();
                $y = $db->getAllCoins()[1];

                $this->list = $y;
            }
        }
    }
}