@extends('layouts.master')

@section('title') Funcionario: {{ $funcionario->nome }} @endsection
@section('sidebar-items')
    <li>{!! link_to_action('FuncionariosController@edit', 'Editar', ['funcionarios' => $funcionario]) !!}</li>
@endsection
@section('content')
    <table width="100%" class="short-table">


            <tbody>
                <tr>
                    <th class="features">Estado</th>
                    <td>{{ $funcionario->uf->sigla }}</td>
                </tr>

                <tr>
                    <th class="features">Endereço</th>
                    <td>{{ $funcionario->endereco }}</td>
                </tr>

                <tr>
                    <th class="features">Bairro</th>
                    <td>{{ $funcionario->bairro }}</td>
                </tr>

                <tr>
                    <th class="features">CEP</th>
                    <td>{{ $funcionario->cep }}</td>
                </tr>

                <tr>
                    <th class="features">Cidade</th>
                    <td>{{ $funcionario->cidade }}</td>
                </tr>

                <tr>
                    <th class="features">Telefone</th>
                    <td>{{ $funcionario->telefone }}</td>
                </tr>

                <tr>
                    <th class="features">E-mail</th>
                    <td>{{ $funcionario->email }}</td>
                </tr>

                <tr>
                    <th class="features">CPF</th>
                    <td>{{ $funcionario->cpf }}</td>
                </tr>

                <tr>
                    <th class="features">RG</th>
                    <td>{{ $funcionario->rg }}</td>
                </tr>

                <tr>
                    <th class="features">PIS</th>
                    <td>{{ $funcionario->pis }}</td>
                </tr>

                <tr>
                    <th class="features">Criado em</th>
                    <td>{{ $funcionario->created_at->format('d/m/Y') }}</td>
                </tr>

                <tr>
                    <th class="features">Modificado em</th>
                    <td>{{ $funcionario->updated_at->format('d/m/Y') }}</td>
                </tr>

            </tbody>
    </table>
@endsection