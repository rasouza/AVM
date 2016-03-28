<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Preco extends Model
{
    use Traits\ActiveScope;

    protected $guarded = [];

    public function filial() { return $this->belongsTo('App\Filial'); }
}
