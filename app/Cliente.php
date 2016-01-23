<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    // fichas agenda
    public function fichas()
    {
        return $this->hasMany('App\Ficha');
    }

    public function agendas()
    {
        return $this->hasMany('App\Agenda');
    }
}
