<?php

namespace App\Controllers;

use PDO;

class Controller
{
    private $db;
    
    public function getDB()
    {
        if(!isset($this->db)){
            $this->db = new PDO("mysql:host=".CONFIG['HOST'].";dbname=".CONFIG['DB'].";charset=".CONFIG['CHARSET'], CONFIG['USER'], CONFIG['PASSWORD']);
        }
        return $this->db;
    }
}