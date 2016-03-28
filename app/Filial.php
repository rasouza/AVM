<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Filial extends Model
{

    protected $table = 'filiais';
    protected $fillable = ['nome', 'uf_id'];

    public function funcionarios() { return $this->hasMany('App\Funcionario'); }
    public function uf() { return $this->belongsTo('App\Uf'); }
    public function agendas() { return $this->hasMany('App\Agenda'); }
    public function precos() { return $this->hasMany('App\Preco'); }
    public function clientes() { return $this->hasMany('App\Cliente'); }

    public static function dropdown() {
        return self::orderBy('nome', 'asc')->get()->lists('nome', 'id');
    }
}
