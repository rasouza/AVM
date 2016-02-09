@extends('layouts.master')

@section('title') Clientes @endsection
@section('content')
    <div id="usermessagea"></div>

    {!! Form::model($cliente, ['action' => [$action, $cliente], 'method' => ($cliente->exists)?'put':'post', 'class' => 'form-contact', 'id' => 'form-contact']) !!}
        <ol class="cf-ol">
            <li>
                <label for="nome"><span>Nome</span></label>
                {!! Form::text('nome', null, ['class' => 'required']  ) !!}
                <span class="reqtxt">(obrigat&oacute;rio)</span>
            </li>

            <li>
                <label for="email"><span>Email</span></label>
                {!! Form::text('email', null, ['class' => 'required']) !!}
                <span class="emailreqtxt">(obrigat&oacute;rio)</span>
            </li>

            <li>
                <label for="vendedor"><span>Vendedor</span></label>
                {!! Form::select('vendedor', $vendedores, $cliente->vendedor, ['placeholder' => 'Selecione um vendedor']) !!}
            </li>

            <li>
                <label for="gerente"><span>Gerente</span></label>
                {!! Form::select('gerente', $gerentes, $cliente->gerente, ['placeholder' => 'Selecione um gerente']) !!}
            </li>

            <li>
                <label for="contato"><span>Contato</span></label>
                {!! Form::text('contato') !!}
            </li>

            <li>
                <label for="telefone"><span>Telefone</span></label>
                {!! Form::text('telefone', null, ['style' => 'width: 100px']) !!}
            </li>

            <li>
                <label for="lojas"><span>Qtde. de lojas</span></label>
                {!! Form::text('lojas', null, ['style' => 'width: 100px']) !!}
            </li>

            <li>
                <label for="propostaBegin"><span>Aceite da proposta</span></label>
                {!! Form::text('propostaBegin', null, ['class' => 'datepicker', 'style' => 'width: 100px']) !!}
            </li>

            <li>
                <label for="propostaEnd"><span>Validade da proposta</span></label>
                {!! Form::text('propostaEnd', null, ['class' => 'datepicker', 'style' => 'width: 100px']) !!}
            </li>

            <li>
                <label for="obs"><span>Observa&ccedil;&otilde;es</span></label>
                {!! Form::textarea('obs', null, ['class' => 'area']) !!}
            </li>

            <li>
                <label for="faturamento"><span>Faturamento</span></label>
                {!! Form::select('faturamento', [1 => 'Tipo 1 - Nota Fiscal', 0 => 'Tipo 2 - Sem Nota Fiscal']) !!}
            </li>

            <li>
                <label for="percentual"><span>PERC.N.F.%</span></label>
                {!! Form::text('percentual', null, ['id' => 'perc', 'style' => 'width: 100px']) !!} %
            </li>

            <li>
                <label for="periodicidade"><span>Periodicidade</span></label>
                {!! Form::select('faturamento', [
                    0 => "Esporadico",
                    6 => "Semestral",
                    4 => "Quadrimestral",
                    3 => "Trimestral",
                    2 => "Bimestral",
                    1 => "Mensal"
                ]) !!}

            </li>

            <li>
                <label for="vencimento"><span>Vencimento</span></label>
                {!! Form::text('vencimento', null, ['style' => 'width: 100px']) !!}
                <span>(dias)</span>
            </li>

            <li>
                <label for="cobranca"><span>Cobrança</span></label>
                {!! Form::select('cobranca', [
                    "peca" => 'Peça',
                    "pessoa" => 'Pessoa',
                    "tabela" => 'Tabela',
                    "especial" => 'Condição Especial'
                ]) !!}
            </li>

            <li>
                <label for="peca"><span>Peça (R$)</span></label>
                {!! Form::text('peca', null, ['style' => 'width: 100px']) !!}
            </li>

            <li>
                <label for="pessoa"><span>Pessoa</span></label>
                {!! Form::text('pessoa', null, ['style' => 'width: 100px']) !!}
            </li>

            <li>
                <label for="tabela"><span>Tabela</span></label>
                {!! Form::select('tabela', $precos, $cliente->tabela, ['placeholder' => 'Selecione uma tabelade preços']) !!}
            </li>

            <li>
                <label for="pecaEsp"><span>Pe&ccedil;as</span></label>
                {!! Form::text('pecaEsp', null, ['style' => 'width: 100px']) !!}
            </li>

            <li>
                <label for="valorEsp"><span>Valor</span></label>
                {!! Form::text('valorEsp', null, ['style' => 'width: 100px']) !!}
            </li>

            <li>
                <label for="excedente"><span>Excedente</span></label>
                {!! Form::text('excedente', null, ['style' => 'width: 100px']) !!}
            </li>
        </ol>

        <input type="hidden" name="action" value="send">

        <p class="cf-sb">
            <input type="submit" name="sendbutton" id="sendbutton" class="sendbutton" value="{{ ($cliente->exists)?'Editar' : 'Cadastrar' }}" />
        </p>
    {!! Form::close() !!}
@endsection

@section('js')
    <script type="text/javascript">
        jQuery(function($) {
            // Hide/Show options based on select box choose
            $('[name=faturamento]').change(function() {
                if ($(this).val() == '1') {
                    $('[name=percentual]').parent('li').show('fast');
                } else {
                    $('[name=percentual]').parent('li').hide('fast');
                }
            });

            // Hide/Show options based on select box choose
            $('[name=cobranca]').change(function() {
                $('[name=peca], [name=pessoa], [name=tabela], [name=pecaEsp], [name=valorEsp], [name=excedente]').parent('li').hide();

                if ($(this).val() == 'peca') {
                    $('[name=peca]').parent('li').show();
                } else if ($(this).val() == 'pessoa') {
                    $('[name=pessoa]').parent('li').show();
                } else if ($(this).val() == 'tabela') {
                    $('[name=tabela]').parent('li').show();
                } else if ($(this).val() == 'especial') {
                    $('[name=pecaEsp], [name=valorEsp], [name=excedente]').parent('li').show();
                }
            }).change();
        });

    </script>
@endsection