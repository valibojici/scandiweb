<?php

namespace App\Models;

class FurnitureModel extends ProductModel
{
    public function __construct($validator)
    {
        parent::__construct($validator);
        $this->fields['width'] = false;
        $this->fields['height'] = false;
        $this->fields['length'] = false;
    }

    public function setWidth($val) : self
    {
        $this->fields['width'] = $this->validator->validateInt($val);
        unset($this->errors['width']);
        return $this;
    }

    public function setHeight($val) : self
    {
        $this->fields['height'] = $this->validator->validateInt($val);
        unset($this->errors['height']);
        return $this;
    }

    public function setLength($val) : self
    {
        $this->fields['length'] = $this->validator->validateInt($val);
        unset($this->errors['length']);
        return $this;
    }

    public function getWidth()
    {
        return $this->fields['width'] ?? false;
    }

    public function getHeight()
    {
        return $this->fields['height'] ?? false;
    }

    public function getLength()
    {
        return $this->fields['length'] ?? false;
    }

    public function getDisplayProperties()
    {
        return [
            'dimensions' => implode('x',[$this->getHeight(), $this->getWidth(), $this->getLength()]) . 'CM'
        ];
    }

    public function getFields()
    {
        $fields = ['height', 'width', 'length'];
        return array_map(function($elem) { return ['name' => $elem, 'unit' => 'CM']; }, $fields);
    }
}