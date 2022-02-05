<?php 

namespace App\Models;

class ProductModelFactory
{
    private $validator;
    public function __construct($validator)
    {
        $this->validator = $validator;
    }

    public function getModel(string $type)
    {
        $type = ucwords($type);
        $class = '\\App\\Models\\' . $type . 'Model';
        return new $class($this->validator);
    }
}