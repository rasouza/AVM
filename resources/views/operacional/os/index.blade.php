@extends('layouts.master')

@section('title') O.S. @endsection
@section('sidebar-items')
    Nenhuma
@endsection
@section('content')
    <table width="100%" class="short-table">
        @if($oses->count() == 0)
            <tr>
                <th class="features" colspan="4">Nenhuma os foi cadastrada.</th>
            </tr>
        @else
            <thead>
                <tr>
                    <th></th>
                    <th style="width: 100px;">Ambientes</th>
                    <th style="width: 100px;">Visualizar</th>
                    <th style="width: 100px;">Editar</th>
                    <th style="width: 100px;"></th>
                </tr>
            </thead>

            <tbody>
            @foreach($oses as $os)
                <tr>

                    <th class="features">{{ $os->agenda->cliente->nome }} {{ $os->agenda->data }}</th>
                    <td><a href="{{ action('AmbientesController@edit', ['os' => $os]) }}"><img src="{{ asset('images/icons/testimonial32.png') }}" alt="O.S."/></a></td>
                    <td><a href="{{ action('OsController@show', $os) }}"><img src="{{ asset('images/icons/search.png') }}" alt="Visualizar"/></a></td>
                    <td><a href="{{ action('OsController@edit', $os) }}"><img src="{{ asset('images/icons/pencil32.png') }}" alt="Editar"/></a></td>
                    <td>
                        {!! Form::open(['action' => ['OsController@destroy', $os], 'method' => 'delete']) !!}
                        <button class="small button red delete" style="border: none">Excluir</button>
                        {!! Form::close() !!}
                    </td>
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