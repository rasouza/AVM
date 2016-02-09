<?php

namespace App\Http\Controllers;

use App\Ficha;
use App\Cliente;
use App\Uf;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FichasController extends Controller
{
    function __construct()
    {
        $this->authorize('gerente', Auth::user());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = Cliente::orderBy('nome', 'asc')->get();
        return view('comercial.fichas.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $action = 'FichasController@store';
        $ficha = new Ficha();

        if ($request->has('cliente'))
            $ficha->cliente()->associate(Cliente::find($request->cliente));

        $ufs = Uf::orderBy('sigla', 'asc')->lists('sigla', 'id');
        $clientes = Cliente::orderBy('nome', 'asc')->lists('nome', 'id');

        return view('comercial.fichas.form', compact('ficha', 'action', 'ufs', 'clientes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ficha = Ficha::create($request->except('uf', 'cliente', 'action', 'sendbutton'));

        $ficha->cliente()->associate(Cliente::find($request->cliente));
        $ficha->uf()->associate(Uf::find($request->uf));

        $ficha->save();
        echo "Ficha cadastrada";
    }

    /**
     * Display the specified resource.
     *
     * @param  Ficha $ficha
     * @return \Illuminate\Http\Response
     */
    public function show(Ficha $ficha)
    {
        return view('comercial.fichas.show', compact('ficha'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Ficha $ficha
     * @return \Illuminate\Http\Response
     */
    public function edit(Ficha $ficha)
    {
        $action = 'FichasController@update';

        $ufs = Uf::orderBy('sigla', 'asc')->lists('sigla', 'id');
        $clientes = Cliente::orderBy('nome', 'asc')->lists('nome', 'id');

        return view('comercial.fichas.form', compact('ficha', 'action', 'ufs', 'clientes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Ficha $ficha
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ficha $ficha)
    {
        $ficha->update($request->except('uf', 'cliente', 'action', 'sendbutton'));

        $ficha->cliente()->associate(Cliente::find($request->cliente));
        $ficha->uf()->associate(Uf::find($request->uf));

        $ficha->save();
        echo "Ficha editada";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Ficha $ficha
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ficha $ficha)
    {
        $ficha->delete();
        return redirect()->action('FichaController@index');
    }
}
