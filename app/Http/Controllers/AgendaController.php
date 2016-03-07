<?php

namespace App\Http\Controllers;

use App\Agenda;
use App\Cliente;
use App\Filial;
use App\Os;
use Illuminate\Http\Request;

use App\Http\Requests;

class AgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agendas = Agenda::join('os', 'os.agenda_id', '=', 'agenda.id')
            ->where('os.status', '<>' ,'concluido')
            ->orderBy('data', 'asc')
            ->get();
        return view('operacional.agenda.index', compact('agendas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $action = 'AgendaController@store';
        $agenda = new Agenda();
        $filiais = Filial::orderBy('nome', 'asc')->get()->lists('nome', 'id');
        $clientes = Cliente::orderBy('nome', 'asc')->get()->lists('nome', 'id');

        return view('operacional.agenda.form', compact('filiais', 'agenda', 'clientes', 'action'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $agenda = Agenda::create($request->except('action', 'sendbutton'));
        $agenda->os()->create([]);

        echo "Agenda cadastrada";
    }

    /**
     * Display the specified resource.
     *
     * @param  Agenda $agenda
     * @return \Illuminate\Http\Response
     */
    public function show(Agenda $agenda)
    {
        return view('operacional.agenda.show', compact('agenda'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Agenda $agenda
     * @return \Illuminate\Http\Response
     */
    public function edit(Agenda $agenda)
    {
        $action = 'AgendaController@update';
        $filiais = Filial::orderBy('nome', 'asc')->get()->lists('nome', 'id');
        $clientes = Cliente::orderBy('nome', 'asc')->get()->lists('nome', 'id');

        return view('operacional.agenda.form', compact('filiais', 'agenda', 'clientes', 'action'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Agenda $agenda
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Agenda $agenda)
    {
        $agenda->update($request->except('action', 'sendbutton'));
        echo "Agenda editada";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Agenda $agenda
     * @return \Illuminate\Http\Response
     */
    public function destroy(Agenda $agenda)
    {
        $agenda->os()->delete();
        $agenda->delete();
        return redirect()->action('AgendaController@index');
    }
}
