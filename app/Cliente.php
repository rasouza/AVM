<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    // fichas agenda
    public function ficha()
    {
        return $this->belongsTo('Ficha');
    }

    public function agenda()
    {
        return $this->belongsTo('Agenda');
    }
}
