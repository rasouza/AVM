@extends('layouts.master')

@section('title') Vendedores @endsection

@section('content')
    <table width="100%" class="short-table">
        @if($vendedores->count() == 0)
            <tr>
                <th class="features" colspan="4">
                    Nenhum funcionário foi cadastrado ainda.
                    {!! link_to_action('FuncionariosController@create', 'Clique aqui') !!} para cadastrar</th>
            </tr>
        @else
            <thead>
                <tr>
                    <th></th>
                    <th style="width: 100px;">Cargo</th>
                    <th style="width: 100px;">Filial</th>
                    <th style="width: 100px;">Visualizar</th>
                    <th style="width: 100px;">Editar</th>
                    <th style="width: 100px;"></th>
                </tr>
            </thead>

            <tbody>
            @foreach($vendedores as $vendedor)
                <tr>
                    <th class="features">{{ $vendedor->funcionario->nome }}</th>
                    <td>{{ $vendedor->cargo->nome or '-' }}</td>
                    <td>{{ $vendedor->filial->nome or '-' }}</td>
                    <td><a href="{{ action('VendedoresController@show', ['vendedores' => $vendedor]) }}"><img src="{{ asset('images/icons/search.png') }}" alt="Visualizar"/></a></td>
                    <td><a href="{{ action('VendedoresController@edit', ['vendedores' => $vendedor]) }}"><img src="{{ asset('images/icons/pencil32.png') }}" alt="Editar"/></a></td>
                    <td>
                        {!! Form::open(['action' => ['VendedoresController@destroy', $vendedor->vendedor], 'method' => 'delete']) !!}
                            <button class="small button red" style="border: none">Excluir</button>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach

            </tbody>
        @endif
    </table>
@endsection