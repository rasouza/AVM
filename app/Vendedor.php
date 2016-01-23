<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendedor extends Model
{
    protected $table = "vendedores";
    public function cargo()
    {
        return $this->belongsTo('App\Cargo');
    }

    public function os()
    {
        return $this->hasMany('App\Os', 'coordenador_id');
    }
}
