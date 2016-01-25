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

    public function os()
    {
        // @TODO: Listar todas as O.S. que o funcionario participou
    }
}
