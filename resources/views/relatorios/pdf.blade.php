<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

        <style>
            .page-break {
                page-break-after: always;
            }
        </style>
    </head>

    <body>
        <img src="{{ asset('images/logo-pb.png') }}" />

        <h2>Dados do Cliente</h2>

        <p><b>Cliente:</b> {{ $os->agenda->cliente->nome }} <b>Data:</b> {{ \Carbon\Carbon::now()->format('d/m/Y') }}</p>
        <p><b>Hora da Liberação:</b> {{ $data['liberacao'] }} <b>Hora do Início do Inventário: </b> {{ $data['inicio'] }} </p>
        <p> <b>Hora do Termino do Inventário: </b> {{ $data['termino'] }} <b>Hora Final:</b> {{ $data['final'] }} </p>
        <p><b>Período:</b> {{ $data['periodo'] }} <b>Tempo de Duração do Inventário:</b> {{ $data['duracao'] }}</p>
        <p><b>Responsável da AVM:</b> {{ $os->coordenador->nome }} <b>Responsável do Cliente:</b> {{ ucfirst($os->agenda->cliente->ficha->gerente) }} </p>

        <h2>Estatísticas do Inventário</h2>

        <p><b>Qtde de Peças Inventariadas:</b> {{ $os->pecas() }}</p>
        <p><b>Qtde de Peças Auditadas:</b> {{ $data['auditadas'] }} ({{ ceil(100*$data['auditadas']/$os->pecas()) }}%).</p>
        <p><b>Qtde de Peças s/ Etiquetas (Manuais):</b> {{ $data['etiqueta'] }} ({{ ceil(100*$data['etiqueta']/$os->pecas()) }}%).</p>
        <p><b>Qtde de Peças de Fora do Inventario:</b> {{ $data['fora'] }} <b>Entregue para:</b> {{$data['entregue']}}</p>

        <p><b>Número de Inventariantes:</b> {{ count($os->inventariantes) }} <b>Tempo Ocioso:</b> {{ $data['ocioso'] }}</p>

        <ul>
            @foreach($inventariantes as $inventariante)
                <li>{{ $inventariante->nome }}</li>
            @endforeach
        </ul>

        <h2>Setorização</h2>

        @foreach($os->ambientes as $ambiente)
            <p>{{$ambiente->nome}} <b>Início:</b> {{ $ambiente->inicio }} <b>Fim:</b> {{ $ambiente->fim }}</p>
        @endforeach

        <p><b>{{ $data['cbLugares'] }}</b></p>

        <h2>De acordo</h2>
        <p><b>A Criação dos setores foi acompanhada:</b> {{ $data['criacao'] }}</p>
        <p><b>O cliente está ciente que todos os setores criados foram processados no sistema:</b> {{ $data['ciente'] }}</p>
        <p><b>O cliente tem alguma dúvida sobre algum procedimento do Inventário:</b> {{ $data['duvida'] }}</p>
        <p><b>Revista Pessoal:</b> {{ $data['revista'] }}</p>


        <h2>Observações</h2>

        {{ nl2br($data['observacoes']) }}


        <br/>
        <br/>

        <p>________________________________________________________</p>

        <p>Assinatura do Responsável</p>

    </body>
</html>

