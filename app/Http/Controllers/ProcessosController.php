<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Agenda;


class ProcessosController extends Controller
{
    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agendas = Agenda::getActiveAgenda();
        return view('operacional.processos.index', compact('agendas'));
    }

}
