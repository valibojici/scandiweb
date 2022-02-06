<?php

namespace App\Models;

use Error;
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
            $type = strtolower($row['type']);
            $id = $row['id'];
            $product = $factory->getModel($type);
            $stmt = "SELECT * FROM " . $type . " WHERE id = :id";
            $properties = $this->db->prepare($stmt);
            $properties->bindParam(':id', $id);
            $properties->execute();
            
            $product->setID($row['id'])->setSKU($row['sku'])->setName($row['name'])->setPrice($row['price']);
            
            foreach($properties->fetch(PDO::FETCH_ASSOC) as $key => $val){
                $setMethodName = 'set' . ucwords($key);
                $product->$setMethodName($val);
            }
            array_push($products, $product);
        }
        return $products;
    }

    public function addProduct(array $params) : array
    {
        $factory = new ProductModelFactory(new Validate());
        $p = $factory->getModel($params['type']);
        if($p === null){
            return ['type' => 'Invalid type'];
        }
        $type = strtolower($params['type']);
        unset($params['type']);
        foreach($params as $field_name => $field_value){
            $method = 'set' . ucfirst(strtolower($field_name));
            $p->{$method}($field_value);
        }
        $p->setId(-1);

        if(!$p->isValid()){
            return $p->getErrors();
        }

        $stmt = $this->db->prepare('SELECT 1 FROM products WHERE sku = :sku');
        $stmt->execute([':sku' => $p->getSku()]);
        if($stmt->rowCount() > 0){
            return ['sku' => 'Duplicate SKU.'];
        }

        $stmt = $this->db->prepare('INSERT INTO products(sku, name, price, type) VALUES(:sku, :name, :price, :type)');
        $stmt->execute([':sku' => $p->getSku(), ':name' => $p->getName(), ':price' => $p->getPrice(), ':type' => $type]);

        $id = $this->db->lastInsertId();
        $p->setId($id);
        $fields = array_map(function($field){ return $field['name']; } , $p->getFields());
        array_push($fields, 'id');
        
        $stmt = 'INSERT INTO ' . $type. '(' . implode(',', $fields) . ')' . ' VALUES(' . implode(',', array_map(function($v){ return ':'.$v; }, $fields)) . ')';
        $stmt = $this->db->prepare($stmt);
        foreach($fields as $field){
            $stmt->bindValue(':'.$field, $p->{'get' . ucfirst($field)}());
        }
        $stmt->execute();
        return [];
    }

    public function getProductFields() : array
    {
        $res = [];
        $factory = new ProductModelFactory(new Validate());
        foreach(['Book', 'DVD', 'Furniture'] as $type){
            $product = $factory->getModel($type);
            $res[$type] = $product->getFields();
        }
        return $res;
    }

    public function deleteProducts(array $skus) : void
    {
        if($skus == []){
            return;
        }

        $skus = array_map(function($sku){ 
            return $this->db->quote($sku);
        }, $skus);
        $skus = implode(',', $skus);
        $stmt = 'DELETE FROM products WHERE sku IN (' . $skus . ')';
        $this->db->query($stmt);
    }
}