<?php

namespace App\Models;

class DvdModel extends ProductModel
{
    public function __construct($validator)
    {
        parent::__construct($validator);
        $this->fields['size'] = false;
    }

    public function setSize($val) : self
    {
        $this->fields['size'] = $this->validator->validateInt($val);
        unset($this->errors['size']);
        return $this;
    }

    public function getSize()
    {
        return $this->fields['size'] ?? false;
    }

    public function getProperties() : array
    {
        return [
            'size' => $this->getSize() . 'MB'
        ];
    }
}