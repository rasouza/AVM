@extends('layouts.master')

@section('title') Tabela de preço: {{ $preco->nome }} @endsection
@section('sidebar-items')
    @parent
    <li>{!! link_to_action('PrecosController@edit', 'Editar', ['precos' => $preco]) !!}</li>
@endsection
@section('content')
    <table width="100%" class="short-table">
            <thead>
                <tr>
                    <th></th>
                    <th style="width: 100px;">Quantidade</th>
                    <th style="width: 100px;">Preço</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <th class="features">Esporadico</th>
                    <td>{{ $preco->esporadico_qtd }}</td>
                    <td>{{ $preco->esporadico_preco }}</td>
                </tr>

                <tr>
                    <th class="features">Semestral</th>
                    <td>{{ $preco->semestral_qtd }}</td>
                    <td>{{ $preco->semestral_preco }}</td>
                </tr>

                <tr>
                    <th class="features">Quadrimestral</th>
                    <td>{{ $preco->quadrimestral_qtd }}</td>
                    <td>{{ $preco->quadrimestral_preco }}</td>
                </tr>

                <tr>
                    <th class="features">Trimestral</th>
                    <td>{{ $preco->trimestral_qtd }}</td>
                    <td>{{ $preco->trimestral_preco }}</td>
                </tr>

                <tr>
                    <th class="features">Bimestral</th>
                    <td>{{ $preco->bimestral_qtd }}</td>
                    <td>{{ $preco->bimestral_preco }}</td>
                </tr>

                <tr>
                    <th class="features">Mensal</th>
                    <td>{{ $preco->mensal_qtd }}</td>
                    <td>{{ $preco->mensal_preco }}</td>
                </tr>

            </tbody>
    </table>
@endsection