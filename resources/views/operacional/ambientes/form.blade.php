@extends('layouts.master')

@section('title') Ambientes de {{ $os->agenda->cliente->nome }} ({{ $os->agenda->data }}) @endsection
@section('sidebar-items')
    <li><a href="{{ action('OsController@edit', ['os' => $os]) }}">O.S.</a></li>
    <li><a href="{{ action('AgendaController@edit', [$os->agenda]) }}">Agenda</a></li>
    <li><a href="{{ action('ProcessoController@principal', [$os]) }}">Processo</a></li>

@endsection
@section('content')
    <div id="usermessagea">
        @if (session('error') == 'sem ambiente')
            <p class="error">Crie um ou mais ambientes antes de começar o processo</p>
        @endif
    </div>

    {!! Form::open(['action' => 'AmbientesController@update', 'method' => 'put', 'class' => 'form-contact', 'id' => 'form-contact']) !!}
        {!! Form::hidden('os_id', $os->id) !!}
        <ol class="cf-ol">
            <li><span>Setores</span>
                <a class="small button adicionar" style="float: right;">Adicionar</a>
                <div class="clear"></div>
                <ul class="inventariantes">
                    @forelse($ambientes as $ambiente)
                        <li>
                            Nome {!! Form::text('nome[]', $ambiente->nome, ['style' => 'width: 100px']) !!}
                            In&iacute;cio {!! Form::text('inicio[]', $ambiente->inicio, ['style' => 'width: 30px']) !!}
                            Fim {!! Form::text('fim[]', $ambiente->fim, ['style' => 'width: 30px']) !!}
                            <a class="remover">
                                <img src="{{ asset('images/icons/remove16.png') }}" style="border: none;" />
                            </a>
                        </li>
                        @empty
                            <li>
                                Nome {!! Form::text('nome[]', null, ['style' => 'width: 100px']) !!}
                                In&iacute;cio {!! Form::text('inicio[]', null, ['style' => 'width: 30px']) !!}
                                Fim {!! Form::text('fim[]', null, ['style' => 'width: 30px']) !!}
                                <a class="remover">
                                    <img src="{{ asset('images/icons/remove16.png') }}" style="border: none;" />
                                </a>
                            </li>
                    @endforelse
                </ul>
            </li>
        </ol>

        <input type="hidden" name="action" value="send">

        <p class="cf-sb">
            <input type="submit" name="sendbutton" id="sendbutton" class="sendbutton" value="Editar" />
        </p>
    {!! Form::close() !!}
@endsection