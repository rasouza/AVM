<?php

namespace App\Http\Controllers;

use App\Filial;
use App\Uf;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class FiliaisController extends Controller
{
    function __construct() { $this->authorize('administrador'); }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $filial = Filial::with('uf')->orderBy('nome', 'asc')->get();
        return view('administracao.filiais.index', [ 'filiais' => $filial ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $action = 'FiliaisController@store';
        $filial = new Filial();
        $ufs = Uf::dropdown();
        return view('administracao.filiais.form', compact('filial', 'ufs', 'action'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $filial = Filial::create([
           'nome' => $request->nome
        ]);

        $filial->uf()->associate(Uf::find($request->uf))->save();

        echo 'Filial cadastrada';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Filial  $filial
     * @return \Illuminate\Http\Response
     */
    public function edit(Filial $filial)
    {
        $action = 'FiliaisController@update';

        $ufs = Uf::dropdown();
        return view('administracao.filiais.form', compact('filial', 'ufs', 'action'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Filial  $filial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Filial $filial)
    {
        $filial->nome = $request->nome;
        $filial->uf()->associate(Uf::find($request->uf))->save();

        echo 'Filial editada';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Filial  $filial
     * @return \Illuminate\Http\Response
     */
    public function destroy(Filial $filial)
    {
        $filial->funcionarios()->update(['filial_id' => 0]);
        $filial->delete();
        return redirect()->action('FiliaisController@index');
    }
}
