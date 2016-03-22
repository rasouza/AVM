{{-- Duplicados --}}
<div class="alert alert-error"><b>Cuidado!</b> Existem duplicidades no processo atual</div>

{{-- Arquivos de mesmo nome --}}
<div class="alert alert-error"><b>Erro!</b> Esse arquivo já foi baixado</div>

<div class="container">
    <div class="row">
        <div class="span6">
            <dl class="dl-horizontal">
                <dt>Cliente</dt>
                <dd>{{ $os->agenda->cliente->nome }}</dd>

                <dt>Gerente responsável</dt>
                <dd>{{ $os->agenda->cliente->ficha->gerente }}</dd>

                <dt>Qtde de Coletores</dt>
                <dd>{{  count($os->inventariantes) }}</dd>

                <dt>Setores restantes</dt>
                <dd>Inventariar: {{ $total - $inventariados }} ({{ (1-$inventariados/$total)*100 }}%)</dd>

                <dd>Auditar: {{ $total - $auditados }} ({{ (1-$auditados/$total)*100 }}%)</dd>
                <dt>Total inventariado</dt>
                <dd>{{ $os->pecas() }} pe&ccedil;as</dd>
            </dl>
        </div>
        <div class="span5 offset1">
            {!! Form::open(['action' => 'ProcessosController@parse', 'method' => 'post', 'files' => true]) !!}
            <div class="form-actions">
                <label>Enviar carga do coletor</label>
                {!! Form::hidden('os_id', $os->id) !!}
                {!! Form::file('file') !!}
                <button type="submit" class="btn">Abrir</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
    <div class="progress progress-info">
        <div class="bar" style="width: {{ $progresso * 9.40 }}px;"></div>
    </div>

    <ul class="nav nav-pills">

        <li @if($link == 'Principal') class="active" @endif>
            {!! link_to_action('ProcessosController@principal', 'Principal', ['os' => $os]) !!}
        </li>
        <li @if($link == 'Detalhe') class="active" @endif>
            {!! link_to_action('ProcessosController@detalhe', 'Detalhe', ['os' => $os]) !!}
        </li>
        <li @if($link == 'Duplicidades') class="active" @endif>
            {!! link_to_action('ProcessosController@duplicidades', 'Duplicidades', ['os' => $os]) !!}
        </li>
        <li @if($link == 'Setores') class="active" @endif>
            {!! link_to_action('ProcessosController@restantes', 'Setores Restantes', ['os' => $os]) !!}
        </li>
        <li @if($link == 'Auditoria') class="active" @endif>
            {!! link_to_action('ProcessosController@auditoria', 'Auditoria', ['os' => $os]) !!}
        </li>
        <li @if($link == 'Operadores') class="active" @endif>
            {!! link_to_action('ProcessosController@operadores', 'Operadores', ['os' => $os]) !!}
        </li>
        <li @if($link == 'Divergência') class="active" @endif>
            {!! link_to_action('ProcessosController@divergencia', 'Divergência', ['os' => $os]) !!}
        </li>
        <li @if ($auditados < $total) class="disabled" @endif>
            {!! link_to_action('ProcessosController@finalizar', 'Finalizar', ['os' => $os]) !!}
        </li>
    </ul>
</div>