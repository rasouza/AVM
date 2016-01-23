<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Filial extends Model
{

    protected $table = 'filiais';

    public function uf()
    {
        return $this->belongsTo('App\Uf');
    }

    public function agendas()
    {
        return $this->hasMany('App\Agenda');
    }
}
