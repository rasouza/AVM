<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Os extends Model
{
    protected $table = 'os';
    protected $guarded = [];
    protected $casts = ['inventariantes' => 'array'];

    public function layout()
    {
        return $this->belongsTo('App\Layout');
    }

    public function coordenador()
    {
        return $this->belongsTo('App\Funcionario', 'coordenador_id');
    }

    public function agenda()
    {
        return $this->belongsTo('App\Agenda');
    }

    public function processos()
    {
        return $this->hasMany('App\Processo');
    }

    public function ambientes()
    {
        return $this->hasMany('App\Ambiente');
    }

}
