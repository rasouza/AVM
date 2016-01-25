<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendedor extends Model
{
    protected $table = "vendedores";
    protected $fillable = ['password'];

    public function funcionario()
    {
        return $this->belongsTo('App\Funcionario');
    }

    public function cargo()
    {
        return $this->belongsTo('App\Cargo');
    }

    public function filial()
    {
        return $this->belongsTo('App\Filial');
    }

    public function os()
    {
        return $this->hasMany('App\Os', 'coordenador_id');
    }
}
