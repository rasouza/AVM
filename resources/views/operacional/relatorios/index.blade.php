@extends('layouts.master')

@section('title') Relatórios @endsection
@section('sidebar') @endsection
@section('content')

    <table width="100%" class="short-table">
        <thead>
            <tr>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            @forelse($agendas as $agenda)
                <tr>
                    <th class="features">
                        {{ $agenda->cliente->nome }} ({{$agenda->data}})
                    </th>
                    <td><a href="{{ action('RelatoriosController@word', [$agenda->os]) }}" class="small button blue">Word</a></td>
                    <td><a href="{{ action('RelatoriosController@excel', [$agenda->os]) }}" class="small button green">Excel</a></td>
                </tr>
            @empty
                <tr>
                    <th class="features" colspan="4">Nenhum relat&oacute;rio foi gerado ainda.</th>
                </tr>
            @endforelse
        </tbody>
    </table>

@endsection