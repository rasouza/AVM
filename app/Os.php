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
    public function processos() { return $this->hasManyThrough('App\Processo', 'App\Ambiente')->active(); }
    public function ambientes() { return $this->hasMany('App\Ambiente'); }
    
    public function getAmbiente($setor) {
        foreach ($this->ambientes as $ambiente)
            if ($setor >= $ambiente->inicio && $setor <= $ambiente->fim)
                return $ambiente;

        return new Ambiente();
    }

    // Funções do cabeçalho
    public function getDuplicidades() {
        $duplicidades = [];
        foreach ($this->ambientes as $ambiente) {
            $subsql = "SELECT setor, codigo, count(*) AS qty FROM processos WHERE ambiente_id = ? AND divergencia = 0 GROUP BY setor, codigo HAVING count(*) > 1";
            $sql = "SELECT a.*, c.nome AS ambiente, d.nome AS funcionario FROM processos a 
              INNER JOIN ($subsql) b ON a.setor = b.setor AND a.codigo = b.codigo 
              INNER JOIN ambientes c ON a.ambiente_id = c.id  
              INNER JOIN funcionarios d ON d.id = a.funcionario_id
              WHERE ambiente_id = ? AND a.divergencia = 0
              ORDER BY a.codigo ASC, a.setor ASC";
            $result = DB::select($sql, [$ambiente->id, $ambiente->id]);
            if (!empty($result))
                $duplicidades[] = $result;
        }

        if (!empty($duplicidades))
            $duplicidades = reset($duplicidades);

        return $duplicidades;
    }
    public function getDivergencia() {
        $duplicidades = [];
        foreach ($this->ambientes as $ambiente) {
            $sql = "
                SELECT a.*, c.nome AS ambiente, d.nome AS funcionario FROM processos a
                INNER JOIN processos b ON a.setor = b.setor AND a.codigo = b.codigo
				INNER JOIN ambientes c ON a.ambiente_id = c.id  
				LEFT JOIN funcionarios d ON d.id = a.funcionario_id
				WHERE a.setor = b.setor
				    AND a.codigo = b.codigo
				    AND a.quantidade <> b.quantidade
				    AND a.divergencia <> b.divergencia
				    AND a.ambiente_id = ?
			";
            $result = DB::select($sql, [$ambiente->id]);
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
    public function inventariados() { return min($this->processos()->groupBy('setor')->get()->count(), $this->total()); }
    public function auditados() { return min($this->processos()->where('auditado', true)->groupBy('setor')->get()->count(), $this->total()); }
    public function progresso() { return 100*($this->inventariados() + $this->auditados()) / (2 * $this->total()); }
    public function pecas() { return (int) $this->processos()->sum('quantidade'); }
    
    public function finalizar($req) {
        if (!file_exists('os/'))
            mkdir('os/');
        $fp = fopen("os/{$this->id}.txt", 'w');

        $processos = $this->processos()
            ->groupBy('codigo')
            ->selectRaw('sum(quantidade) as soma, codigo')
            ->get();

        foreach ($processos as $processo) {
            fwrite(
                $fp,
                Os::formatar($processo->codigo, $req['rbCodigo'], $req['codigo'])
                .$req['separador']
                .Os::formatar($processo->soma, $req['rbQuantidade'], $req['quantidade'])
                .PHP_EOL
            );
        }
        fclose($fp);

        //TODO: Mandar email
        //TODO: Finalizar OS
    }

    public static function formatar($val, $type, $len) {
        switch ($type) {
            case 'zero':
                return str_pad($val, $len, '0', STR_PAD_LEFT);
                break;

            case 'espaco':
                return str_pad($val, $len);
                break;

            default:
                return $val;
                break;
        }
    }
}
