@extends('layouts.master')

@section('title') O.S. @endsection
@section('sidebar') @endsection
@section('content')
    <table width="100%" class="short-table">
        @if($agendas->count() == 0)
            <tr>
                <th class="features" colspan="4">Nenhuma O.S. foi cadastrada.</th>
            </tr>
        @else
            <thead>
                <tr>
                    <th style="width: auto"></th>
                    <th>Ambientes</th>
                    @can('gerente')
                        <th>Agenda</th>
                        <th>Visualizar</th>
                        <th>Editar</th>
                        <th></th>
                    @endcan
                </tr>
            </thead>

            <tbody>
            @foreach($agendas as $agenda)
                <tr>

                    <th class="features">{{ $agenda->cliente->nome }} {{ $agenda->data }}</th>
                    <td><a href="{{ action('AmbientesController@edit', ['os' => $agenda->os]) }}"><img src="{{ asset('images/icons/testimonial32.png') }}" alt="O.S."/></a></td>
                    @can('gerente')
                        <td><a href="{{ action('AgendaController@edit', [$agenda]) }}"><img src="{{ asset('images/icons/moleskine32.png') }}" alt="Agenda"/></a></td>
                        <td><a href="{{ action('OsController@show', $agenda->os) }}"><img src="{{ asset('images/icons/search.png') }}" alt="Visualizar"/></a></td>
                        <td><a href="{{ action('OsController@edit', $agenda->os) }}"><img src="{{ asset('images/icons/pencil32.png') }}" alt="Editar"/></a></td>
                        <td>
                            {!! Form::open(['action' => ['OsController@destroy', $agenda->os], 'method' => 'delete']) !!}
                            <button class="small button red delete" style="border: none">Excluir</button>
                            {!! Form::close() !!}
                        </td>
                    @endcan
                </tr>
            </tbody>
            @endforeach
        @endif
    </table>
    <div id="dialog-confirm" title="Deletar O.S.?" class="hide">
        <p>
            <span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px;"></span>
            Ao deletar esta O.S., a agenda associada a ela também será excluída
        </p>
        <p>Tem certeza que deseja exluir esta O.S.?</p>
    </div>
@endsection