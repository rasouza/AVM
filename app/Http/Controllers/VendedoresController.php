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
        $vendedores = Vendedor::with(['cargo', 'funcionario'])
            ->join('funcionarios', 'funcionarios.id', '=', 'vendedores.funcionario_id')
            ->whereHas('funcionario', function($q) {
                $q->active();
            })
            ->orderBy('funcionarios.filial_id')
            ->orderBy('funcionarios.nome')
            ->get(['vendedores.*']);

        return view('administracao.vendedores.index', compact('vendedores', 'funcionarios'));
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

        $cargos = Cargo::dropdown();
        $funcionarios = Funcionario::dropdown();

        return view('administracao.vendedores.form', compact('vendedor', 'action', 'cargos', 'funcionarios'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'funcionario' => 'unique:vendedores,funcionario_id',
            'password' => 'required'
        ]);

        $vendedor = Vendedor::create([
            'password' => md5($request->password)
        ]);

        $vendedor->funcionario()->associate(Funcionario::find($request->funcionario));
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

        $cargos = Cargo::dropdown();
        $funcionarios = Funcionario::dropdown();

        return view('administracao.vendedores.form', compact('vendedor', 'action', 'cargos', 'funcionarios'));
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
