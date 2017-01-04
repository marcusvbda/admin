dataTable('#por_produto');
dataTable('#por_grupo');
dataTable('#tb_cupons');
dataTable('#tb_cancelamentos');
dataTable('#tb_manutencao');
dataTable('#tb_abastecidas');


@foreach($porcentagem_grupo as $grupo_porcentagem)
        $("#circulo_porcentagem_{{$grupo_porcentagem->grupo}}").circliful({
        animationStep: 15,
        foregroundBorderWidth: 5,
        backgroundBorderWidth: 15,
        decimals:2,
        // text: "{{$grupo_porcentagem->grupo}}",
        percent: {{$grupo_porcentagem->porcentagem}},
    });
@endforeach

@if($tem_combustiveis)
	@foreach($ag_combustiveis as $ag)
	        $("#circulo_porcentagem_comb_{{$ag->NUMERO_PRODUTO}}").circliful({
	        animationStep: 15,
	        foregroundBorderWidth: 5,
	        backgroundBorderWidth: 15,
	        decimals:2,
	        // text: "{{$ag->DESCRICAO_PRODUTO}}",
	        percent: {{$ag->porcentagem}},
	    });
	@endforeach
@endif


function verDocumento(documento)
{
	$.post("{{asset('caixas/Documento')}}", {documento:documento}, function(resposta) 
	{				
	    $('#documento_titulo').html('Lançamentos de Venda');
	    
	    $('#itens_table_itens_cupom').html(null);
	    $.each(resposta.cupom, function(resp,r)
	      {      
	      	if(r.numero_cliente=='999999')
	    		$('#Nome_Cliente').val('999999 - Consumidor');	     
	    	else    	
	    		$('#Nome_Cliente').val(r.numero_cliente+" - "+r.nome_cliente);	     

	    	$('#Cond_pagto').val(r.numero_condpgto+" - "+r.nome_condpgto);   	
	    	$('#Data_Negociacao').val(r.datanegociacao_formatada);   	
	    	$('#Emissao').val(r.dataemissao_formatada);   	
	    	$('#Data_Vencimento').val(r.datavencimento_formatada);   	
	    	$('#Hora').val(r.hora);   	
	    	$('#ECF').val(r.ecf);   	
	    	$('#cnpj').val(r.cnpjcpfcliente);   	
	    	$('#Cupom').val(r.numeronota);   	
	    	$('#Funcionario').val(r.numero_funcionario+" - "+r.funcionario);   	
	    	$('#Motorista').val(r.motorista);   	
	    	$('#Placa').val(r.placa);   	
	    	$('#km').val(r.km);   	
	    	if(r.situacao=="I")
	    		$('#Tipo').val('Inserida');
	    	else   	
	    		$('#Tipo').val('Normal');

	    	$('#itens_table_itens_cupom').append("<tr>"+
									    			"<td>"+r.numero_produto+" - "+r.nome_produto+"</td>"+
									    			"<td>"+r.id_bomba+"</td>"+
									    			"<td>R$ "+r.precounitario+"</td>"+
									    			"<td>"+r.totallitros+"</td>"+
									    			"<td>R$ "+r.totaldinheiro.toFixed(2)+"</td>"+
									    		"</tr>");

	      });

	}, 'json')
	.done(function() {
	    $('#Modal_Documento').modal('show');
	});
}
