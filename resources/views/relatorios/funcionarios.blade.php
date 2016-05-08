@extends('layouts.master')

@section('title') Funcionários @endsection
@section('sidebar') @endsection
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
                    <th style="width: 100px;">Código</th>
                    <th style="width: 100px;">Estado</th>
                    <th style="width: 100px;">Visualizar</th>

                </tr>
            </thead>

            <tbody>
            @foreach($funcionarios as $funcionario)
                <tr>
                    <th class="features">{{ $funcionario->nome }}</th>
                    <th class="features">{{ $funcionario->id }}</th>
                    <th class="features">{{ $funcionario->uf->sigla or '-' }}</th>
                    <td><a href="{{ action('RelatoriosController@horas', ['funcionarios' => $funcionario]) }}"><img src="{{ asset('images/icons/search.png') }}" alt="Visualizar"/></a></td>
                </tr>
            </tbody>
            @endforeach
        @endif
    </table>
@endsection