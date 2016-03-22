@extends('layouts.master')

@section('title') Agenda @endsection
@section('sidebar-items')
    @parent
    <li><a href="{{ action('OsController@edit', ['os'=> $agenda->os]) }}">O.S.</a></li>
@endsection
@section('content')
    <div id="usermessagea"></div>

    {!! Form::model($agenda, ['action' => [$action, $agenda], 'method' => ($agenda->exists)?'put':'post', 'class' => 'form-contact', 'id' => 'form-contact']) !!}
        <ol class="cf-ol">
            <li>
                <label for="cliente"><span>Cliente</span></label>
                {!! Form::select(
                        'cliente_id',
                        $clientes,
                        ($agenda->exists)?$agenda->cliente->id : null,
                        ['placeholder' => 'Selecione um cliente']
                ) !!}
            </li>

            <li>
                <label for="data"><span>Data</span></label>
                {!! Form::text('data', null, ['class' => 'single datepicker']  ) !!}
            </li>

            <li>
                <label for="filial"><span>Filial</span></label>
                {!! Form::select(
                        'filial_id',
                        $filiais,
                        ($agenda->exists)?$agenda->filial->id : null
                ) !!}
            </li>

            <li>
                <label for="periodo"><span>Periodo</span></label>
                {!! Form::select(
                        'periodo',
                        ['manha' => 'Manhã', 'tarde' => 'Tarde', 'noite' => 'Noite'],
                        ($agenda->exists)?$agenda->periodo : null
                ) !!}
            </li>

            <li>
                <label for="inicio"><span>Início do Inventário</span></label>
                {!! Form::text('inicio', null, ['class' => 'single horario']) !!}
            </li>

            <li>
                <label for="pecas"><span>Qtde. Pe&ccedil;as</span></label>
                {!! Form::text('pecas') !!}
            </li>

        </ol>

        <input type="hidden" name="action" value="send">

        <p class="cf-sb">
            <input type="submit" name="sendbutton" id="sendbutton" class="sendbutton" value="{{ ($agenda->exists)?'Editar' : 'Cadastrar' }}" />
        </p>
    {!! Form::close() !!}
@endsection