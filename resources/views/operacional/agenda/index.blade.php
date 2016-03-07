@extends('layouts.master')

@section('title') Agendas @endsection
@section('content')
    <table width="100%" class="short-table">
        @if($agendas->count() == 0)
            <tr>
                <th class="features" colspan="4">Nenhuma agenda foi cadastrada.</th>
            </tr>
        @else
            <thead>
                <tr>
                    <th></th>
                    <th style="width: 100px;">O.S.</th>
                    <th style="width: 100px;">Visualizar</th>
                    <th style="width: 100px;">Editar</th>
                    <th style="width: 100px;"></th>
                </tr>
            </thead>

            <tbody>
            @foreach($agendas as $agenda)
                <tr>

                    <th class="features">{{ $agenda->cliente->nome }} {{ $agenda->data }}</th>
                    <td><a href="{{ action('OsController@edit', ['agenda' => $agenda]) }}"><img src="{{ asset('images/icons/testimonial32.png') }}" alt="O.S."/></a></td>
                    <td><a href="{{ action('AgendaController@show', $agenda) }}"><img src="{{ asset('images/icons/search.png') }}" alt="Visualizar"/></a></td>
                    <td><a href="{{ action('AgendaController@edit', $agenda) }}"><img src="{{ asset('images/icons/pencil32.png') }}" alt="Editar"/></a></td>
                    <td>
                        {!! Form::open(['action' => ['AgendaController@destroy', $agenda], 'method' => 'delete']) !!}
                        <button class="small button red delete" style="border: none">Excluir</button>
                        {!! Form::close() !!}
                    </td>
                </tr>
            </tbody>
            @endforeach
        @endif
    </table>

    <div id="dialog-confirm" title="Deletar agenda?" class="hide">
        <p>
            <span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px;"></span>
            A O.S. associada a esta agenda também será deletada.
        </p>
        <p>Tem certeza que deseja exluir esta agenda?</p>
    </div>
@endsection