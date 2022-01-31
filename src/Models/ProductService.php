<?php

namespace App\Models;

use PDO;

class ProductService extends Service
{
    public function getProducts()
    {
        $o = new BookModel(new Validate());
        // return [];
        $stmt = 'SELECT * FROM products';
        $stmt = $this->db->query($stmt);
        $obj = [];
        foreach($stmt as $row){
            $type = $row['type'];
            $substmt = 'SELECT * FROM ' . $type;

            $productModel = '\\App\\Models\\' . ucwords($type) . 'Model';
            $product = new $productModel(new Validate());
            $product->setID($row['id'])->setSKU($row['sku'])->setName($row['name'])->setPrice($row['price']);

            $properties = $this->db->query($substmt)->fetch(PDO::FETCH_ASSOC);
            foreach($properties as $key => $val){
                $setMethodName = 'set' . ucwords($key);
                $product->$setMethodName($val);
            }
            array_push($obj, $product);
        }
        return $obj;
        $p = new ProductModel(new Validate());
        $p->setSKU('   ')->setID('232')->setPrice('4.32');
        $errors = $p->isValid() ? [] : $p->errors;

        $p->setSKU('3434')->setName('pula ass');
        $errors2 = $p->isValid() ? [] : $p->errors;
        
        return json_encode($obj);
        return json_encode(['errors' => $errors, 'errors2' => $errors2, 'obj' => [$p->getID(), $p->getName(), $p->getPrice(), $p->getSKU()]]);
    }
}