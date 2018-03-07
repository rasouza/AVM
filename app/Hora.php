<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hora extends Model
{
    protected $guarded = [];

    public function os() { return $this->belongsTo('App\Os'); }
    public function funcionario() { return $this->belongsTo('App\Funcionario'); }

    public function setHorasAttribute($v) {
        $this->attributes['horas'] = $v ? $v : 4; // Horas trabalhadas 4 por default
    }
}
