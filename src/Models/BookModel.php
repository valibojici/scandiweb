<?php

namespace App\Models;

class BookModel extends ProductModel
{
    public function __construct($validator)
    {
        parent::__construct($validator);
        $this->fields['weight'] = false;
    }

    public function setWeight($val) : self
    {
        $this->fields['weight'] = $this->validator->validateInt($val);
        unset($this->errors['weight']);
        return $this;
    }

    public function getWeight()
    {
        return $this->fields['weight'] ?? false;
    }

    public function getProperties() : array
    {
        return [
            'weight' => $this->getWeight() . 'KG'
        ];
    }
}