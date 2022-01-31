<?php

namespace App\Models;

class Validate
{
    public function validateInt($val) : int|false
    {
        return filter_var($val, FILTER_VALIDATE_INT);
    }

    public function validateFloat($val) : float|false
    {
        return filter_var($val, FILTER_VALIDATE_FLOAT);
    }

    public function validateString($val) : string|false
    {
        if(!is_string($val)){
            return false;
        }
        $val = trim($val);
        return strlen($val) === 0 ? false : $val;
    }
}