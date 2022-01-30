<?php

namespace App\Model;

abstract class ProductModel extends Model
{
    private int $id;
    private string $sku;
    private string $name;
    private float $price;
    private array $errors;

    public function setID(int $id)
    {
        $this->id = $id;
    }

    public function setSKU(string $sku)
    {
        $this->sku = trim($sku);
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function setPrice(float $price)
    {
        $this->price = $price;
    }

    public function validate() : bool
    {
        $isValid = true;

        if(isset($this->id)){
            if(!this->validateInt($this->id)){
                $this->errors['id'] = 'ID is not an integer';
                $isValid = false;
            }
        }

        if(!$this->validateString($this->sku)){
            $this->errors['sku'] = 'Invalid SKU';
            $isValid = false;
        }
        else if(checkSKUExists($this->sku)){
            $this->errors['sku'] = 'SKU exists';
            $isValid = false;
        }

        if(!$this->validateString($this->name)){
            $this->errors['name'] = 'Invalid name';
            $isValid = false;
        }

        if(!$this->validateFloat($this->price) || $this->price < 0){
            $this->errors['price'] = 'Invalid price';
            $isValid = false;
        }

        return $isValid;
    }

    protected function save()
    {
         
    }

    protected function checkSKUExists($sku) : bool
    {
        $stmt = $this->db->prepare('SELECT 1 FROM products WHERE sku LIKE ?');
        $stmt->execute($sku);
        return $stmt->rowCount() > 0;
    }

    protected function validateString($val) : bool
    {
        if(!is_string($val) || strlen($val) == 0){
            return false;
        }
        return true;
    }

    protected function validateFloat($val) : bool 
    {
        if(!is_numeric($val) || !is_float($val)){
            return false;
        }
        return true;
    }

    protected function validateInt($val) : bool
    {
        if(!is_numeric($val) || !is_int($val)){
            return false;
        }
        return true;
    }
}