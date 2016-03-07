@extends('layouts.master')

@section('title') Os @endsection
@section('sidebar-items')
    Nenhuma
@endsection
@section('content')
    <div id="usermessagea"></div>

    {!! Form::model($os, ['action' => [$action, $os], 'method' => ($os->exists)?'put':'post', 'class' => 'form-contact', 'id' => 'form-contact']) !!}
        <ol class="cf-ol">
            <li>
                <label for="cliente"><span>Cliente</span></label>
                <strong>{{ $os->agenda->cliente->nome }}</strong>
            </li>

            <li>
                <label for="data"><span>Data</span></label>
                <strong>{{ $os->agenda->data }}</strong>
            </li>

            <li>
                <label for="status"><span>Status do Invent&aacute;rio</span></label>
                {!! Form::select('status',
                    ['confirmado' => 'Confirmado',
                    'reservado' => 'Reservado',
                    'pre-reservado' => "Pré-Reservado",
                    'cancelado' => 'Cancelado'],
                    $os->status) !!}
            </li>

            <li id="li-coordenador">
                <label for="coordenador"><span>Coordenador</span></label>
                {!! Form::select('coordenador_id', $coordenadores, $os->coordenador_id, ['placeholder' => 'Selecione o coordenador']) !!}
            </li>

            <li>
                <label for="saida"><span>Meio de Sa&iacute;da</span></label>
                <strong>Genérico</strong>
            </li>

            <li>
                <label for="email"><span>E-mail</span></label>
                {!! Form::text('email') !!}
            </li>

            <hr />

            <li>
                <span>Inventariantes necess&aacute;rios</span>
                <strong>{{ $necessarios }}</strong>
            </li>

            @if($inventariantes->count() == 0)
                <li><strong>Nenhum inventariante foi cadastrado ainda. {!! link_to_action('VendedoresController@create', 'Clique aqui') !!} para adicionar</strong></li>
            @else
                <li id="li-inventariantes"><span>Inventariantes</span>
                    <a class="small button adicionar" style="float: right;">Adicionar</a>
                    <div class="clear"></div>
                    <ul class="inventariantes">
                        @if(is_null($os->inventariantes))
                            <li>
                                {!! Form::select('inventariantes[]', $inventariantes) !!}
                                <a class="remover"><img src="{{ asset('images/icons/remove16.png') }}" style="border: none;"/></a>
                            </li>
                        @else
                            @foreach($os->inventariantes as $inventariante)
                                <li>
                                    {!! Form::select('inventariantes[]', $inventariantes , $inventariante) !!}
                                    <a class="remover"><img src="{{ asset('images/icons/remove16.png') }}" style="border: none;"/></a>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </li>
            @endif
        </ol>

        <input type="hidden" name="action" value="send">

        <p class="cf-sb">
            <input type="submit" name="sendbutton" id="sendbutton" class="sendbutton" value="{{ ($os->exists)?'Editar' : 'Cadastrar' }}" />
        </p>
    {!! Form::close() !!}
@endsection