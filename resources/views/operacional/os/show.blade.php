@extends('layouts.master')

@section('title') Agenda: {{ $agenda->cliente->nome }} {{ $agenda->data }} @endsection
@section('sidebar-items')
    @parent
    <li>{!! link_to_action('AgendaController@edit', 'Editar', ['agenda' => $agenda]) !!}</li>
    <li>{!! link_to_action('OsController@create', 'O.S.', ['agenda' => $agenda]) !!}</li>
@endsection
@section('content')
    <table width="100%" class="short-table">
        <tbody>
            <tr>
                <th class="features">Filial</th>
                <td>{{ $agenda->filial->nome }}</td>
            </tr>

            <tr>
                <th class="features">Período</th>
                <td>{{ ucfirst($agenda->periodo) }}</td>
            </tr>

            <tr>
                <th class="features">Início do inventário</th>
                <td>{{ substr($agenda->inicio,0,5) }}</td>
            </tr>

            <tr>
                <th class="features">Qtde. de peças</th>
                <td>{{ $agenda->pecas }}</td>
            </tr>

            <tr>
                <th class="features">Criado em</th>
                <td>{{ $agenda->created_at->format('d/m/Y') }}</td>
            </tr>

            <tr>
                <th class="features">Modificado em</th>
                <td>{{ $agenda->updated_at->format('d/m/Y') }}</td>
            </tr>
        </tbody>
    </table>
@endsection