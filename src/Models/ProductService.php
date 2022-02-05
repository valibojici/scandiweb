<?php

namespace App\Models;

use PDO;

class ProductService extends Service
{
    public function getProducts()
    {
        $stmt = 'SELECT * FROM products';
        $rows = $this->db->query($stmt);
        $products = [];
        $factory = new ProductModelFactory(new Validate());
        foreach($rows as $row){
            $type = $row['type'];
            $stmt = 'SELECT * FROM ' . $type;
            $product = $factory->getModel($type);
            $product->setID($row['id'])->setSKU($row['sku'])->setName($row['name'])->setPrice($row['price']);

            $properties = $this->db->query($stmt)->fetch(PDO::FETCH_ASSOC);
            foreach($properties as $key => $val){
                $setMethodName = 'set' . ucwords($key);
                $product->$setMethodName($val);
            }
            array_push($products, $product);
        }
        return $products;
    }
}