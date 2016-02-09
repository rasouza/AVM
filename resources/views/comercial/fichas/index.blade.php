@extends('layouts.master')

@section('title') Fichas cadastrais @endsection
@section('sidebar') @endsection
@section('content')
    <table width="100%" class="short-table">
        @if($clientes->count() == 0)
            <tr>
                <th class="features" colspan="4">Nenhum cliente foi cadastrado.
                    {!! link_to_action('ClientesController@create', 'Clique aqui') !!} para cadastrar
                </th>
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
            @foreach($clientes as $cliente)
                <tr>
                    <th class="features">{{ $cliente->nome }}</th>
                    @if($cliente->ficha()->count())
                        <th class="features">{{ $cliente->ficha->uf->sigla }}</th>
                        <td><a href="{{ action('FichasController@show', ['fichas' => $cliente->ficha]) }}"><img src="{{ asset('images/icons/search.png') }}" alt="Visualizar"/></a></td>
                        <td><a href="{{ action('FichasController@edit', ['fichas' => $cliente->ficha]) }}"><img src="{{ asset('images/icons/pencil32.png') }}" alt="Editar"/></a></td>
                        <td>
                            {!! Form::open(['action' => ['FichasController@destroy', $cliente->ficha], 'method' => 'delete']) !!}
                            <button class="small button red" style="border: none">Excluir</button>
                            {!! Form::close() !!}
                        </td>
                    @else
                        <td>{!! link_to_action('FichasController@create', 'Atribuir', ['cliente' => $cliente], ['class' => 'small green button']) !!}</td>
                        <td colspan="3"></td>
                    @endif
                </tr>
            </tbody>
            @endforeach
        @endif
    </table>
@endsection