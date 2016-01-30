<?php

namespace App\Http\Controllers;

use App\Cliente;
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
        $gerentes = DB::table('vendedores')
            ->join('cargos', 'cargos.id', '=', 'vendedores.cargo_id')
            ->join('funcionarios', 'funcionarios.id', '=', 'vendedores.funcionario_id')
            ->where('cargos.nome', 'Gerente')
            ->select('funcionarios.nome', 'funcionarios.id')
            ->lists('funcionarios.nome', 'funcionarios.id');

        $vendedores = DB::table('vendedores')
            ->join('cargos', 'cargos.id', '=', 'vendedores.cargo_id')
            ->join('funcionarios', 'funcionarios.id', '=', 'vendedores.funcionario_id')
            ->where('cargos.nome', 'Vendedor')
            ->select('funcionarios.nome', 'funcionarios.id')
            ->lists('funcionarios.nome', 'funcionarios.id');

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
        Cliente::create($request->except('pecaEsp', 'valorEsp', 'excedente', 'action', 'sendbutton'));
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Cliente $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
        $action = 'ClientesController@store';
        $gerentes = DB::table('vendedores')
            ->join('cargos', 'cargos.id', '=', 'vendedores.cargo_id')
            ->join('funcionarios', 'funcionarios.id', '=', 'vendedores.funcionario_id')
            ->where('cargos.nome', 'Gerente')
            ->select('funcionarios.nome', 'funcionarios.id')
            ->lists('funcionarios.nome', 'funcionarios.id');

        $vendedores = DB::table('vendedores')
            ->join('cargos', 'cargos.id', '=', 'vendedores.cargo_id')
            ->join('funcionarios', 'funcionarios.id', '=', 'vendedores.funcionario_id')
            ->where('cargos.nome', 'Vendedor')
            ->select('funcionarios.nome', 'funcionarios.id')
            ->lists('funcionarios.nome', 'funcionarios.id');

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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Cliente $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {
        //
    }
}
