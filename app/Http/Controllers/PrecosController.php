<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Preco;
use Illuminate\Support\Facades\Auth;

class PrecosController extends Controller
{
    function __construct()
    {
        $this->authorize('administrador', Auth::user());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $preco = Preco::orderBy('nome', 'asc')->get();
        return view('administracao.precos.index', [ 'precos' => $preco ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $action = 'PrecosController@store';
        $preco = new Preco();

        return view('administracao.precos.form', compact('preco', 'action'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Preco::create([
            'nome' => $request->nome,
            'esporadico_qtd' => $request->esporadico_qtd,
            'esporadico_preco' => $request->esporadico_preco,
            'semestral_qtd' => $request->semestral_qtd,
            'semestral_preco' => $request->semestral_preco,
            'quadrimestral_qtd' => $request->quadrimestral_qtd,
            'quadrimestral_preco' => $request->quadrimestral_preco,
            'trimestral_qtd' => $request->trimestral_qtd,
            'trimestral_preco' => $request->trimestral_preco,
            'bimestral_qtd' => $request->bimestral_qtd,
            'bimestral_preco' => $request->bimestral_preco,
            'mensal_qtd' => $request->mensal_qtd,
            'mensal_preco' => $request->mensal_preco
        ]);

        echo 'Tabela de preço cadastrada';
    }

    /**
     * Display the specified resource.
     *
     * @param  Preco  $preco
     * @return \Illuminate\Http\Response
     */
    public function show(Preco $preco)
    {
        return view('administracao.precos.show', compact('preco'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Preco  $preco
     * @return \Illuminate\Http\Response
     */
    public function edit(Preco $preco)
    {
        $action = 'PrecosController@update';

        return view('administracao.precos.form', compact('preco', 'action'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Preco  $preco
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Preco $preco)
    {
        $preco->nome = $request->nome;
        $preco->esporadico_qtd = $request->esporadico_qtd;
        $preco->esporadico_preco = $request->esporadico_preco;
        $preco->semestral_qtd = $request->semestral_qtd;
        $preco->semestral_preco = $request->semestral_preco;
        $preco->quadrimestral_qtd = $request->quadrimestral_qtd;
        $preco->quadrimestral_preco = $request->quadrimestral_preco;
        $preco->trimestral_qtd = $request->trimestral_qtd;
        $preco->trimestral_preco = $request->trimestral_preco;
        $preco->bimestral_qtd = $request->bimestral_qtd;
        $preco->bimestral_preco = $request->bimestral_preco;
        $preco->mensal_qtd = $request->mensal_qtd;
        $preco->mensal_preco = $request->mensal_preco;

        $preco->save();

        echo 'Tabela de preço editada';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Preco  $preco
     * @return \Illuminate\Http\Response
     */
    public function destroy(Preco $preco)
    {
        $preco->delete();
        return redirect()->action('PrecosController@index');
    }
}
