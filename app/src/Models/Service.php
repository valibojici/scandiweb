<?php

namespace App\Models;

use PDO;

abstract class Service
{
    protected $db;
    public function __construct()
    {
        $this->db = new PDO("mysql:host=".CONFIG['HOST'].";dbname=".CONFIG['DB'].";charset=".CONFIG['CHARSET'], CONFIG['USER'], CONFIG['PASSWORD']);
    } 
}