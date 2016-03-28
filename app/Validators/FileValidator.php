<?php

namespace App\Validators;

use File;
use App\Os;

class FileValidator
{
    public function nonExists($attribute, $value, $parameters, $validator) {
        return !File::exists("processos/{$value->getClientOriginalName()}");
    }

    public function operadorExists ($attribute, $value, $parameters, $validator) {
        return in_array($parameters[0], array_slice($parameters, 1));
    }
}