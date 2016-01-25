@extends('layouts.master')

@section('title') Tabela de preços @endsection
@section('content')
    <table width="100%" class="short-table">
        @if($precos->count() == 0)
            <tr>
                <th class="features" colspan="4">Nenhuma tabela de preços foi cadastrada.</th>
            </tr>
        @else
            <thead>
                <tr>
                    <th></th>
                    {{--<th style="width: 100px;">Visualizar</th>--}}
                    <th style="width: 100px;">Editar</th>
                    <th style="width: 100px;"></th>
                </tr>
            </thead>

            <tbody>
            @foreach($precos as $preco)
                <tr>
                    <th class="features">{{ $preco->nome }}</th>
                    {{--<td><a href="{{ action('PrecosController@show', ['precos' => $preco]) }}"><img src="{{ asset('images/icons/search.png') }}" alt="Visualizar"/></a></td>--}}
                    <td><a href="{{ action('PrecosController@edit', ['precos' => $preco]) }}"><img src="{{ asset('images/icons/pencil32.png') }}" alt="Editar"/></a></td>
                    <td>
                        {!! Form::open(['action' => ['PrecosController@destroy', $preco], 'method' => 'delete']) !!}
                        <button class="small button red" style="border: none">Excluir</button>
                        {!! Form::close() !!}
                    </td>
                </tr>
            </tbody>
            @endforeach
        @endif
    </table>
@endsection