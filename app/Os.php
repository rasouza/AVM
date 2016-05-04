<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use PDF;

class Os extends Model
{
    protected $table = 'os';
    protected $guarded = [];
    protected $casts = ['inventariantes' => 'array'];

    public function layout() { return $this->belongsTo('App\Layout'); }
    public function coordenador() { return $this->belongsTo('App\Funcionario', 'coordenador_id'); }
    public function agenda() { return $this->belongsTo('App\Agenda'); }
    public function processos() { return $this->hasManyThrough('App\Processo', 'App\Ambiente')->active(); }
    public function processos_divergentes() { return $this->hasManyThrough('App\Processo', 'App\Ambiente'); }
    public function ambientes() { return $this->hasMany('App\Ambiente'); }
    public function horas() { return $this->hasMany('App\Hora'); }

    public function getAmbiente($setor) {
        foreach ($this->ambientes as $ambiente)
            if ($setor >= $ambiente->inicio && $setor <= $ambiente->fim)
                return $ambiente;

        return new Ambiente();
    }

    public function getOperadores() {
        return $this->processos()
            ->join('ambientes AS a', 'processos.ambiente_id', '=', 'a.id')
            ->join('os', 'a.os_id', '=', 'os.id')
            ->leftJoin('horas', function ($j) {
                $j->on('processos.funcionario_id', '=', 'horas.funcionario_id')
                    ->on('horas.os_id', '=', 'os.id');
            })
            ->groupBy('processos.funcionario_id')
            ->selectRaw('sum(quantidade) as quantidade, processos.funcionario_id, horas')
            ->get();
    }

    // Funções do cabeçalho
    public function getDuplicidades() {
        $sql = "
            SELECT a.*, c.nome AS ambiente, d.nome AS funcionario FROM processos a 
            INNER JOIN (SELECT setor, codigo, count(*) AS qty FROM processos WHERE ambiente_id IN (".implode(',', $this->ambientes->pluck('id')->all()).") AND divergencia = 0 GROUP BY setor, codigo HAVING count(*) > 1) b 
                ON a.setor = b.setor AND a.codigo = b.codigo 
            INNER JOIN ambientes c ON a.ambiente_id = c.id  
            INNER JOIN funcionarios d ON d.id = a.funcionario_id
            WHERE ambiente_id IN (".implode(',', $this->ambientes->pluck('id')->all()).") 
                AND a.divergencia = 0
            ORDER BY a.codigo, a.setor
        ";

        return DB::select($sql);
    }
    public function getDivergencia() {
        $sql = "
            SELECT  a.*, c.nome AS ambiente, d.nome AS funcionario FROM processos a
            INNER JOIN (SELECT * FROM processos WHERE ambiente_id IN (".implode(',', $this->ambientes->pluck('id')->all()).") GROUP BY setor, codigo HAVING min(quantidade) <> max(quantidade) ) b
                ON a.setor = b.setor AND a.codigo = b.codigo
            INNER JOIN ambientes c ON a.ambiente_id = c.id  
            LEFT JOIN funcionarios d ON d.id = a.funcionario_id
            WHERE a.ambiente_id IN (".implode(',', $this->ambientes->pluck('id')->all()).")
            ORDER BY a.setor, a.codigo
        ";



        return DB::select($sql);
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
                .Os::formatar(floatval($processo->soma), $req['rbQuantidade'], $req['quantidade'])
                ."\r\n"
            );
        }
        fclose($fp);
    }

    public function finalizarCSV() {
        if (!file_exists('os/'))
            mkdir('os/');
        $fp = fopen("os/{$this->id}.csv", 'w');

        foreach ($this->processos as $processo) {
            $ambiente = mb_convert_encoding($processo->ambiente->nome, 'UTF-16LE', 'UTF-8');
            // Converte decimal para inteiro
            $quantidade = (fmod($processo->quantidade,1) == 0)? intval($processo->quantidade) : $processo->quantidade;
            $operador = ($processo->funcionario)? mb_convert_encoding($processo->funcionario->nome, 'UTF-16LE', 'UTF-8') : 'Divergente';
            fputcsv($fp, [
                $ambiente,
                $processo->setor,
                $processo->codigo,
                floatval($quantidade),
                $operador
            ]);
        }

        fclose($fp);
    }

    public function finalizarPDF() {
        PDF::loadView('relatorios.pdf', ['os' => $this])->save("os/{$this->id}.pdf");
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
