<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Preco extends Model
{
    protected $fillable = [
        'nome',
        'esporadico_qtd',
        'esporadico_preco',
        'semestral_qtd',
        'semestral_preco',
        'quadrimestral_qtd',
        'quadrimestral_preco',
        'trimestral_qtd',
        'trimestral_preco',
        'bimestral_qtd',
        'bimestral_preco',
        'mensal_qtd',
        'mensal_preco'
    ];
}
