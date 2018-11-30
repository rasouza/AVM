<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use PDF;
use Storage;

class Os extends Model
{
    protected $table = 'os';
    protected $guarded = [];
    protected $casts = ['inventariantes' => 'array'];

    private $_inventariado = null;
    private $_auditado = null;
    private $_total = null;

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
            ->selectRaw('sum(quantidade) as quantidade, processos.funcionario_id, horas, comentario')
            ->get();
    }

    // Funções do cabeçalho
    public function getDuplicidades() {
        $ambienteIds = implode(',', $this->ambientes->pluck('id')->all());
        $sql = "
            SELECT a.*, c.nome AS ambiente, d.nome AS funcionario FROM processos a
            INNER JOIN (SELECT setor, codigo, count(*) AS qty FROM processos WHERE ambiente_id IN ($ambienteIds) AND divergencia = 0 GROUP BY setor, codigo HAVING count(*) > 1) b
                ON a.setor = b.setor AND a.codigo = b.codigo
            INNER JOIN ambientes c ON a.ambiente_id = c.id
            INNER JOIN funcionarios d ON d.id = a.funcionario_id
            WHERE ambiente_id IN ($ambienteIds)
                AND a.divergencia = 0
            ORDER BY a.codigo, a.setor
        ";

        return DB::select($sql);
    }
    public function getDivergencia() {
        $ambienteIds = implode(',', $this->ambientes->pluck('id')->all());
        $sql = "
            SELECT  a.*, c.nome AS ambiente, d.nome AS funcionario FROM processos a
            INNER JOIN (SELECT * FROM processos WHERE ambiente_id IN ($ambienteIds) GROUP BY setor, codigo HAVING min(quantidade) <> max(quantidade) ) b
                ON a.setor = b.setor AND a.codigo = b.codigo
            INNER JOIN ambientes c ON a.ambiente_id = c.id
            LEFT JOIN funcionarios d ON d.id = a.funcionario_id
            WHERE a.ambiente_id IN ($ambienteIds)
            ORDER BY a.setor, a.codigo
        ";

        return DB::select($sql);
    }
    public function total() {
        $sum = 0;
        $ambientes = $this->ambientes;
        foreach ($ambientes as $ambiente)
            $sum += $ambiente->fim - $ambiente->inicio + 1;

        $this->_total = $sum;
        return $sum;
    }
    public function inventariados() {
        $this->_inventariado = $this->processos()
                ->groupBy('setor')
                ->get()
                ->count();
        return min($this->_total, $this->_inventariado);
    }
    public function auditados() {
        $this->_auditado = $this->processos()
                ->where('auditado', true)
                ->groupBy('setor')
                ->get()
                ->count();
        return min($this->_auditado, $this->_total);
    }
    public function progresso() { return 100*(($this->_inventariado + $this->_auditado) / (2 * $this->_total)); }
    public function pecas() { return (int) $this->processos()->sum('quantidade'); }

    public function finalizar($req) {
        $processos = $this->processos()
            ->groupBy('codigo')
            ->selectRaw('sum(quantidade) as soma, codigo')
            ->get();

        foreach ($processos as $processo) {
            Storage::disk('local')->append(
                "os/{$this->id}.txt",
                Os::formatar($processo->codigo, $req['rbCodigo'], $req['codigo'])
                .$req['separador']
                .Os::formatar(floatval($processo->soma), $req['rbQuantidade'], $req['quantidade'])
                .PHP_EOL
            );
        }
        Storage::put("os/{$this->id}/os.txt", Storage::disk('local')->get("os/{$this->id}.txt"));
    }

    public function finalizarCSV() {
        if (!file_exists('download/os/'))
            mkdir('download/os/');
        $fp = fopen("download/os/{$this->id}.csv", 'w');

        fputcsv($fp, ['ambiente', 'setor', 'codigo', 'quantidade', 'operador']);

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
        Storage::put("os/{$this->id}/relatorio.csv", Storage::disk('local')->get("os/{$this->id}.csv"));
    }

    public function finalizarPDF($data) {
        $inventariantes = collect($this->inventariantes)->map(function ($v) {
            return Funcionario::find($v);
        });
        @PDF::loadView('relatorios.pdf', ['os' => $this, 'inventariantes' => $inventariantes, 'data' => $data])->save("download/os/{$this->id}.pdf");
        Storage::put("os/{$this->id}/relatorio.pdf", Storage::disk('local')->get("os/{$this->id}.pdf"));
    }

    public static function formatar($val, $type, $len) {
        switch ($type) {
            case 'zero':
                return str_pad($val, $len, '0', STR_PAD_LEFT);
                break;

            case 'espaco':
                return str_pad($val, $len);
                break;

            case 'direita':
                return str_pad($val, $len, '0', STR_PAD_RIGHT);
                break;

            default:
                return $val;
                break;
        }
    }
}
