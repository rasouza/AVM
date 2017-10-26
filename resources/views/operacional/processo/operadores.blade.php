@extends('layouts.processos')

@section('title') @endsection
@section('sidebar-items')
    Nenhuma
@endsection
@section('content')

    @include('operacional.processo.cabecalho', ['link' => 'Operadores'])

    <div id="divDT">
        {!! Form::open(['action' => ['ProcessoController@operadores', $os], 'method' => 'post']) !!}
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Operador</th>
                        <th>Quantidade</th>
                        <th width="10">Horas</th>
                        <th>Comentários</th>                        

                    </tr>
                </thead>

                <tbody>
                    @foreach($operadores as $operador)
                        <tr>
                            <td>{{ $operador->funcionario->nome or 'Divergente' }}</td>
                            <td>{{ $operador->quantidade }}</td>
                            <td>
                                @if(is_null($operador->funcionario))
                                    -
                                @else
                                    {!! Form::hidden('operadores[]', $operador->funcionario_id, ['id' => 'id']) !!}
                                    {!! Form::text('horas[]', $operador->horas, ['style' => 'width: 35px;']) !!}
                                @endif
                            </td>
                            
                            <td>
                                @if(is_null($operador->funcionario))
                                    -
                                @else
                                    {!! Form::text('comentarios[]', $operador->comentario) !!}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        {!! Form::submit('Enviar', ['class' => 'btn small button']) !!}
    </div>

@endsection

@section('js')
    <script type="text/javascript">
        jQuery('#check-uncheck').click(function() {
            var link = jQuery(this);
            if (link.text() == 'Selecionar tudo') {
                jQuery('input[type=checkbox]').attr('checked', true);
                link.text('Desmarcar tudo');
            }
            else {
                jQuery('input[type=checkbox]').attr('checked', false);
                link.text('Selecionar tudo');
            }
        });


        jQuery.extend( jQuery.fn.dataTableExt.oStdClasses, {
            "sWrapper": "dataTables_wrapper form-inline"
        });
        jQuery('#divDT table').dataTable({
            "sDom": "<'row'<'span6'l><'span6'f>r>t<'row'<'span6'i><'span6'p>>",
            "bPaginate": false,
            "aaSorting": [[ 2, "asc" ]],
            "bFilter": false,
            "bAutoWidth": true
        });

        jQuery('.btn.dialog').click(function() { jQuery('#dialog-form').dialog('open'); });
    </script>
@endsection