<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Processo extends Model
{
    protected $guarded = [];
    public function getOperadorAttribute($v) { return ucfirst($v); }
    public function setOperadorAttribute($v) { $this->attributes['operador'] = strtolower($v); }

    public function os()
    {
        return $this->ambiente->os();
    }

    public function ambiente()
    {
        return $this->belongsTo('App\Ambiente');
    }

    public function funcionario()
    {
        return $this->belongsTo('App\Funcionario');
    }

    
}
