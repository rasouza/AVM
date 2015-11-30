<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Filial extends Model
{
    public function agenda()
    {
        return $this->belongsTo('Agenda');
    }

    public function uf()
    {
        return $this->hasOne('Uf');
    }
}
