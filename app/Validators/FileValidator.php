<?php

namespace App\Validators;

use Validator;
use File;


class FileValidator
{
    public function nonExists($attribute, $value, $parameters, $validator) {
        return !File::exists("processos/{$value->getClientOriginalName()}");
    }
}