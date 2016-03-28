<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Funcionario;
use App\Preco;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClientesController extends Controller
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
        return view('comercial.clientes.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $action = 'ClientesController@store';
        $cliente = new Cliente();

        $gerentes = Funcionario::getAllByCargo('gerente')->lists('nome', 'id');;
        $vendedores = Funcionario::getAllByCargo('vendedor')->lists('nome', 'id');

        $precos = Preco::orderBy('nome', 'asc')->lists('nome', 'id');

        return view('comercial.clientes.form', compact('cliente', 'action', 'gerentes', 'vendedores', 'precos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cliente = Cliente::create($request->except('pecaEsp', 'valorEsp', 'excedente', 'action', 'sendbutton'));
        $cliente->especial = $request->only('pecaEsp', 'valorEsp', 'excedente');

        $cliente->save();
        echo "Cliente cadastrado";
    }

    /**
     * Display the specified resource.
     *
     * @param  Cliente $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        return view('comercial.clientes.show', compact('cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Cliente $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
        $action = 'ClientesController@update';

        $gerentes = Funcionario::getAllByCargo('gerente')->lists('nome', 'id');;
        $vendedores = Funcionario::getAllByCargo('vendedor')->lists('nome', 'id');

        $cliente->pecaEsp = $cliente->especial['pecaEsp'];
        $cliente->valorEsp = $cliente->especial['valorEsp'];
        $cliente->excedente = $cliente->especial['excedente'];

        $precos = Preco::orderBy('nome', 'asc')->lists('nome', 'id');

        return view('comercial.clientes.form', compact('cliente', 'action', 'gerentes', 'vendedores', 'precos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Cliente $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $cliente)
    {

        $cliente->update($request->except('pecaEsp', 'valorEsp', 'excedente', 'action', 'sendbutton'));
        $cliente->especial = $request->only('pecaEsp', 'valorEsp', 'excedente');
        
        $cliente->save();
        echo "Cliente editado";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Cliente $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {
        $cliente->ficha()->delete();
        $cliente->delete();
        return redirect()->action('ClientesController@index');
    }
}
