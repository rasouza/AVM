<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $guarded = [];
    protected $casts = [
        'propostaBegin' => 'date',
        'propostaEnd' => 'date',
        'faturamento' => 'boolean',
        'especial'  => 'array'
    ];

    public function getPercentualAttribute($v) { return str_replace('.', ',', sprintf("%05.2f", $v)); }
    public function setPercentualAttribute($v) { $this->attributes['percentual'] = str_replace(',', '.', $v); }

    public function getPecaAttribute($v) { return str_replace('.', ',', $v); }
    public function setPecaAttribute($v) { $this->attributes['peca'] = str_replace(',', '.', $v); }

    public function ficha()
    {
        return $this->hasOne('App\Ficha');
    }

    public function agendas()
    {
        return $this->hasMany('App\Agenda');
    }

    public function vendedor()
    {
        return $this->belongsTo('App\Funcionario', 'vendedor_id');
    }

    public function gerente()
    {
        return $this->belongsTo('App\Funcionario', 'gerente_id');
    }
}
