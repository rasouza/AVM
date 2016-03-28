@extends('layouts.master')

@section('title') Processos @endsection
@section('sidebar') @endsection
@section('content')
    <table width="100%" class="short-table">
        @if($agendas->count() == 0)
            <tr>
                <th class="features" colspan="4">Nenhum processo ativo.</th>
            </tr>
        @else
            <thead>
                <tr>
                    <th></th>
                    <th>Ação</th>
                </tr>
            </thead>

            <tbody>
            @foreach($agendas as $agenda)
                <tr>
                    <th class="features">{{ $agenda->cliente->nome }} ({{ $agenda->data }})</th>
                    <td><a href="{{ action('ProcessoController@principal', ['os' => $agenda->os]) }}" class="small button green">Iniciar</a></td>
                </tr>
            </tbody>
            @endforeach
        @endif
    </table>
@endsection