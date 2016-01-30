@extends('layouts.master')

@section('title') Cliente: {{ $cliente->nome }} @endsection
@section('sidebar-items')
    <li>{!! link_to_action('ClientesController@edit', 'Editar', ['clientes' => $cliente]) !!}</li>
@endsection
@section('content')
    <table width="100%" class="short-table">


            <tbody>
                <tr>
                    <th class="features">Estado</th>
                    <td>{{ $cliente->uf->sigla }}</td>
                </tr>

                <tr>
                    <th class="features">Endereço</th>
                    <td>{{ $cliente->endereco }}</td>
                </tr>

                <tr>
                    <th class="features">Bairro</th>
                    <td>{{ $cliente->bairro }}</td>
                </tr>

                <tr>
                    <th class="features">CEP</th>
                    <td>{{ $cliente->cep }}</td>
                </tr>

                <tr>
                    <th class="features">Cidade</th>
                    <td>{{ $cliente->cidade }}</td>
                </tr>

                <tr>
                    <th class="features">Telefone</th>
                    <td>{{ $cliente->telefone }}</td>
                </tr>

                <tr>
                    <th class="features">E-mail</th>
                    <td>{{ $cliente->email }}</td>
                </tr>

                <tr>
                    <th class="features">CPF</th>
                    <td>{{ $cliente->cpf }}</td>
                </tr>

                <tr>
                    <th class="features">RG</th>
                    <td>{{ $cliente->rg }}</td>
                </tr>

                <tr>
                    <th class="features">PIS</th>
                    <td>{{ $cliente->pis }}</td>
                </tr>

                <tr>
                    <th class="features">Criado em</th>
                    <td>{{ $cliente->created_at->format('d/m/Y') }}</td>
                </tr>

                <tr>
                    <th class="features">Modificado em</th>
                    <td>{{ $cliente->updated_at->format('d/m/Y') }}</td>
                </tr>

            </tbody>
    </table>
@endsection