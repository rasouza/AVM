<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    protected $fillable = [
        'uf_id',
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

    public static function getAllByCargo($cargo)
    {
        return self::join('vendedores', 'vendedores.funcionario_id', '=', 'funcionarios.id')
            ->join('cargos', 'vendedores.cargo_id', '=', 'cargos.id')
            ->where('cargos.nome', ucfirst($cargo))
            ->select('funcionarios.*')
            ->get();
    }
}
