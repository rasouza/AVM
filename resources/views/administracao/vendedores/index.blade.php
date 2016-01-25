@extends('layouts.master')

@section('title') Vendedores @endsection
@section('content')
    <table width="100%" class="short-table">
        @if($funcionarios->count() == 0)
            <tr>
                <th class="features" colspan="4">
                    Nenhum funcionário foi cadastrado ainda.
                    {!! link_to_action('FuncionariosController@create', 'Clique aqui') !!} para cadastrar</th>
            </tr>
        @else
            <thead>
                <tr>
                    <th></th>
                    <th style="width: 100px;">Cargo</th>
                    <th style="width: 100px;">Filial</th>
                    <th style="width: 100px;">Visualizar</th>
                    <th style="width: 100px;">Editar</th>
                    <th style="width: 100px;"></th>
                </tr>
            </thead>

            <tbody>
            @foreach($funcionarios as $funcionario)
                <tr>
                    <th class="features">{{ $funcionario->nome }}</th>
                    @if(isset($funcionario->vendedor))
                        <td>{{ ($funcionario->vendedor->cargo)?$funcionario->vendedor->cargo->nome:'-' }}</td>
                        <td>{{ ($funcionario->vendedor->filial)?$funcionario->vendedor->filial->nome:'-' }}</td>
                        <td><a href="{{ action('VendedoresController@show', ['vendedores' => $funcionario->vendedor]) }}"><img src="{{ asset('images/icons/search.png') }}" alt="Visualizar"/></a></td>
                        <td><a href="{{ action('VendedoresController@edit', ['vendedores' => $funcionario->vendedor]) }}"><img src="{{ asset('images/icons/pencil32.png') }}" alt="Editar"/></a></td>
                        <td>
                            {!! Form::open(['action' => ['VendedoresController@destroy', $funcionario->vendedor], 'method' => 'delete']) !!}
                            <button class="small button red" style="border: none">Excluir</button>
                            {!! Form::close() !!}
                        </td>
                    @else
                        <td>{!! link_to_action('VendedoresController@create', 'Atribuir', ['funcionario' => $funcionario], ['class' => 'small green button']) !!}</td>
                        <td colspan="4"></td>

                    @endif

                </tr>
            </tbody>
            @endforeach
        @endif
    </table>
@endsection