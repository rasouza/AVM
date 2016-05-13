<?php

namespace App\Http\Controllers;

use App\Os;
use App\Agenda;
use Carbon\Carbon;
use App\Funcionario;
use PDF;
use Date;
use DB;

use Debugbar;

use App\Http\Requests;

class RelatoriosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agendas = Agenda::whereHas('os', function($q) { $q->where('status', 'concluido'); })
            ->active()
            ->where('data', '>', new Carbon('6 months ago'))
            ->orderBy('data', 'DESC')
            ->get();

        return view('relatorios.index', compact('agendas'));
    }

    public function backup()
    {
        $agendas = Agenda::whereHas('os', function($q) { $q->where('status', 'concluido'); })
            ->active()
            ->where('data', '>', new Carbon('6 months ago'))
            ->orderBy('data', 'DESC')
            ->get();

        return view('relatorios.backup', compact('agendas'));
    }

    public function funcionarios()
    {
        $funcionario = Funcionario::with('uf')
            ->active()
            ->orderBy('nome', 'asc')
            ->get();
        return view('relatorios.funcionarios', [ 'funcionarios' => $funcionario ]);
    }

    public function horas(Funcionario $funcionario)
    {
        Date::setLocale('pt-BR');

        $horas = DB::table('horas')
            ->selectRaw('horas.*, SUM(processos.quantidade) quantidade, clientes.nome cliente, agenda.data, CONCAT(MONTH(agenda.data), \'/\', YEAR(agenda.data)) grupo')
            ->leftJoin('os', 'horas.os_id', '=', 'os.id')
            ->leftJoin('ambientes', 'ambientes.os_id', '=', 'os.id')
            ->leftJoin('processos', 'ambientes.id', '=', 'processos.ambiente_id')
            ->leftJoin('agenda', 'agenda.id', '=', 'os.agenda_id')
            ->leftJoin('clientes', 'agenda.cliente_id', '=', 'clientes.id')
            ->where('horas.funcionario_id', $funcionario->id)
            ->where('processos.funcionario_id', $funcionario->id)
            ->where('agenda.data', '>', new Carbon('12 months ago'))
            ->groupBy('processos.funcionario_id')
            ->groupBy('os.id')
            ->get();

        $grupos = collect($horas)->groupBy('grupo')->map(function($v, $k) {
            $pecas = 0;
            $tempo = 0;
            $media = 0;

            $k = explode('/', $k);
            $data = Date::createFromDate($k[1], $k[0], 1);

            foreach ($v as $hora) {
                $pecas += $hora->quantidade;
                $tempo += $hora->horas;
                $media += $hora->quantidade / $hora->horas;
                $hora->data = new Date($hora->data);
            }

            return [
                'quantidade' => $pecas,
                'tempo' => $tempo,
                'media' => $media,
                'data' => $data,
                'horas' => $v
            ];
        });

        return view('relatorios.horas', compact('funcionario', 'grupos'));
    }

    /* Workaroud */
    public function create() {}

    public function txt(Os $os) { return response()->download("os/{$os->id}.txt"); }
    public function word(Os $os) { return response()->download("os/{$os->id}.pdf"); }
    public function excel(Os $os) { return response()->download("os/{$os->id}.csv"); }
}
