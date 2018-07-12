@extends('layouts.processos')


@section('content')

    @include('operacional.processo.cabecalho', ['link' => 'Principal'])

    <div id="divDT">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Ambiente</th>
                    <th>Setor</th>
                    <th>Quantidade</th>
                    <th>Inventariado</th>
                    <th>Operador</th>
                </tr>
            </thead>

            <tbody>
                @foreach($os->ambientes as $ambiente)
                    @foreach($ambiente->setores() as $num => $setor)                    
                        <tr>
                            <td>{{ $ambiente->nome }}</td>
                            <td>{{ number_format($num,0,'.','') }}</td>
                            <td>{{ $setor->qtd or '-' }}</td>
                            <td>{{ $setor ? 'Sim' : 'Não' }}</td>
                            <td>{{ $setor->funcionario or '-' }}</td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>

@endsection

@section('js')
    <script type="text/javascript">
        jQuery.extend( jQuery.fn.dataTableExt.oStdClasses, {
            "sWrapper": "dataTables_wrapper form-inline"
        });
        jQuery('#divDT table').dataTable({
            "sDom": "<'row'<'span6'l><'span6'f>r>t<'row'<'span6'i><'span6'p>>",
            "bPaginate": false,
            "aaSorting": [[ 1, "asc" ]],
            "bFilter": false,
            "bAutoWidth": true,
            "fnDrawCallback": function ( oSettings ) {
                if ( oSettings.aiDisplay.length == 0 )
                    return;
                var nTrs = jQuery('#divDT table tbody tr');
                var iColspan = nTrs[0].getElementsByTagName('td').length;
                var sLastGroup = "";
                for ( var i=0 ; i<nTrs.length ; i++ ) {
                    var iDisplayIndex = oSettings._iDisplayStart + i;
                    var sGroup = oSettings.aoData[ oSettings.aiDisplay[iDisplayIndex] ]._aData[0];
                    if ( sGroup != sLastGroup ) {
                        var nGroup = document.createElement( 'tr' );
                        var nCell = document.createElement( 'td' );
                        nCell.colSpan = iColspan;
                        nCell.className = "group";
                        nCell.innerHTML = sGroup;
                        nGroup.appendChild( nCell );
                        nTrs[i].parentNode.insertBefore( nGroup, nTrs[i] );
                        sLastGroup = sGroup;
                    }
                }
            },
            "aoColumnDefs": [
                { "bVisible": false, "aTargets": [ 0 ] }
            ]
        });

        jQuery('.btn.dialog').click(function() { jQuery('#dialog-form').dialog('open'); });
    </script>
@endsection