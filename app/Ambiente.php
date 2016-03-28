<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ambiente extends Model
{
    public function processos() { return $this->hasMany('App\Processo')->active(); }
    public function os() { return $this->belongsTo('App\Os'); }

    public function soma($setor)
    {
        if ($this->processos()->where('setor', $setor)->count() == 0) return '-';
        return $this->processos()->where('setor', $setor)->sum('quantidade');
    }
    public function operador($setor)
    {
        $proc = $this->processos()->where('setor', $setor)->orderBy('id', 'desc')->first();
        if (is_null($proc)) return '-';
        elseif (is_null($proc->funcionario)) return 'Gerente responsável';
        else return $proc->funcionario->nome;
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
