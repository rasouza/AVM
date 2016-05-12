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
        <p><b>Hora da Liberação:</b> {{ $liberacao }} <b>Hora do Início do Inventário: </b> {{ $inicio }} </p>
        <p> <b>Hora do Termino do Inventário: </b> {{ $termino }} <b>Hora Final:</b> {{ $final }} </p>
        <p><b>Período:</b> {{ $periodo }} <b>Tempo de Duração do Inventário:</b> {{ $duracao }}</p>
        <p><b>Responsável da AVM:</b> {{ $os->coordenador->nome }} <b>Responsável do Cliente:</b> {{ ucfirst($os->agenda->cliente->ficha->gerente) }} </p>

        <h2>Estatísticas do Inventário</h2>

        <p><b>Qtde de Peças Inventariadas:</b> {{ $os->pecas() }}</p>
        <p><b>Qtde de Peças Auditadas:</b> {{ $auditadas }} ({{ round($auditadas/$os->pecas()) }})%.</p>
        <p><b>Qtde de Peças s/ Etiquetas (Manuais):</b> {{ $etiqueta }} ({{ round($etiqueta/$os->pecas()) }})%.</p>
        <p><b>Qtde de Peças de Fora do Inventario:</b> {{ $fora }} <b>Entregue para:</b> {{$entregue}}</p>

        <p><b>Número de Inventariantes:</b> {{ count($os->inventariantes) }} <b>Tempo Ocioso:</b> {{ $ocioso }}</p>

        <ul>
            @foreach($inventariantes as $inventariante)
                <li>{{ $inventariante->nome }}</li>
            @endforeach
        </ul>

        <h2>Setorização</h2>

        @foreach($os->ambientes as $ambiente)
            <p>{{$ambiente->nome}} <b>Início:</b> {{ $ambiente->inicio }} <b>Fim:</b> {{ $ambiente->fim }}</p>
        @endforeach

        <p>{{ $lugares }}</p>

        <h2>De acordo</h2>
        <p><b>A Criação dos setores foi acompanhada:</b> </p>
        <p><b>O cliente está ciente que todos os setores criados foram processados no sistema:</b> ( ) Sim ( ) Não</p>
        <p><b>O cliente tem alguma dúvida sobre algum procedimento do Inventário:</b> ( ) Sim ( ) Não</p>
        <p><b>Revista Pessoal:</b> ( ) Sim ( ) Não ( ) Todos ( ) Sorteio</p>

        <br/>
        <br/>
        <br/>

        <h2>Observações</h2>

        <p>_____________________________________________________________________________________</p>
        <p>_____________________________________________________________________________________</p>
        <p>_____________________________________________________________________________________</p>
        <p>_____________________________________________________________________________________</p>
        <p>_____________________________________________________________________________________</p>

        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>

        <p>________________________________________________________</p>

        <p>Assinatura do Responsável</p>

    </body>
</html>

