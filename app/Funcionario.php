<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    public function processos()
    {
        return $this->hasMany('App\Processo');
    }
    public function uf()
    {
        return $this->belongsTo('App\Uf');
    }

    public function os()
    {
        // @TODO: Listar todas as O.S. que o funcionario participou
    }
}
