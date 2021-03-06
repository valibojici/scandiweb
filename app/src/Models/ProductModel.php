<?php

namespace App\Models;

abstract class ProductModel
{
    protected $fields = [
        'id' => false,
        'sku' => false,
        'name' => false,
        'price' => false
    ];
    protected $validator;
    protected array $errors;

    public function __construct($validator)
    {
        $this->validator = $validator;
    }

    public function setId($id)
    {
        $this->fields['id'] = $this->validator->validateInt($id);
        unset($this->errors['id']);
        return $this;
    }

    public function setSku($sku)
    {
        $this->fields['sku'] = $this->validator->validateString($sku);
        unset($this->errors['sku']);
        return $this;
    }

    public function setName($name)
    {
        $this->fields['name'] = $this->validator->validateString($name);
        unset($this->errors['name']);
        return $this;
    }

    public function setPrice($price)
    {
        $this->fields['price'] = $this->validator->validateFloat($price);
        unset($this->errors['price']);
        return $this;
    }

    public function getId()
    {
        return $this->fields['id'] ?? false;
    }

    public function getSku()
    {
        return $this->fields['sku'] ?? false;
    }

    public function getPrice()
    {
        return $this->fields['price'] ?? false;
    }

    public function getName()
    {
        return $this->fields['name'] ?? false;
    }

    public function getErrors() : array
    {
        return $this->errors ?? [];
    }

    public function isValid() : bool
    {
        foreach($this->fields as $fieldName => $fieldVal){
            $this->testAndSetError($fieldName);
        }
        return $this->errors == [];
    }

    public function getInfo() : array
    {
        return [
            'name' => $this->getName(),
            'sku' => $this->getSKU(),
            'price' => number_format($this->getPrice(),2) . '$'
        ];
    }

    private function testAndSetError($field)
    {
        $func = 'get' . $field;
        if($this->$func() === false){
            $this->errors[$field] = 'Invalid ' . $field;
        }
    }

    abstract public function getDisplayProperties();
    abstract public function getFields();

}