<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    protected $fillable = [
        'nome',
        'endereco',
        'bairro',
        'cep',
        'cidade',
        'telefone',
        'email',
        'cpf',
        'rg',
        'pis'
    ];

    public function vendedor()
    {
        return $this->hasOne('App\Vendedor');
    }
    public function processos()
    {
        return $this->hasMany('App\Processo');
    }
    public function uf()
    {
        return $this->belongsTo('App\Uf');
    }

    public function cargo()
    {
        return $this->vendedor->cargo();
    }

    public function os()
    {
        return $this->hasMany('App\Os', 'coordenador_id');
    }
}
