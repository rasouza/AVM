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
        $horas = DB::table('horas')
            ->selectRaw('horas.*, SUM(processos.quantidade) quantidade, clientes.nome cliente, agenda.data')
            ->leftJoin('os', 'horas.os_id', '=', 'os.id')
            ->leftJoin('ambientes', 'ambientes.os_id', '=', 'os.id')
            ->leftJoin('processos', 'ambientes.id', '=', 'processos.ambiente_id')
            ->leftJoin('agenda', 'agenda.id', '=', 'os.agenda_id')
            ->leftJoin('clientes', 'agenda.cliente_id', '=', 'clientes.id')
            ->where('horas.funcionario_id', $funcionario->id)
            ->where('processos.funcionario_id', $funcionario->id)
            ->groupBy('processos.funcionario_id')
            ->groupBy('os.id')
            ->get();
        $grupos = DB::table('horas')
            ->selectRaw('MONTH(agenda.data) mes, YEAR(agenda.data) ano')
            ->leftJoin('os', 'horas.os_id', '=', 'os.id')
            ->leftJoin('ambientes', 'ambientes.os_id', '=', 'os.id')
            ->leftJoin('processos', 'ambientes.id', '=', 'processos.ambiente_id')
            ->leftJoin('agenda', 'agenda.id', '=', 'os.agenda_id')
            ->leftJoin('clientes', 'agenda.cliente_id', '=', 'clientes.id')
            ->where('horas.funcionario_id', $funcionario->id)
            ->where('processos.funcionario_id', $funcionario->id)
            ->groupBy('processos.funcionario_id')
            ->groupBy('os.id')
            ->distinct()
            ->get();

        $horas = collect($horas)->map(function($v) {
            $v->data = new Date($v->data);
            return $v;
        });
        $grupos = collect($grupos)->map(function($v) use($horas) {
            $pecas = 0;
            $tempo = 0;
            $media = 0;
            foreach ($horas as $hora) {
                if($hora->data->month == $v->mes && $hora->data->year == $v->ano) {
                    $pecas += $hora->quantidade;
                    $tempo += $hora->horas;
                    $media += $hora->quantidade / $hora->horas;
                }
            }

            return [
                'quantidade' => $pecas,
                'horas' => $tempo,
                'media' => $media,
                'data' => Date::createFromDate($v->ano, $v->mes, 1)
                ];
        });


        return view('relatorios.horas', compact('funcionario', 'horas', 'grupos'));
    }

    /* Workaroud */
    public function create() {}

    public function txt(Os $os) { return response()->download("os/{$os->id}.txt"); }
    public function word(Os $os) { return response()->download("os/{$os->id}.pdf"); }
    public function excel(Os $os) { return response()->download("os/{$os->id}.csv"); }
}
