<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hora extends Model
{
    protected $guarded = [];

    public function os() { return $this->belongsTo('App\Os'); }
    public function funcionario() { return $this->belongsTo('App\Funcionario'); }
}
