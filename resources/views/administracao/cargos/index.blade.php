@extends('layouts.master')

@section('title') Cargos @endsection
@section('content')
    <table width="100%" class="short-table">
        @if($cargos->count() == 0)
            <tr>
                <th class="features" colspan="4">Nenhum cargo foi cadastrado.</th>
            </tr>
        @else
            <thead>
                <tr>
                    <th></th>
                    <th style="width: 100px;">Editar</th>
                    <th style="width: 100px;"></th>
                </tr>
            </thead>

            <tbody>
            @foreach($cargos as $cargo)
                <tr>
                    <th class="features">{{ $cargo->nome }}</th>
                    <td><a href="{{ action('CargosController@edit', ['cargos' => $cargo]) }}"><img src="{{ asset('images/icons/pencil32.png') }}" alt="Editar"/></a></td>
                    <td>
                        {!! Form::open(['action' => ['CargosController@destroy', $cargo], 'method' => 'delete']) !!}
                        <button class="small button red delete" style="border: none">Excluir</button>
                        {!! Form::close() !!}
                    </td>
                </tr>
            </tbody>
            @endforeach
        @endif
    </table>

    <div id="dialog-confirm" title="Deletar cargo?" class="hide">
        <p>
            <span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px;"></span>
            Todos os logins atribuidos a este cargo serão invalidados e será preciso atribuir novamente.
        </p>
        <p>Tem certeza que deseja exluir este cargo?</p>
    </div>
@endsection