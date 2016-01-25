@extends('layouts.master')

@section('title') Funcionários @endsection
@section('content')
    <table width="100%" class="short-table">
        @if($funcionarios->count() == 0)
            <tr>
                <th class="features" colspan="4">Nenhum funcionário foi cadastrado.</th>
            </tr>
        @else
            <thead>
                <tr>
                    <th></th>
                    <th style="width: 100px;">Estado</th>
                    <th style="width: 100px;">Visualizar</th>
                    <th style="width: 100px;">Editar</th>
                    <th style="width: 100px;"></th>
                </tr>
            </thead>

            <tbody>
            @foreach($funcionarios as $funcionario)
                <tr>
                    <th class="features">{{ $funcionario->nome }}</th>
                    <th class="features">{{ $funcionario->uf->sigla }}</th>
                    <td><a href="{{ action('FuncionariosController@show', ['funcionarios' => $funcionario]) }}"><img src="{{ asset('images/icons/search.png') }}" alt="Visualizar"/></a></td>
                    <td><a href="{{ action('FuncionariosController@edit', ['funcionarios' => $funcionario]) }}"><img src="{{ asset('images/icons/pencil32.png') }}" alt="Editar"/></a></td>
                    <td>
                        {!! Form::open(['action' => ['FuncionariosController@destroy', $funcionario], 'method' => 'delete']) !!}
                        <button class="small button red" style="border: none">Excluir</button>
                        {!! Form::close() !!}
                    </td>
                </tr>
            </tbody>
            @endforeach
        @endif
    </table>
@endsection