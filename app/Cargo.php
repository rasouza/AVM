<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Auth;
use Gate;

class Cargo extends Model
{
    protected $fillable = ['nome'];

    public function vendedores() { return $this->hasMany('App\Vendedor'); }

    public static function dropdown() {
        $cargos = self::orderBy('nome', 'asc');

        if (Gate::denies('administrador'))
            $cargos->where('id', '>', Auth::user()->cargo->id);

        return $cargos->get()->lists('nome', 'id');
    }
}
