@extends('layouts.master')

@section('title') Cargos @endsection
@section('content')
    <div id="usermessagea"></div>

    {!! Form::model($cargo, ['action' => [$action, $cargo], 'method' => ($cargo->exists)?'put':'post', 'class' => 'form-contact', 'id' => 'form-contact']) !!}
        <ol class="cf-ol">
            <li>
                <label for="nome"><span>Nome</span></label>
                {!! Form::text('nome', null, ['class' => 'required']  ) !!}
                <span class="reqtxt">(obrigat&oacute;rio)</span>
            </li>
        </ol>

        <input type="hidden" name="action" value="send">

        <p class="cf-sb">
            <input type="submit" name="sendbutton" id="sendbutton" class="sendbutton" value="{{ ($cargo->exists)?'Editar' : 'Cadastrar' }}" />
        </p>
    {!! Form::close() !!}
@endsection