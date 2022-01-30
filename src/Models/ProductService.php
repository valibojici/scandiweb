<?php

namespace App\Models;

use PDO;

class ProductService extends Service
{
    public function getProducts()
    {
        $db = self::getDB();
        $stmt = 'select * from products';
        $stmt = $db->query($stmt);
        foreach($stmt as $row){
            $id = $row['id'];
            $type = $row['type'];
            $substmt = 'select * from ' . $type;
            $properties = $db->query($substmt)->fetch(PDO::FETCH_ASSOC);
            
        }
        return $res['name'];
    }
}