<?php

namespace App\Http\Controllers;

use App\Vendedor;
use App\Os;
use Illuminate\Http\Request;

use App\Http\Requests;

class OsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $oses = Os::join('agenda', 'agenda.id', '=', 'os.agenda_id')
            ->where('os.status', '<>', 'concluido')
            ->orderBy('agenda.data', 'asc')
            ->select('os.*')
            ->get();
        return view('operacional.os.index', compact('oses'));
    }

    /**
     * Display the specified resource.
     *
     * @param  Os $os
     * @return \Illuminate\Http\Response
     */
    public function show(Os $os)
    {
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
        $action = 'OsController@update';
        $necessarios = ceil($os->agenda->pecas/(300*6));
        $inventariantes = Vendedor::join('cargos', 'vendedores.cargo_id', '=', 'cargos.id')
            ->join('funcionarios', 'funcionarios.id', '=', 'vendedores.funcionario_id')
            ->where('cargos.nome', 'Inventariante')
            ->select('vendedores.id', 'funcionarios.nome')
            ->get()->lists('nome','id');
        $coordenadores = Vendedor::join('cargos', 'vendedores.cargo_id', '=', 'cargos.id')
            ->join('funcionarios', 'funcionarios.id', '=', 'vendedores.funcionario_id')
            ->where('cargos.nome', 'Coordenador')
            ->select('vendedores.id', 'funcionarios.nome')
            ->get()->lists('nome','id');

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
        $os->update($request->except('action', 'sendbutton'));
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
        $os->agenda()->delete();
        $os->delete();
        return redirect()->action('OsController@index');
    }
}
