@extends('layouts.processos')
@section('content')

    @include('operacional.processo.cabecalho', ['link' => 'Divergencia'])
    <div class="form-actions">
        {!! Form::open(['action' => ['ProcessoController@divergencia', $os], 'method' => 'post', 'files' => true]) !!}
            {!! Form::file('file') !!}
            {!! Form::submit('Abrir') !!}
        {!! Form::close() !!}
    </div>
    <div id="divDT">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Ambiente</th>
                    <th>Setor</th>
                    <th>Código</th>
                    <th>Quantidade</th>
                    <th>Operador</th>
                    <th style="width: 10px;"></th>
                </tr>
            </thead>

            <tbody>
            @foreach($divergencias as $processo)
                <tr>
                    <td>{{ $processo->ambiente }}</td>
                    <td>{{ number_format($processo->setor,0,'.','') }}</td>
                    <td>{{ $processo->codigo }}</td>
                    <td>{{ $processo->quantidade }}</td>
                    <td>{{ $processo->funcionario or 'Divergente' }}</td>
                    <td>
                        @if($processo->divergencia)
                            <a href="{{ action("ProcessoController@divergencia", [$os, 'processo' => $processo->id]) }}">
                                <img src="{{ asset('images/icons/tick16.png') }}" />
                            </a>
                        @endif
                    </td>
                </tr>
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