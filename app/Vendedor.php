<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendedor extends Model
{
    protected $table = "vendedores";
    protected $fillable = ['senha'];

    public function funcionario()
    {
        return $this->belongsTo('App\Funcionario');
    }

    public function cargo()
    {
        return $this->belongsTo('App\Cargo');
    }

    public function os()
    {
        return $this->hasMany('App\Os', 'coordenador_id');
    }
}
