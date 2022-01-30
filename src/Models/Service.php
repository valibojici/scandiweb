<?php

namespace App\Models;

use PDO;

abstract class Service
{
    private static $db;
    protected static function getDB()
    {
        if(!isset(self::$db)){
            self::$db = new PDO("mysql:host=".CONFIG['HOST'].";dbname=".CONFIG['DB'].";charset=".CONFIG['CHARSET'], CONFIG['USER'], CONFIG['PASSWORD']);
        }
        return self::$db;
    } 
}