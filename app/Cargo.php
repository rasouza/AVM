<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    public function vendedores()
    {
        return $this->hasMany('App\Vendedor');
    }
}
