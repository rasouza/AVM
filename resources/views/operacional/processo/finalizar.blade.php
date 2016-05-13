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
    {!! Form::hidden('cbLugares', null) !!}

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

        <hr />

        <li>
            <label for="liberacao"><span>Hora da liberação</span></label>
            {!! Form::text('liberacao', null, [
                'class' => 'form-control horario',
                'id' => 'liberacao',
                'style' => 'width:40px; text-align: center'
            ]) !!}
        </li>

        <li>
            <label for="inicio"><span>Hora do início do inventário</span></label>
            {!! Form::text('inicio', null, [
                'class' => 'form-control horario',
                'id' => 'inicio',
                'style' => 'width:40px; text-align: center'
            ]) !!}
        </li>

        <li>
            <label for="termino"><span>Hora do término do inventário</span></label>
            {!! Form::text('termino', null, [
                'class' => 'form-control horario',
                'id' => 'termino',
                'style' => 'width:40px; text-align: center'
            ]) !!}
        </li>

        <li>
            <label for="final"><span>Hora final</span></label>
            {!! Form::text('final', null, [
                'class' => 'form-control horario',
                'id' => 'final',
                'style' => 'width:40px; text-align: center'
            ]) !!}
        </li>

        <li>
            <label for="periodo"><span>Período</span></label>
            {!! Form::select('periodo', ['Manhã' => 'Manhã', 'Tarde' => 'Tarde', 'Noite' => 'Noite'] , null , ['class' => 'form-control']) !!}
        </li>

        <li>
            <label for="duracao"><span>Tempo de duração do inventário</span></label>
            {!! Form::text('duracao', null, [
                'class' => 'form-control horario',
                'id' => 'duracao',
                'style' => 'width:40px; text-align: center'
            ]) !!}
        </li>

        <hr />

        <li>
            <label for="auditadas"><span>Peças auditadas</span></label>
            {!! Form::text('auditadas', null, [
                'class' => 'form-control',
                'id' => 'auditadas',
                'style' => 'width:40px; text-align: center'
            ]) !!}
        </li>

        <li>
            <label for="etiqueta"><span>Peças sem etiqueta</span></label>
            {!! Form::text('etiqueta', null, [
                'class' => 'form-control',
                'id' => 'etiqueta',
                'style' => 'width:40px; text-align: center'
            ]) !!}
        </li>

        <li>
            <label for="fora"><span>Peças fora do inventario</span></label>
            {!! Form::text('fora', null, [
                'class' => 'form-control',
                'id' => 'fora',
                'style' => 'width:40px; text-align: center'
            ]) !!}
        </li>

        <li>
            <label for="entregue"><span>Entregue para</span></label>
            {!! Form::text('entregue', null, [
                'class' => 'form-control',
                'id' => 'entregue',
                'style' => 'text-align: center'
            ]) !!}
        </li>

        <li>
            <label for="ocioso"><span>Tempo ocioso</span></label>
            {!! Form::text('ocioso', null, [
                'class' => 'form-control',
                'id' => 'ocioso',
                'style' => 'width:40px; text-align: center'
            ]) !!}
            <em>horas</em>
        </li>

        <li>
            <label><span>Vitrine</span></label>{!! Form::checkbox('lugares', 'Vitrine' ) !!}
            <label><span>Estoque</span></label>{!! Form::checkbox('lugares', 'Estoque' ) !!}
            <label><span>Reserva</span></label>{!! Form::checkbox('lugares', 'Reserva' ) !!}
            <label><span>Loja</span></label>{!! Form::checkbox('lugares', 'Loja' ) !!}
            <label><span>Transferência</span></label>{!! Form::checkbox('lugares', 'Transferência' ) !!}
            <label><span>Conserto</span></label>{!! Form::checkbox('lugares', 'Conserto' ) !!}
            <label><span>Produção</span></label>{!! Form::checkbox('lugares', 'Produção' ) !!}
            <label><span>Outro</span></label>{!! Form::checkbox('lugares', 'Outro' ) !!}
        </li>

        <hr />

        <li>
            <label for="criacao"><span>A criação dos setores foi acompanhada:</span></label>
            {!! Form::select('criacao', ['Sim' => 'Sim', 'Não' => 'Não', 'Parcial' => 'Parcial'] , null , ['class' => 'form-control']) !!}
        </li>
        <li>
            <label for="ciente"><span>O cliente está ciente que todos os setores criados foram processados no sistema:</span></label>
            {!! Form::select('ciente', ['Sim' => 'Sim', 'Não' => 'Não'] , null , ['class' => 'form-control']) !!}
        </li>
        <li>
            <label for="duvida"><span>O cliente tem alguma dúvida sobre algum procedimento do Inventário:</span></label>
            {!! Form::select('duvida', ['Sim' => 'Sim', 'Não' => 'Não'] , null , ['class' => 'form-control']) !!}
        </li>
        <li>
            <label for="revista"><span>Revista pessoal:</span></label>
            {!! Form::select('revista', ['Sim' => 'Sim', 'Não' => 'Não', 'Todos' => 'Todos', 'Sorteio' => 'Sorteio'] , null , ['class' => 'form-control']) !!}
        </li>

        <li>
            <label for="observacoes"><span>Observações</span></label>
            {!! Form::textarea('observacoes') !!}
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

            var lugares = jQuery('input[name=lugares]:checked').map(function() {return this.value;}).get().join(', ');
            jQuery('input[type="hidden"][name="cbLugares"]').attr('value', lugares);
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