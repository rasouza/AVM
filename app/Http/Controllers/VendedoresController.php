<?php

namespace App\Http\Controllers;

use App\Vendedor;
use App\Cargo;
use App\Funcionario;
use App\Filial;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class VendedoresController extends Controller
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
        $funcionario = Funcionario::with('vendedor.filial', 'vendedor.cargo')->orderBy('nome', 'asc')->get();



        return view('administracao.vendedores.index', [ 'funcionarios' => $funcionario ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $action = 'VendedoresController@store';
        $vendedor = new Vendedor();

        if ($request->has('funcionario'))
            $vendedor->funcionario()->associate(Funcionario::find($request->funcionario));

        $cargos = Cargo::orderBy('nome', 'asc')->get()->lists('nome', 'id');
        $filiais = Filial::orderBy('nome', 'asc')->get()->lists('nome', 'id');
        $funcionarios = Funcionario::orderBy('nome', 'asc')->get()->lists('nome', 'id');



        return view('administracao.vendedores.form', compact('vendedor', 'action', 'cargos', 'filiais', 'funcionarios'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $vendedor = Vendedor::create([
            'password' => md5($request->password)
        ]);

        $vendedor->funcionario()->associate(Funcionario::find($request->funcionario));
        $vendedor->filial()->associate(Filial::find($request->filial));
        $vendedor->cargo()->associate(Cargo::find($request->cargo));
        $vendedor->save();

        echo 'Vendedor cadastrado';
    }

    /**
     * Display the specified resource.
     *
     * @param  Vendedor  $vendedor
     * @return \Illuminate\Http\Response
     */
    public function show(Vendedor $vendedor)
    {
        return view('administracao.vendedores.show', compact('vendedor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Vendedor  $vendedor
     * @return \Illuminate\Http\Response
     */
    public function edit(Vendedor $vendedor)
    {
        $action = 'VendedoresController@update';

        $cargos = Cargo::orderBy('nome', 'asc')->get()->lists('nome', 'id');
        $filiais = Filial::orderBy('nome', 'asc')->get()->lists('nome', 'id');
        $funcionarios = Funcionario::orderBy('nome', 'asc')->get()->lists('nome', 'id');

        return view('administracao.vendedores.form', compact('vendedor', 'action', 'cargos', 'filiais', 'funcionarios'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Vendedor  $vendedor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vendedor $vendedor)
    {
        if ($request->password != "")
            $vendedor->password = md5($request->password);

        $vendedor->funcionario()->associate(Funcionario::find($request->funcionario));
        $vendedor->filial()->associate(Filial::find($request->filial));
        $vendedor->cargo()->associate(Cargo::find($request->cargo));
        $vendedor->save();

        echo 'Vendedor editado';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Vendedor  $vendedor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vendedor $vendedor)
    {
        $vendedor->delete();
        return redirect()->action('VendedoresController@index');
    }
}
