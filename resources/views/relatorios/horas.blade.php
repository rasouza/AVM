@extends('layouts.master')

@section('title') Funcionario: {{ $funcionario->nome }} @endsection
@section('sidebar') @endsection
@section('content')
    @foreach($grupos as $grupo)
        <h2>{{ ucfirst((new Date($grupo->created_at))->format('F')) }}/{{ $grupo->ano }}</h2>
        <table width="100%" class="short-table">
            <tbody>
                @foreach($horas as $hora)
                    @if($hora->created_at->month == $grupo->mes && $hora->created_at->year == $grupo->ano)
                        <tr>
                            <th class="features">{{ $hora->os->agenda->cliente->nome }} (dia {{ $hora->created_at->format('j') }})</th>
                            <td>{{ $hora->horas }}</td>
                        </tr>
                    @endif
                @endforeach

                <tr>
                    <th class="features">Total</th>
                    <td><b>{{ $grupo->horas }}</b></td>
                </tr>
            </tbody>
        </table>
    @endforeach
@endsection