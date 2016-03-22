@extends('layouts.master')

@section('title') Cliente: {{ $cliente->nome }} @endsection
@section('sidebar-items')
    @parent
    <li>{!! link_to_action('ClientesController@edit', 'Editar', ['clientes' => $cliente]) !!}</li>
@endsection
@section('content')
    <table width="100%" class="short-table">
        <tbody>
            <tr>
                <th class="features">Ficha Cadastral</th>
                <td>{!! link_to_action('FichasController@show', 'Ver', [$cliente->ficha], ['class' => 'small green button']) !!}</td>
            </tr>
            <tr>
                <th class="features">Nome</th>
                <td>{{ $cliente->nome }}</td>
            </tr>

            <tr>
                <th class="features">email</th>
                <td>{{ $cliente->email }}</td>
            </tr>

            <tr>
                <th class="features">Vendedor</th>
                <td>{{ $cliente->vendedor->nome or 'Nenhum' }}</td>
            </tr>

            <tr>
                <th class="features">Gerente</th>
                <td>{{ $cliente->gerente->nome or 'Nenhum' }}</td>
            </tr>

            <tr>
                <th class="features">Contato</th>
                <td>{{ $cliente->contato }}</td>
            </tr>

            <tr>
                <th class="features">Telefone</th>
                <td>{{ $cliente->telefone }}</td>
            </tr>

            <tr>
                <th class="features">Lojas</th>
                <td>{{ $cliente->lojas }}</td>
            </tr>

            <tr>
                <th class="features">Proposta</th>
                <td>
                    <strong>{{ $cliente->propostaBegin }}</strong> até
                    <strong>{{ $cliente->propostaEnd }}</strong>
                </td>
            </tr>

            <tr>
                <th class="features">Obs</th>
                <td>{{ $cliente->obs }}</td>
            </tr>

            <tr>
                <th class="features">Faturamento</th>
                <td>
                    @if($cliente->faturamento)
                        Tipo 1 - Nota Fiscal
                    @else
                        Tipo 2 - Sem Nota Fiscal
                    @endif
                </td>
            </tr>

            <tr>
                <th class="features">Percentual</th>
                <td>{{ $cliente->percentual }}</td>
            </tr>

            <tr>
                <th class="features">Periodicidade</th>
                <td>{{ $cliente->periodicidade }}</td>
            </tr>

            <tr>
                <th class="features">Vencimento</th>
                <td>{{ $cliente->vencimento }} dias</td>
            </tr>

            <tr>
                <th class="features">Cobrança</th>
                <td>{{ $cliente->cobranca }}</td>
            </tr>

            @if($cliente->cobranca == 'peca')
                <tr>
                    <th class="features">Peça</th>
                    <td>{{ $cliente->peca }}</td>
                </tr>
            @elseif($cliente->cobranca == 'pessoa')
                <tr>
                    <th class="features">Pessoa</th>
                    <td>{{ $cliente->pessoa }}</td>
                </tr>
            @elseif($cliente->cobranca == 'tabela')
                <tr>
                    <th class="features">Tabela</th>
                    <td>{{ $cliente->tabela }}</td>
                </tr>
            @elseif($cliente->cobranca == 'especial')
                <tr>
                    <th class="features">Peça</th>
                    <td>
                        {{ $cliente->especial['pecaEsp'] }}
                    </td>
                </tr>
                <tr>
                    <th class="features">Valor</th>
                    <td>
                        {{ $cliente->especial['valorEsp'] }}
                    </td>
                </tr>
                <tr>
                    <th class="features">Excedente</th>
                    <td>
                        {{ $cliente->especial['excedente'] }}
                    </td>
                </tr>
            @endif
        </tbody>
    </table>
@endsection