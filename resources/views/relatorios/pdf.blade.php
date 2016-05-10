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
        <p><b>Hora da Liberação:</b> ________ <b>Hora do Início do Inventário: </b> ________ </p>
        <p> <b>Hora do Termino do Inventário: </b> ________ <b>Hora Final:</b> ________ </p>
        <p><b>Período:</b> ( ) Manhã ( ) Tarde ( ) Noite <b>Tempo de Duração do Inventário:</b> ________</p>
        <p><b>Responsável da AVM:</b> {{ $os->coordenador->nome }} <b>Responsável do Cliente:</b> {{ ucfirst($os->agenda->cliente->ficha->gerente) }} </p>

        <h2>Estatísticas do Inventário</h2>

        <p><b>Qtde de Peças Inventariadas:</b> {{ $os->inventariados() }}</p>
        <p><b>Qtde de Peças Auditadas:</b> ________ (______)%.</p>
        <p><b>Qtde de Peças s/ Etiquetas (Manuais):</b> ________ (______)%.</p>
        <p><b>Qtde de Peças de Fora do Inventario:</b> ________ <b>Entregue para:</b> ____________________________</p>

        <p><b>Número de Inventariantes:</b> {{ count($os->inventariantes) }} <b>Tempo Ocioso:</b> ________</p>

        <h2>Setorização</h2>

        @foreach($os->ambientes as $ambiente)
            <p>{{$ambiente->nome}} <b>Início:</b> {{ $ambiente->inicio }} <b>Fim:</b> {{ $ambiente->fim }}</p>
        @endforeach

        <p>Vitrine ( ) Estoque ( ) Reserva ( ) Loja ( ) Transferências ( ) Conserto ( ) Produção ( ) Outro</p>

        <h2>De acordo</h2>
        <p><b>A Criação dos setores foi acompanhada:</b> ( ) Sim ( ) Não ( ) Parcial</p>
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

