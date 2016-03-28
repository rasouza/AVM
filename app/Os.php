<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Os extends Model
{
    protected $table = 'os';
    protected $guarded = [];
    protected $casts = ['inventariantes' => 'array'];

    public function layout() { return $this->belongsTo('App\Layout'); }
    public function coordenador() { return $this->belongsTo('App\Funcionario', 'coordenador_id'); }
    public function agenda() { return $this->belongsTo('App\Agenda'); }
    public function processos() { return $this->hasManyThrough('App\Processo', 'App\Ambiente'); }
    public function ambientes() { return $this->hasMany('App\Ambiente'); }
    
    public function getAmbiente($setor) {
        foreach ($this->ambientes as $ambiente)
            if ($setor >= $ambiente->inicio && $setor <= $ambiente->fim)
                return $ambiente;

        return new Ambiente();
    }

    public function getDuplicidades() {
        $duplicidades = [];
        foreach ($this->ambientes as $ambiente) {
            $subsql = "SELECT setor, codigo, count(*) AS qty FROM processos WHERE ambiente_id = ? GROUP BY setor, codigo HAVING count(*) > 1";
            $sql = "SELECT a.*, c.nome AS ambiente FROM processos a 
              INNER JOIN ($subsql) b ON a.setor = b.setor AND a.codigo = b.codigo 
              INNER JOIN ambientes c ON a.ambiente_id = c.id  
              WHERE ambiente_id = ?";
            $result = DB::select($sql, [$ambiente->id, $ambiente->id]);
            if (!empty($result))
                $duplicidades[] = $result;
        }

        if (!empty($duplicidades))
            $duplicidades = reset($duplicidades);

        return $duplicidades;
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
