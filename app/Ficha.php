<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ficha extends Model
{
    protected $guarded = [];

    public function getGerenteAttribute($v) { return ucfirst($v); }
    public function setGerenteAttribute($v) { $this->attributes['gerente'] = ucfirst($v); }

    public function cliente() { return $this->belongsTo('App\Cliente'); }
    public function uf() { return $this->belongsTo('App\Uf'); }
}
