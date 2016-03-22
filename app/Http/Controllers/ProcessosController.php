<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Os;

class ProcessosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $oses = Os::where('status', 'confirmado')->get();
        return view('operacional.processos.index', compact('oses'));
    }

    public function create() {}

    public function destroy(Os $os, $setor) {
        $os->processos()->where('setor', $setor)->delete();
        return redirect()->action('ProcessosController@principal', [$os]);
    }

    public function parse()
    {

    }

    public function principal(Os $os) {

        $total = $os->total();
        $inventariados = $os->inventariados();
        $auditados = $os->auditados();
        $progresso = $os->progresso();
        $pecas = $os->pecas();

        $os = $os->with('ambientes.processos')->first();

        return view('operacional.processos.principal', compact('os', 'total', 'inventariados', 'auditados', 'progresso', 'pecas'));
    }

    public function auditar(Os $os, Request $request)
    {
        $processos = $os->processos()->whereIn('setor', $request->auditar)->get();
        foreach ($processos as $processo) {
            $processo->auditado = true;
            $processo->save();
        }
        return redirect()->action('ProcessosController@auditoria', [$os]);
    }

    public function auditoria(Os $os) {
        $total = $os->total();
        $inventariados = $os->inventariados();
        $auditados = $os->auditados();
        $progresso = $os->progresso();
        $pecas = $os->pecas();

        $os = $os->with('ambientes.processos')->first();
        $processos = $os->processos()->where('auditado', false)->groupBy('setor')->get();

        return view('operacional.processos.auditoria', compact('processos', 'os', 'total', 'inventariados', 'auditados', 'progresso', 'pecas'));
    }
}
