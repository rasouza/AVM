<?php

namespace App\Http\Controllers;

use App\Os;
use App\Agenda;
use Illuminate\Http\Request;

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
            ->orderBy('data')
            ->get();

        return view('operacional.relatorios.index', compact('agendas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

   public function word() {}
   public function excel(Os $os) {
       return response()->download("os/{$os->id}.csv");
   }
}
