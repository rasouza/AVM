<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Funcionario extends Model
{
    use Traits\ActiveScope;
    
    protected $guarded = [];

    public function getNomeAttribute($v) { return ucfirst($v); }

    public function filial() { return $this->belongsTo('App\Filial'); }
    public function vendedor() { return $this->hasOne('App\Vendedor'); }
    public function processos() { return $this->hasMany('App\Processo'); }
    public function uf() { return $this->belongsTo('App\Uf'); }
    public function cargo() { return $this->vendedor->cargo(); }
    public function os() { return $this->hasMany('App\Os', 'coordenador_id'); }
    public function horas() { return $this->hasMany('App\Hora')->orderBy('created_at', 'DESC'); }

    public static function getAllByCargo($cargo)
    {
        return self::join('vendedores', 'vendedores.funcionario_id', '=', 'funcionarios.id')
            ->join('cargos', 'vendedores.cargo_id', '=', 'cargos.id')
            ->where('cargos.nome', ucfirst($cargo))
            ->select('funcionarios.*')
            ->get();
    }

    public static function dropdown() {
        return self::active()
            ->orderBy('nome', 'asc')
            ->get()
            ->lists('nome', 'id');
    }
}
