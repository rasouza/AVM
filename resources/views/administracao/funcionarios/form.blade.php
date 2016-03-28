@extends('layouts.master')

@section('title') Funcionários @endsection
@section('content')
    <div id="usermessagea"></div>

    {!! Form::model($funcionario, [
        'action' => [$action, $funcionario],
        'method' => ($funcionario->exists)?'put':'post',
        'class' => 'form-contact',
        'id' => 'form-contact'
    ]) !!}

        <ol class="cf-ol">

            @can('administrador', Auth::user())
            <li>
                <label for="filial_id"><span>Filial</span></label>
                {!! Form::select('filial_id', $filiais, $funcionario->filial_id) !!}
            </li>
            @else
                {!! Form::hidden('filial_id', Auth::user()->funcionario->filial->id) !!}
            @endcan

            <li>
                <label for="nome"><span>Nome</span></label>
                {!! Form::text('nome', null, ['class' => 'required']  ) !!}
                <span class="reqtxt">(obrigat&oacute;rio)</span>
            </li>

            <li>
                <label for="endereco"><span>Endere&ccedil;o</span></label>
                {!! Form::text('endereco') !!}
            </li>

            <li>
                <label for="bairro"><span>Bairro</span></label>
                {!! Form::text('bairro') !!}
            </li>

            <li>
                <label for="cep"><span>CEP</span></label>
                {!! Form::text('cep', null, ['style' => 'width: 100px']) !!}
            </li>

            <li>
                <label for="cidade"><span>Cidade</span></label>
                {!! Form::text('cidade') !!}
            </li>

            <li>
                <label for="uf"><span>UF</span></label>
                {!! Form::select('uf_id', $ufs, $funcionario->uf_id, ['style' => 'width: 50px']) !!}
            </li>

            <li>
                <label for="telefone"><span>Telefone</span></label>
                {!! Form::text('telefone', null, ['style' => 'width: 110px']) !!}
            </li>

            <li>
                <label for="email"><span>Email</span></label>
                {!! Form::text('email') !!}
            </li>

            <li>
                <label for="cpf"><span>CPF</span></label>
                {!! Form::text('cpf', null, ['style' => 'width: 100px']) !!}
            </li>

            <li>
                <label for="rg"><span>RG</span></label>
                {!! Form::text('rg', null, ['style' => 'width: 100px']) !!}
            </li>

            <li>
                <label for="pis"><span>PIS</span></label>
                {!! Form::text('pis', null, ['style' => 'width: 100px']) !!}
            </li>

        </ol>

        <input type="hidden" name="action" value="send">

        <p class="cf-sb">
            <input type="submit" name="sendbutton" id="sendbutton" class="sendbutton" value="{{ ($funcionario->exists)?'Editar' : 'Cadastrar' }}" />
        </p>
    {!! Form::close() !!}
@endsection