<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ambiente extends Model
{
    public function processos()
    {
        return $this->hasMany('App\Processo');
    }

    public function os()
    {
        return $this->belongsTo('App\Os');
    }


}
