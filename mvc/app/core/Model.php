
<?php

class Model {
    public $db = null;
    function __construct()
    {//set the database
        try {
            $this->db = new Database();
            $this->db = $this->db->_PDO;
        }
        catch(PDOException $e)
        {
            $e->getMessage();
        }
    }
}