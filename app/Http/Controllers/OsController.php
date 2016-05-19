<?php

namespace App\Http\Controllers;

use App\Funcionario;
use App\Os;
use App\Agenda;
use Illuminate\Http\Request;

use App\Http\Requests;

class OsController extends Controller
{
    function __construct() {  }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('coordenador');
        $agendas = Agenda::getActiveAgenda();

        return view('operacional.os.index', compact('agendas'));
    }

    /**
     * Display the specified resource.
     *
     * @param  Os $os
     * @return \Illuminate\Http\Response
     */
    public function show(Os $os)
    {
        $this->authorize('gerente');
        return view('operacional.os.show', compact('os'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Os $os
     * @return \Illuminate\Http\Response
     */
    public function edit(Os $os)
    {
        $this->authorize('gerente');
        $action = 'OsController@update';
        $necessarios = ceil($os->agenda->pecas/(300*6));
        $inventariantes = Funcionario::getAllByCargo('inventariante')->lists('nome', 'id');
        $coordenadores = Funcionario::getAllByCargo('coordenador')->lists('nome', 'id');

        return view('operacional.os.form', compact('necessarios', 'inventariantes', 'coordenadores', 'os', 'action'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Os $os
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Os $os)
    {
        $this->authorize('gerente');
        $req = $request->except('action', 'sendbutton');
        if (isset($req['inventariantes']))
            $req['inventariantes'] = array_unique($req['inventariantes']);
        $os->update($req);
        echo "O.S. editada";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Os $os
     * @return \Illuminate\Http\Response
     */
    public function destroy(Os $os)
    {
        $this->authorize('gerente');
        $os->agenda()->delete();
        $os->delete();
        return redirect()->action('OsController@index');
    }
}
