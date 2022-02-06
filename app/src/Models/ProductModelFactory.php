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
        $type = ucwords(strtolower($type));
        $class = '\\App\\Models\\' . $type . 'Model';
        return class_exists($class) ? new $class($this->validator) : null;
    }
}