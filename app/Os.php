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
        return $this->hasManyThrough('App\Processo', 'App\Ambiente');
    }

    public function ambientes()
    {
        return $this->hasMany('App\Ambiente');
    }

    public function total() {
        $sum = 0;
        $ambientes = $this->ambientes;
        foreach ($ambientes as $ambiente)
            $sum += $ambiente->fim - $ambiente->inicio + 1;

        return $sum;
    }

    public function inventariados() { return min($this->processos()->count(), $this->total()); }
    public function auditados() { return min($this->processos()->where('auditado', true)->count(), $this->total()); }
    public function progresso() { return 100*($this->inventariados() + $this->auditados()) / (2 * $this->total()); }
    public function pecas() { return (int) $this->processos()->sum('quantidade'); }
}
