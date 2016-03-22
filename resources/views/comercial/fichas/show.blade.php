@extends('layouts.master')

@section('title') Ficha: {{ $ficha->cliente->nome }} @endsection
@section('sidebar-items')
    <li><a href="{{ action(preg_replace('/(\w+)@(.+)/', '\\1@index', class_basename(Route::current()->getActionName()))) }}">Consulta</a></li>
    <li>{!! link_to_action('FichasController@edit', 'Editar', ['fichas' => $ficha]) !!}</li>
@endsection
@section('content')
    <table width="100%" class="short-table">
        <tbody>
            <tr>
                <th class="features">Cliente</th>
                <td>{!! link_to_action('ClientesController@show', 'Ver', [$ficha->cliente], ['class' => 'small green button']) !!}</td>
            </tr>
            <tr>
                <th class="features">Estado</th>
                <td>{{ $ficha->uf->sigla or '-' }}</td>
            </tr>

            <tr>
                <th class="features">Razão Social</th>
                <td>{{ $ficha->razao_social }}</td>
            </tr>

            <tr>
                <th class="features">Gerente</th>
                <td>{{ $ficha->gerente }}</td>
            </tr>

            <tr>
                <th class="features">Endereço</th>
                <td>{{ $ficha->endereco }}</td>
            </tr>

            <tr>
                <th class="features">End. Cobrança</th>
                <td>{{ $ficha->end_cobranca }}</td>
            </tr>

            <tr>
                <th class="features">CNPJ</th>
                <td>{{ $ficha->cnpj }}</td>
            </tr>

            <tr>
                <th class="features">Insc. Estadual</th>
                <td>{{ $ficha->inscricao }}</td>
            </tr>

            <tr>
                <th class="features">Cidade</th>
                <td>{{ $ficha->cidade }}</td>
            </tr>

            <tr>
                <th class="features">Telefone</th>
                <td>{{ $ficha->telefone }}</td>
            </tr>

            <tr>
                <th class="features">CEP</th>
                <td>{{ $ficha->cep }}</td>
            </tr>

            <tr>
                <th class="features">Obs</th>
                <td>{{ $ficha->obs }}</td>
            </tr>

        </tbody>
    </table>
@endsection