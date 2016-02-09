<?php

namespace App\Http\Controllers;

use App\Funcionario;
use App\Uf;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class FuncionariosController extends Controller
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
        $funcionario = Funcionario::with('uf')->orderBy('nome', 'asc')->get();
        return view('administracao.funcionarios.index', [ 'funcionarios' => $funcionario ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $action = 'FuncionariosController@store';
        $funcionario = new Funcionario();
        $ufs = Uf::orderBy('sigla', 'asc')
            ->get()
            ->lists('sigla', 'id');
        return view('administracao.funcionarios.form', compact('funcionario', 'ufs', 'action'));
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
            'nome' => 'required|unique:funcionarios'
        ]);

        $funcionario = Funcionario::create([
            'nome' => $request->nome,
            'endereco' => $request->endereco,
            'bairro' => $request->bairro,
            'cep' => $request->cep,
            'cidade' => $request->cidade,
            'telefone' => $request->telefone,
            'email' => $request->email,
            'cpf' => $request->cpf,
            'rg' => $request->rg,
            'pis' => $request->pis
        ]);

        $funcionario->uf()->associate(Uf::find($request->uf))->save();

        echo 'Funcionário cadastrado';
    }

    /**
     * Display the specified resource.
     *
     * @param  Funcionario  $funcionario
     * @return \Illuminate\Http\Response
     */
    public function show(Funcionario $funcionario)
    {
        return view('administracao.funcionarios.show', compact('funcionario'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Funcionario  $funcionario
     * @return \Illuminate\Http\Response
     */
    public function edit(Funcionario $funcionario)
    {
        $action = 'FuncionariosController@update';

        $ufs = Uf::orderBy('sigla', 'asc')
            ->get()
            ->lists('sigla', 'id');
        return view('administracao.funcionarios.form', compact('funcionario', 'ufs', 'action'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Funcionario  $funcionario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Funcionario $funcionario)
    {
        $funcionario->nome = $request->nome;
        $funcionario->endereco = $request->endereco;
        $funcionario->bairro = $request->bairro;
        $funcionario->cep = $request->cep;
        $funcionario->cidade = $request->cidade;
        $funcionario->telefone = $request->telefone;
        $funcionario->email = $request->email;
        $funcionario->cpf = $request->cpf;
        $funcionario->rg = $request->rg;
        $funcionario->pis = $request->pis;
        $funcionario->uf()->associate(Uf::find($request->uf))->save();

        echo 'Funcionário editado';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Funcionario  $funcionario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Funcionario $funcionario)
    {
        $funcionario->vendedores()->delete();
        $funcionario->delete();
        return redirect()->action('FuncionariosController@index');
    }
}
