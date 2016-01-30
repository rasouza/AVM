@extends('layouts.master')

@section('title') Clientes @endsection
@section('content')
    <table width="100%" class="short-table">
        @if($clientes->count() == 0)
            <tr>
                <th class="features" colspan="4">Nenhum cliente foi cadastrado.</th>
            </tr>
        @else
            <thead>
                <tr>
                    <th></th>
                    <th style="width: 100px;">Visualizar</th>
                    <th style="width: 100px;">Editar</th>
                    <th style="width: 100px;"></th>
                </tr>
            </thead>

            <tbody>
            @foreach($clientes as $cliente)
                <tr>
                    <th class="features">{{ $cliente->nome }}</th>
                    <td><a href="{{ action('ClientesController@show', ['clientes' => $cliente]) }}"><img src="{{ asset('images/icons/search.png') }}" alt="Visualizar"/></a></td>
                    <td><a href="{{ action('ClientesController@edit', ['clientes' => $cliente]) }}"><img src="{{ asset('images/icons/pencil32.png') }}" alt="Editar"/></a></td>
                    <td>
                        {!! Form::open(['action' => ['ClientesController@destroy', $cliente], 'method' => 'delete']) !!}
                        <button class="small button red" style="border: none">Excluir</button>
                        {!! Form::close() !!}
                    </td>
                </tr>
            </tbody>
            @endforeach
        @endif
    </table>
@endsection