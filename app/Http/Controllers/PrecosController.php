<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Preco;
use Illuminate\Support\Facades\Auth;

class PrecosController extends Controller
{
    function __construct() { $this->authorize('franqueado'); }

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

        Preco::create($request->except('action', 'sendbutton'));

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
        $preco->update($request->except('action', 'sendbutton'));
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
