<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Preco extends Model
{
    protected $guarded = [];

    public function filial() { return $this->belongsTo('App\Filial'); }
}
