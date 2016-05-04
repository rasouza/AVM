<?php

namespace App\Http\Controllers;

use App\Os;
use App\Agenda;
use Carbon\Carbon;
use PDF;

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
            ->where('data', '>', new Carbon('6 months ago'))
            ->orderBy('data', 'DESC')
            ->get();

        return view('relatorios.index', compact('agendas'));
    }

    public function backup()
    {
        $agendas = Agenda::whereHas('os', function($q) { $q->where('status', 'concluido'); })
            ->where('data', '>', new Carbon('6 months ago'))
            ->orderBy('data', 'DESC')
            ->get();

        return view('relatorios.backup', compact('agendas'));
    }

    /* Workaroud */
    public function create() {}

    public function txt(Os $os) { return response()->download("os/{$os->id}.txt"); }
    public function word(Os $os) { return response()->download("os/{$os->id}.pdf"); }
    public function excel(Os $os) { return response()->download("os/{$os->id}.csv"); }
}
