@extends('layouts.master')

@section('title') Finzaliar O.S.: {{ $os->agenda->cliente->nome }} ({{ $os->agenda->data }})@endsection
@section('sidebar') @endsection

@section('content')

    <div id="usermessagea"></div>

    {!! Form::open([
        'action' => ['ProcessoController@finalizar', $os],
        'method' => 'post',
        'class' => 'form-contact',
        'id' => 'form-contact'
    ]) !!}

    {!! Form::hidden('id', $os->id ) !!}
    {!! Form::hidden('rbCodigo', null) !!}
    {!! Form::hidden('rbQuantidade', null) !!}

    <ol class="cf-ol">
        <li>
            <label for="codigo"><span>Código</span></label>
            {!! Form::text('codigo', null,[
                'class' => 'single required',
                'disabled' => 'disabled',
                'id' => 'codigo',
                'style' => 'width: 20px; text-align: center'
            ]) !!}
            <em>digitos</em>
        </li>

        <li>
            <label for="rbFakeCodigo"><span>Completar com</span></label>
            {!! Form::radio('rbFakeCodigo', 'nada', true,  ['style' => 'width: 13px; height: 13px']) !!} Nada
            {!! Form::radio('rbFakeCodigo', 'espaco', null,  ['style' => 'width: 13px; height: 13px']) !!} Espaços
            {!! Form::radio('rbFakeCodigo', 'zero', null,  ['style' => 'width: 13px; height: 13px']) !!} Zeros
        </li>

        <li>
            <label for="quantidade"><span>Quantidade</span></label>
            {!! Form::text('quantidade', null, [
                'class' => 'single required',
                'disabled' => 'disabled',
                'id' => 'quantidade',
                'style' => 'width:20px; text-align: center'
            ]) !!}
            <em>digitos</em>
        </li>

        <li>
            <label for="rbFakeQtde"><span>Completar com</span></label>
            {!! Form::radio('rbFakeQtde', 'nada', true,  ['style' => 'width: 13px; height: 13px']) !!} Nada
            {!! Form::radio('rbFakeQtde', 'espaco', null,  ['style' => 'width: 13px; height: 13px']) !!} Espaços
            {!! Form::radio('rbFakeQtde', 'zero', null,  ['style' => 'width: 13px; height: 13px']) !!} Zeros
        </li>

        <li>
            <label for="separador"><span>Separador</span></label>
            {!! Form::text('separador', ',', [
                'class' => 'form-control',
                'id' => 'separador',
                'style' => 'width:20px; text-align: center'
            ]) !!}
        </li>

        <p class="cf-sb">
            <input type="submit" name="sendbutton" id="sendbutton" class="sendbutton" value="Finalizar" />
        </p>
    </ol>

    {!! Form::close() !!}

@endsection

@section('js')
    <script type="text/javascript">
        jQuery('input#sendbutton').click(function() {
            var rbCodigo = jQuery('input:radio[name="rbFakeCodigo"]:checked').val();
            jQuery('input[type="hidden"][name="rbCodigo"]').attr('value', rbCodigo);

            var rbQuantidade = jQuery('input:radio[name="rbFakeQtde"]:checked').val();
            jQuery('input[type="hidden"][name="rbQuantidade"]').attr('value', rbQuantidade);
        });

        jQuery('input:radio[name="rbFakeCodigo"]').change(function() {
            if (jQuery(this).val() == 'nada') {
                jQuery('input#codigo').attr('disabled','disabled');
            } else {
                jQuery('input#codigo').removeAttr('disabled');
            }
        });

        jQuery('input:radio[name="rbFakeQtde"]').change(function() {
            if (jQuery(this).val() == 'nada') {
                jQuery('input#quantidade').attr('disabled','disabled');
            } else {
                jQuery('input#quantidade').removeAttr('disabled');
            }
        });
    </script>
@endsection