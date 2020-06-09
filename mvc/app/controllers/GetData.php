<?php

class GetData extends Controller
{
    function __construct()
    {
        if(Session::get("isAdmin") == false){
            header("location: /numax/mvc/public/mycoins");
        }
        parent::__construct();
    }

    public function index()
    {
        $this->view('/get_data');
        $this->model->populateDB([
            'roumanie', 'rome', 'north_africa_islamic', 'east_africa_islamic', 'egypte', 'bielorussie',
            'wohlau_city', 'canada_section', 'tibet', 'cuba', 'aquitaine_duchy', 'tachira', 'megara',
            'france', 'paris_bishopric', 'hamm_city', 'konigsegg_earldom', 'meissen_margravate', 'great_seljuq'
        ]);
        header("location: /numax/mvc/public/allcoins");
    }
}
