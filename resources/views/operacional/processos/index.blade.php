@extends('layouts.master')

@section('title') Processos @endsection
@section('sidebar-items')
    Nenhuma
@endsection
@section('content')
    <table width="100%" class="short-table">
        @if($oses->count() == 0)
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
            @foreach($oses as $os)
                <tr>
                    <th class="features">{{ $os->agenda->cliente->nome }} ({{ $os->agenda->data }})</th>
                    <td><a href="{{ action('ProcessosController@principal', ['os' => $os]) }}" class="small button green">Iniciar</a></td>
                </tr>
            </tbody>
            @endforeach
        @endif
    </table>
@endsection