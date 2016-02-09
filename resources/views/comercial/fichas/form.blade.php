@extends('layouts.master')

@section('title') Ficha cadastral @endsection
@section('sidebar-items')
    <li><a href="{{ action(preg_replace('/(\w+)@(.+)/', '\\1@index', class_basename(Route::current()->getActionName()))) }}">Consulta</a></li>
@endsection
@section('content')
    <div id="usermessagea"></div>

    {!! Form::model($ficha, ['action' => [$action, $ficha], 'method' => ($ficha->exists)?'put':'post', 'class' => 'form-contact', 'id' => 'form-contact']) !!}
        <ol class="cf-ol">
            <li>
                <label for="cliente"><span>Cliente</span></label>
                {!! Form::select('cliente', $clientes, ($ficha->cliente)?$ficha->cliente->id : null, ['placeholder' => 'Selecione um cliente']) !!}
            </li>

            <li>
                <label for="gerente"><span>Estado</span></label>
                {!! Form::select('uf', $ufs, ($ficha->uf)?$ficha->uf->id : null, ['style' => 'width: 50px']) !!}
            </li>

            <li>
                <label for="contato"><span>Razão Social</span></label>
                {!! Form::text('razao_social') !!}
            </li>

            <li>
                <label for="telefone"><span>Gerente</span></label>
                {!! Form::text('gerente') !!}
            </li>

            <li>
                <label for="telefone"><span>Endereço</span></label>
                {!! Form::text('endereco') !!}
            </li>

            <li>
                <label for="telefone"><span>End. Cobrança</span></label>
                {!! Form::text('end_cobranca') !!}
            </li>

            <li>
                <label for="telefone"><span>CNPJ</span></label>
                {!! Form::text('cnpj') !!}
            </li>

            <li>
                <label for="telefone"><span>Inscrição Estadual</span></label>
                {!! Form::text('inscricao') !!}
            </li>

            <li>
                <label for="telefone"><span>Cidade</span></label>
                {!! Form::text('cidade') !!}
            </li>

            <li>
                <label for="telefone"><span>Telefone</span></label>
                {!! Form::text('telefone') !!}
            </li>

            <li>
                <label for="telefone"><span>CEP</span></label>
                {!! Form::text('cep') !!}
            </li>

            <li>
                <label for="telefone"><span>Obs</span></label>
                {!! Form::textarea('obs') !!}
            </li>
        </ol>

        <input type="hidden" name="action" value="send">

        <p class="cf-sb">
            <input type="submit" name="sendbutton" id="sendbutton" class="sendbutton" value="{{ ($ficha->exists)?'Editar' : 'Cadastrar' }}" />
        </p>
    {!! Form::close() !!}
@endsection