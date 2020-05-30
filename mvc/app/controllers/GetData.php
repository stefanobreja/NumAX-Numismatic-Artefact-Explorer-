<?php

class GetData extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->view('/get_data');
        $this->model->populateDB(['roumanie','rome','north_africa_islamic','east_africa_islamic','egypte']);
    }
}
