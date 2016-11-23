$("#data_inicio").keyup(function(event)
{
  	if(event.keyCode == 13)
	    $('#data_fim').focus();
});
$("#data_fim").keyup(function(event)
{
  	if(event.keyCode == 13)
	    consultar();
});
function click_caixa(sequencia)
{
	$('#div_selec_caixa').removeClass("col-md-12");
	$('#div_selec_caixa').addClass("col-md-8"); 	
	$('#div_visualizacao_caixa').hide();
	visualizar_caixa(sequencia);
}

function voltar_selecao()
{
	$('#div_selec_caixa').removeClass("col-md-8");
	$('#div_selec_caixa').addClass("col-md-12"); 
	$('#div_visualizacao_caixa').hide();	
	div_periodo('AUMENTAR');
}

function visualizar_caixa(sequencia)
{
	$.getJSON("{{asset('caixas/caixa_especifico')}}"+"/"+sequencia, function(caixa)
	{ 
		$('#numero_caixa_titulo').html(caixa.numero);
		$('#id_caixa').html(caixa.numero);
		$('#dt_abertura').html(caixa.dataabertura_formatada+" - "+caixa.horaabertura);
		$('#dt_fechamento').html(caixa.datafechamento_formatada+" - "+caixa.horafechamento);
		$('#ilha').html(caixa.numero_ilha);
		$('#responsavel').html(caixa.numero_funcionario+" - "+caixa.nome_funcionario);
		$('#vlr_inicial').html("R$ "+caixa.valorinicial.toFixed(2));
		$('#situacao').html(caixa.situacao);
		$('#btn_visualizar').attr("href","{{asset('caixas/show/')}}"+caixa.numero);	
	});
	div_periodo('DIMINUIR');
	$('#div_visualizacao_caixa').toggle(150);	
}

function div_periodo(operacao)
{
	if(operacao=="AUMENTAR")
	{
		$('#div_periodo_inicio').removeClass("col-md-5");		
		$('#div_periodo_fim').removeClass("col-md-5");

		$('#div_periodo_inicio').addClass("col-md-2");
		$('#div_periodo_fim').addClass("col-md-2"); 
	}
	else
	{
		$('#div_periodo_inicio').removeClass("col-md-2");		
		$('#div_periodo_fim').removeClass("col-md-2");

		$('#div_periodo_inicio').addClass("col-md-5");
		$('#div_periodo_fim').addClass("col-md-5");
	}
}

function consultar()
{
    SEND("POST","{{asset('caixas/index')}}",{data_inicio:data,data_fim:data_fim},"{{Request::getToken()}}");
}