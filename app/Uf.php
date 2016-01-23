<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Uf extends Model
{
    public function filiais()
    {
        return $this->hasMany('App\Filial');
    }

    public function fichas()
    {
        return $this->hasMany('App\Fichas');
    }

    public function funcionarios()
    {
        return $this->hasMany('App\Funcionario');
    }
}
