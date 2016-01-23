<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    protected $table = 'agenda';
    public function cliente()
    {
        return $this->belongsTo('App\Cliente');
    }

    public function filial()
    {
        return $this->belongsTo('App\Filial');
    }

    public function os()
    {
        return $this->hasMany('App\Os');
    }
}
