<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    protected $fillable = ['nome'];

    public function vendedores() { return $this->hasMany('App\Vendedor'); }

    public static function dropdown() {
        return self::orderBy('nome', 'asc')->get()->lists('nome', 'id');
    }
}
