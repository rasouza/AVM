<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ambiente extends Model
{
    public function processos()
    {
        return $this->hasMany('App\Processo');
    }

    public function os()
    {
        return $this->belongsTo('App\Os');
    }

    public function soma($setor)
    {
        if ($this->processos()->where('setor', $setor)->count() == 0) return '-';
        return $this->processos()->where('setor', $setor)->sum('quantidade');
    }
    public function operador($setor)
    {
        if ($this->processos()->where('setor', $setor)->count() == 0) return '-';
        return $this->processos()->where('setor', $setor)->orderBy('id', 'desc')->first()->operador;
    }
    public function inventariado($setor)
    {
        return ($this->processos()->where('setor', $setor)->count() != 0)?'Sim':'Não';
    }
    public function auditado($setor)
    {
        return ($this->processos()->where('setor', $setor)->where('auditado', true)->count() != 0);
    }
}
