@extends('layouts.processos')

@section('title') @endsection
@section('sidebar-items')
    Nenhuma
@endsection
@section('content')

    @include('operacional.processo.cabecalho', ['link' => 'Operadores'])

    <div id="divDT">

        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Operador</th>
                    <th>Quantidade</th>
                    <th width="10">Horas</th>

                </tr>
            </thead>

            <tbody>
                @foreach($processos as $processo)
                    <tr>
                        <td>{{ $processo->funcionario->nome or 'Divergente' }}</td>
                        <td>{{ $processo->quantidade }}</td>
                        <td>
                            @if(is_null($processo->funcionario))
                                -
                            @else
                                {!! Form::text('horas', null, ['style' => 'width: 20px;']) !!}
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