// -- Author: Rodrigo Alves --

jQuery(document).ready(function($){ 
    
    $('.datepicker').datepicker({ 
        dateFormat: 'dd/mm/yy',
        dayNamesMin: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
        monthNames: ['Janeiro', 'Fevereiro', 'Mar&ccedil;o', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
        onSelect: function() { $(this).focus(); }
    });
    
    // ------- comercial-cliente-novo.php
    
    // Hide/Show options based on select box choose
    $('[name=faturamento]').change(function() {
    	if ($(this).val() == '2') {
    		$('#perc').parent('li').hide('fast');
    	} else if ($(this).val() == '1') {
    		$('#perc').parent('li').show('fast');
    	}
    }).change();
    
    // Hide/Show options based on select box choose
    $('[name=cobranca]').change(function() {
    	$('#peca, #pessoa, #tabela, #pecaEsp, #valorEsp, #excedente').parent('li').hide();
    	
    	if ($(this).val() == 'peca') {
    		$('#peca').parent('li').show();
    	} else if ($(this).val() == 'pessoa') {
    		$('#pessoa').parent('li').show();
    	} else if ($(this).val() == 'tabela') {
    		$('#tabela').parent('li').show();
    	} else if ($(this).val() == 'especial') {
    		$('#pecaEsp, #valorEsp, #excedente').parent('li').show();
    	}
    }).change();    
    
    
    
    // ------- END comercial-cliente-novo.php
    
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
    $('[name=perc]').mask('99,99 %');
    $('#numero').mask('999',{placeholder:' '});
    $('#peca, #excedente').mask('99,99');
    $('.money').maskMoney();
    $('[name=horario]').mask('99:99');
    $('[name=cnpj]').mask('99.999.999/9999-99');
    $('[name=cep]').mask('99999-999');
    $('[name=cpf]').mask('999.999.999-99');
    $('[name=rg]').mask('99.999.999-*');
    
});