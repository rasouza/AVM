@extends('layouts.processos')

@section('title') @endsection
@section('sidebar-items')
    Nenhuma
@endsection
@section('content')

    @include('operacional.processo.cabecalho', ['link' => 'Auditoria'])

    <div id="divDT">
        {!! Form::open(['action' => ['ProcessoController@auditoria', 'os' => $os], 'method' => 'post']) !!}

        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Ambiente</th>
                    <th></th>
                    <th>Setor</th>
                    <th>Quantidade</th>
                    <th>Operador</th>
                </tr>
            </thead>

            <tbody>
                @foreach($processos as $processo)
                    <tr>
                        <td>{{ $processo->ambiente->nome }}</td>
                        <td>
                            {!! Form::checkbox('processos[]', $processo->setor) !!}
                        </td>
                        <td>{{ $processo->setor }}</td>
                        <td>{{ $processo->ambiente->soma($processo->setor) }}</td>
                        <td>{{ $processo->ambiente->operador($processo->setor) }}</td>

                    </tr>
                @endforeach
            </tbody>
        </table>
        {!! Form::submit('Auditar', ['name' => 'auditar', 'class' => 'button btn']) !!} ou
        {!! Form::submit('Excluir', ['name' => 'excluir', 'class' => 'button btn red']) !!}
        {!! Form::close() !!}
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
            "aaSorting": [[ 2, "asc" ]],
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