{{-- Duplicados --}}
@if (!empty($duplicidades))
    <div class="alert alert-error"><b>Cuidado!</b> Existem duplicidades no processo atual</div>
@endif

{{-- Erro no validador --}}
@foreach($errors->all() as $error)
    <div class="alert alert-error"><b>Erro!</b> {{ $error }}</div>
@endforeach

<div class="container">
    <div class="row">
        <div class="span6">
            <dl class="dl-horizontal">
                <dt>Cliente</dt>
                <dd>{{ $os->agenda->cliente->nome or '-' }}</dd>

                <dt>Gerente responsável</dt>
                <dd>{{ $os->agenda->cliente->ficha->gerente or '-' }}</dd>

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
            {!! Form::open(['action' => ['ProcessoController@parse', $os], 'method' => 'post', 'files' => true]) !!}
            <div class="form-actions">
                <label>Enviar carga do coletor</label>
                {!! Form::hidden('os_id', $os->id) !!}
                {!! Form::file('file') !!}
                {!! Form::submit('Abrir') !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
    <div class="progress progress-info">
        <div class="bar" style="width: {{ $progresso * 9.40 }}px;"></div>
    </div>

    <ul class="nav nav-pills">

        <li @if($link == 'Principal') class="active" @endif>
            {!! link_to_action('ProcessoController@principal', 'Principal', ['os' => $os]) !!}
        </li>
        <li @if($link == 'Detalhe') class="active" @endif>
            {!! link_to_action('ProcessoController@detalhe', 'Detalhe', ['os' => $os]) !!}
        </li>
        <li @if($link == 'Duplicidades') class="active" @endif>
            {!! link_to_action('ProcessoController@duplicidades', 'Duplicidades', ['os' => $os]) !!}
        </li>
        <li @if($link == 'Restantes') class="active" @endif>
            {!! link_to_action('ProcessoController@restantes', 'Setores Restantes', ['os' => $os]) !!}
        </li>
        <li @if($link == 'Auditoria') class="active" @endif>
            {!! link_to_action('ProcessoController@auditoria', 'Auditoria', ['os' => $os]) !!}
        </li>
        <li @if($link == 'Operadores') class="active" @endif>
            {!! link_to_action('ProcessoController@operadores', 'Operadores', ['os' => $os]) !!}
        </li>
        <li @if($link == 'Divergência') class="active" @endif>
            {!! link_to_action('ProcessoController@divergencia', 'Divergência', ['os' => $os]) !!}
        </li>
        <li @if ($auditados < $total) class="disabled" @endif>
            {!! link_to_action('ProcessoController@finalizar', 'Finalizar', ['os' => $os]) !!}
        </li>
    </ul>
</div>