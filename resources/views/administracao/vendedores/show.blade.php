@extends('layouts.master')

@section('title') Vendedor: {{ $vendedor->funcionario->nome }} @endsection
@section('sidebar-items')
    <li>{!! link_to_action('VendedoresController@index', 'Consultar') !!}</li>
    <li>{!! link_to_action('VendedoresController@edit', 'Editar', ['vendedores' => $vendedor]) !!}</li>
@endsection
@section('content')
    <table width="100%" class="short-table">
            <tbody>
                <tr>
                    <th class="features">Cargo</th>
                    <td>{{ $vendedor->cargo->nome or '-' }}</td>

                </tr>

                <tr>
                    <th class="features">Filial</th>
                    <td>{{ $vendedor->filial->nome or '-' }}</td>
                </tr>

                <tr>
                    <th class="features">Funcionário</th>
                    <td>{!! link_to_action('FuncionariosController@show', 'Ver', ['funcionarios' => $vendedor->funcionario], ['class' => 'small green button']) !!}</td>
                </tr>

                <tr>
                    <th class="features">Criado em</th>
                    <td>{{ $vendedor->created_at->format('d/m/Y') }}</td>
                </tr>

                <tr>
                    <th class="features">Modificado em</th>
                    <td>{{ $vendedor->updated_at->format('d/m/Y') }}</td>
                </tr>

            </tbody>
    </table>
@endsection