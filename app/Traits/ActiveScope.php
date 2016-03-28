<?php

namespace App\Traits;

use Gate;
use Auth;

trait ActiveScope {
    public function scopeActive($query) {
        if (Gate::allows('administrador'))
            return $query;
        else
            return $query->where('filial_id', Auth::user()->funcionario->filial->id);
    }
}