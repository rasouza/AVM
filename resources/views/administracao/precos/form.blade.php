@extends('layouts.master')

@section('title') Tabela de preços @endsection
@section('content')
    <div id="usermessagea"></div>

    {!! Form::model($preco, ['action' => [$action, $preco], 'method' => ($preco->exists)?'put':'post', 'class' => 'form-contact', 'id' => 'form-contact']) !!}
        <ol class="cf-ol">
            <li>
                <label for="nome"><span>Nome</span></label>
                {!! Form::text('nome', null, ['class' => 'required']  ) !!}
                <span class="reqtxt">(obrigat&oacute;rio)</span>
            </li>

            <li>
                <label for="esporadico"><span>Esporadico</span></label>
                {!! Form::text('esporadico_qtd', null, ['class' => 'required', 'style' => 'width: 50px']) !!}
                {!! Form::text('esporadico_preco', null, ['class' => 'required money', 'style' => 'width: 50px']) !!}
            </li>

            <li>
                <label for="semestral"><span>Semestral</span></label>
                {!! Form::text('semestral_qtd', null, ['class' => 'required', 'style' => 'width: 50px']) !!}
                {!! Form::text('semestral_preco', null, ['class' => 'required money', 'style' => 'width: 50px']) !!}
            </li>

            <li>
                <label for="quadrimestral"><span>Quadrimestral</span></label>
                {!! Form::text('quadrimestral_qtd', null, ['class' => 'required', 'style' => 'width: 50px']) !!}
                {!! Form::text('quadrimestral_preco', null, ['class' => 'required money', 'style' => 'width: 50px']) !!}
            </li>

            <li>
                <label for="trimestral"><span>Trimestral</span></label>
                {!! Form::text('trimestral_qtd', null, ['class' => 'required', 'style' => 'width: 50px']) !!}
                {!! Form::text('trimestral_preco', null, ['class' => 'required money', 'style' => 'width: 50px']) !!}
            </li>

            <li>
                <label for="bimestral"><span>Bimestral</span></label>
                {!! Form::text('bimestral_qtd', null, ['class' => 'required', 'style' => 'width: 50px']) !!}
                {!! Form::text('bimestral_preco', null, ['class' => 'required money', 'style' => 'width: 50px']) !!}
            </li>

            <li>
                <label for="mensal"><span>Mensal</span></label>
                {!! Form::text('mensal_qtd', null, ['class' => 'required', 'style' => 'width: 50px']) !!}
                {!! Form::text('mensal_preco', null, ['class' => 'required money', 'style' => 'width: 50px']) !!}
            </li>

        </ol>

        <input type="hidden" name="action" value="send">

        <p class="cf-sb">
            <input type="submit" name="sendbutton" id="sendbutton" class="sendbutton" value="{{ ($preco->exists)?'Editar' : 'Cadastrar' }}" />
        </p>
    {!! Form::close() !!}
@endsection