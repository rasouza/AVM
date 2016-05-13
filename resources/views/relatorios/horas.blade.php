@extends('layouts.master')

@section('title') Funcionario: {{ $funcionario->nome }} @endsection
@section('sidebar') @endsection
@section('content')
    @foreach($grupos as $grupo)
        <h2>{{ ucfirst($grupo['data']->format('F')) }}/{{ $grupo['data']->year }}</h2>
        <table width="100%" class="short-table">
            <thead>
                <tr>
                    <th>O.S.</th>
                    <th>Peças</th>
                    <th>Horas</th>
                    <th>Peça/h</th>
                </tr>
            </thead>
            <tbody>
                @foreach($grupo['horas'] as $hora)

                        <tr>
                            <th class="features">{{ $hora->cliente }} (dia {{ $hora->data->format('j') }})</th>
                            <td>{{ number_format($hora->quantidade, 2, ',', '') }}</td>
                            <td>{{ number_format($hora->horas, 2, ',', '') }}</td>
                            <td>{{ number_format(($hora->quantidade / $hora->horas), 2, ',', '') }}</td>
                        </tr>

                @endforeach

                <tr>
                    <th class="features">Total ({{ count($grupo['horas']) }})</th>
                    <td><b>{{ number_format($grupo['quantidade'], 2, ',', '') }}</b></td>
                    <td><b>{{ number_format($grupo['tempo'], 2, ',', '') }}</b></td>
                    <td><b>{{ number_format($grupo['media'], 2, ',', '') }}</b></td>
                </tr>
            </tbody>
        </table>
    @endforeach
@endsection