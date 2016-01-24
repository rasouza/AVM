@extends('layouts.master')

@section('title') Filiais @endsection
@section('content')
    <div id="usermessagea"></div>

    {!! Form::model($filial, ['action' => ['FiliaisController@store', $filial], 'class' => 'form-contact', 'id' => 'form-contact']) !!}
        <ol class="cf-ol">
            <li>
                <label for="nome"><span>Nome</span></label>
                {{--<input type="text" name="nome" id="nome" class="required" />--}}
                {!! Form::text('nome', null, ['class' => 'required']  ) !!}
                <span class="reqtxt">(obrigat&oacute;rio)</span>
            </li>

            <li>
                <label for="uf"><span>UF</span></label>
                {!! Form::select('uf', $ufs, ($filial->uf)?$filial->uf->id : null, ['style' => 'width: 50px']) !!}
            </li>

        </ol>

        <input type="hidden" name="action" value="send">

        <p class="cf-sb">
            <input type="submit" name="sendbutton" id="sendbutton" class="sendbutton" value="Cadastrar" />
        </p>
    {!! Form::close() !!}
@endsection