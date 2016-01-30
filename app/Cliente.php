<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $guarded = [];
    public function fichas()
    {
        return $this->hasOne('App\Ficha');
    }

    public function agendas()
    {
        return $this->hasMany('App\Agenda');
    }
}
