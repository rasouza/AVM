// -- Author: Rodrigo Alves --

jQuery(document).ready(function($){ 
    
    $('.datepicker').datepicker({ 
        dateFormat: 'dd/mm/yy',
        dayNamesMin: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
        monthNames: ['Janeiro', 'Fevereiro', 'Mar&ccedil;o', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
        onSelect: function() { $(this).focus(); }
    });

    // DELETE Dialog
    $('button.delete').click(function(event) {
        var form = $(this).parent('form');
        event.preventDefault();
        $( "#dialog-confirm" ).dialog({
            resizable: false,
            height:200,
            modal: true,
            buttons: {
                "Deletar": function() {
                    form.submit();
                },
                "Cancelar": function() {
                    $( this ).dialog( "close" );
                }
            }
        });
    });
    
    // ------- operacional-os-novo.php
    
    $('.adicionar').click(function() {
    	var container = $('ul.inventariantes').find('li').first().clone();
    	$('ul.inventariantes').append(container);
    });
    $('.remover').live('click', function() {
    	$(this).parent('li').remove();
    });
    
    $('#status').change(function() {
    	$('#li-coordenador, #li-inventariantes').hide();
    	
    	if ($(this).val() == '1') {
    	    $('#li-coordenador, #li-inventariantes').show();
    	}
    }).change();
    
    // ------- END operacional-os-novo.php
    
    // Mask Input
    $('[name=telefone]').mask('(99) 9999-9999?9');
    $('#numero').mask('999',{placeholder:' '});
    $('[name=percentual]').mask('99,99');
    $('.money').maskMoney();
    $('[name=horario]').mask('99:99');
    $('[name=cnpj]').mask('99.999.999/9999-99');
    $('[name=cep]').mask('99999-999');
    $('[name=cpf]').mask('999.999.999-99');
    $('[name=rg]').mask('99.999.999-*');
    
});