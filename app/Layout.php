<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Layout extends Model
{
    public function os()
    {
        return $this->hasMany('App\Os');
    }
}
