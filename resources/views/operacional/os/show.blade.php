@extends('layouts.master')

@section('title') O.S.: {{ $os->agenda->cliente->nome }} {{ $os->agenda->data }} @endsection
@section('sidebar-items')
    <li><a href="{{ action('OsController@index') }}">Consulta</a></li>
    <li>{!! link_to_action('AgendaController@edit', 'Agenda', ['agenda' => $os->agenda]) !!}</li>
@endsection
@section('content')
    <table width="100%" class="short-table">
        <tbody>
            <tr>
                <th class="features">Filial</th>
                <td>{{ $os->agenda->filial->nome }}</td>
            </tr>

            <tr>
                <th class="features">Coordenador</th>
                <td>{{ ucfirst($os->coordenador->nome) }}</td>
            </tr>

            <tr>
                <th class="features">Status</th>
                <td>{{ ucfirst($os->status) }}</td>
            </tr>

            <tr>
                <th class="features">Email</th>
                <td>{{ $os->email }}</td>
            </tr>
            <tr>
                <th class="features">Criado em</th>
                <td>{{ $os->created_at->format('d/m/Y') }}</td>
            </tr>

            <tr>
                <th class="features">Modificado em</th>
                <td>{{ $os->updated_at->format('d/m/Y') }}</td>
            </tr>
        </tbody>
    </table>
@endsection