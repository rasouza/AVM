@extends('layouts.master')

@section('title') Vendedores @endsection
@section('content')
    <div id="usermessagea"></div>

    {!! Form::model($vendedor, ['action' => [$action, $vendedor], 'method' => ($vendedor->exists)?'put':'post', 'class' => 'form-contact', 'id' => 'form-contact']) !!}
        <ol class="cf-ol">
            <li>
                <label for="funcionario"><span>Funcionário</span></label>
                {!! Form::select('funcionario', $funcionarios, ($vendedor->funcionario)?$vendedor->funcionario->id : null) !!}
            </li>

            <li>
                <label for="cargo"><span>Cargo</span></label>
                {!! Form::select('cargo', $cargos, ($vendedor->cargo)?$vendedor->cargo->id : null) !!}
            </li>

            <li>
                <label for="filial"><span>Filial</span></label>
                {!! Form::select('filial', $filiais, ($vendedor->filial)?$vendedor->filial->id : null) !!}
            </li>

            <li>
                <label for="password"><span>Senha</span></label>
                {!! Form::password('password', null, ['class' => 'required']  ) !!}
                <span class="reqtxt">(obrigat&oacute;rio)</span>
            </li>

        </ol>

        <input type="hidden" name="action" value="send">

        <p class="cf-sb">
            <input type="submit" name="sendbutton" id="sendbutton" class="sendbutton" value="{{ ($vendedor->exists)?'Editar' : 'Cadastrar' }}" />
        </p>
    {!! Form::close() !!}
@endsection