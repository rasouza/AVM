<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Cargo;
use Illuminate\Support\Facades\Auth;

class CargosController extends Controller
{
    function __construct() { $this->authorize('administrador'); }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cargo = Cargo::orderBy('nome', 'asc')->get();
        return view('administracao.cargos.index', [ 'cargos' => $cargo ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $action = 'CargosController@store';
        $cargo = new Cargo();

        return view('administracao.cargos.form', compact('cargo', 'action'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Cargo::create([
            'nome' => $request->nome
        ]);

        echo 'Cargo cadastrado';
    }

    /**
     * Display the specified resource.
     *
     * @param  Cargo  $cargo
     * @return \Illuminate\Http\Response
     */
    public function show(Cargo $cargo)
    {
        return view('administracao.cargos.show', compact('cargo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Cargo  $cargo
     * @return \Illuminate\Http\Response
     */
    public function edit(Cargo $cargo)
    {
        $action = 'CargosController@update';

        return view('administracao.cargos.form', compact('cargo', 'action'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Cargo  $cargo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cargo $cargo)
    {
        $cargo->nome = $request->nome;
        $cargo->save();

        echo 'Cargo editado';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Cargo  $cargo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cargo $cargo)
    {
        $cargo->vendedores()->update(['cargo_id' => 0]);
        $cargo->delete();
        return redirect()->action('CargosController@index');
    }
}
