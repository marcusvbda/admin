@extends('templates.principal.principal')

@section('titulo','frente de caixa')


@section('conteudo')
<div class="col-md-12">
	<div class="box">		
		<div class="box-body" style="padding-top: 0px;">
		  <!-- conteudo -->
				

			<div id="div_cupom_fechado" class="col-md-4" >
		  		<div class="content">
		  			<h1 class="text-center">Caixa N° 0000</h1>
		  			<hr>
		  			<p><strong>Hora de Abertura : </strong>00:00:00</p>
		  			<p><strong>Usuário : </strong>{{Auth('usuario')}}</p>
		  			<p><strong>Email : </strong>{{Auth('email')}}</p>
		  			<hr>
		  			<p class="text-center"><strong>Saldo Inicial : </strong>R$ <span id="saldo_inicial_caixa">0,00</span></p>
		  			<p><strong>Retiradas : </strong>R$<span id="saldo_retiradas">0,00</span> (<span id="qtde_retiradas">0</span>)</p>
		  			<p><strong>Inserções : </strong>R$ <span id="saldo_insercoes">0,00</span> (<span id="qtde_insercoes">0</span>)</p>
		  			<p class="text-center"><strong>Saldo Atual : </strong>R$ <span id="saldo_atual_caixa">0,00</span></p>
					<hr>  
					<button class="btn btn-danger" id="btn_fechar_caixa">Fechar Caixa</button>
		  		</div>
		  	</div>


		  	<div id="div_cupom_aberto" class="col-md-4" style="display: none;">
		  		<div class="content">
		  			<div class="row espacado">
			  			<div class="col-md-2 text-left">
			  				<h3 id="cliente"><a onclick="selecionar_cliente();"><span class="glyphicon glyphicon-user"></span></a></h3>		  				
			  			</div>
			  			<div class="col-md-10 text-right">
			  				<h3 id="nome_cliente"><a onclick="detalhar_cliente(0)">Consumidor</a></h3>
			  			</div>
			  			<hr>
		  			</div>
		  			<div class="row espacado">
		  				<div class="col-md-12">
		  					<div class="input-group input-group-sm" >
			                	<input type="text" style="text-transform:uppercase" class="form-control pull-right" id="txt_busca_produto" placeholder="Produto">
			                	<div class="input-group-btn">
			                  		<button id="btn_busca_produto" onclick="click_buscar_produto();" type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
			                	</div>
			            	</div>
		  				</div>
		  			</div>
		  			<div class="row espacado" style="overflow-y: scroll;max-height: 255px;">
		  				<div class="content">
			  				<div class="table-responsive" >
							  <table class="table table-hover" id="table_cupom" style="font-size: 11.5px;">
							    <thead>
							      <tr style="background-color: #F4F4F4;border-radius: 100px;">
							        <th>#</th>
							        <th>Produto</th>
							        <th>Qtde</th>
							        <th>Preço</th>
							        <th>Sub Total</th>
							      </tr>
							    </thead>
							    <tbody id="itens_cupons">
							    </tbody>
							  </table>
							</div>
			  			</div>
			  		</div>

			  		<div class="row espacado" style="margin-top: 95px;">	
			  			<div class="content">
			  			    <div class="col-md-6 text-left"><h5 class="slim">Descontos</h5></div>
			  				<div class="col-md-6 text-right"><h5 class="slim">R$ <span id="total_descontos">00.00</span></h5></div>

			  				<div class="col-md-6 text-left"><h5 class="slim">Ascréscimos</h5></strong></div>
			  				<div class="col-md-6 text-right"><h5 class="slim">R$ <span id="total_acrescimos">00.00</span></h5></div>

			  				<hr>
			  				<div class="col-md-6 text-left"><h3 class="slim">TOTAL</h3></div>
			  				<div class="col-md-6 text-right"><h3 class="slim">R$ <span id="total_venda">00.00</span></h3></div>
			  				
			  			</div>
			  		</div>





		  		</div>
		  	</div>


		  	<div id="div_botoes" class="col-md-8">
		  		<div class="content">
			  		<div class="row espacado" id="btn_grupos_favoritos_consulta">
				  		<div class="col-md-2 bnt-col">
				  			<button class="btn btn-success btn-quad" id="btn_editar_favoritos"><i class="glyphicon glyphicon-star"></i></button>
				  		</div>
				  		<div class="col-md-2 bnt-col">
				  			<button class="btn btn-primary btn-quad" id="btn_grupo_1"></button>
				  		</div>
				  		<div class="col-md-2 bnt-col">
				  			<button class="btn btn-primary btn-quad" id="btn_grupo_2"></i></button>
				  		</div>
				  		<div class="col-md-2 bnt-col">
				  			<button class="btn btn-primary btn-quad" id="btn_grupo_3"></i></button>
				  		</div>
				  		<div class="col-md-2 bnt-col">
				  			<button class="btn btn-primary btn-quad" id="btn_grupo_4"></i></button>
				  		</div>
				  		<div class="col-md-2 bnt-col">
				  			<button class="btn btn-primary btn-quad" id="btn_grupo_5"></i></button>
				  		</div>
				  	</div>

				  	<div class="row espacado" id="linha_favoritos">
				  		<div class="col-md-2 bnt-col">
				  			<button class="btn btn-info btn-quad""></button>
				  		</div>
				  		<div class="col-md-2 bnt-col">
				  			<button class="btn btn-info btn-quad""></i></button>
				  		</div>
				  		<div class="col-md-2 bnt-col">
				  			<button class="btn btn-info btn-quad""></i></button>
				  		</div>
				  		<div class="col-md-2 bnt-col">
				  			<button class="btn btn-info btn-quad""></i></button>
				  		</div>
				  		<div class="col-md-2 bnt-col">
				  			<button class="btn btn-info btn-quad""></i></button>
				  		</div>
				  		<div class="col-md-2 bnt-col">
				  			<button class="btn btn-info btn-quad""></i></button>
				  		</div>
				  	</div>



				  	<div class="row espacado" id="linha_operacoes_cupom_1">
				  		<div class="col-md-2 bnt-col">
				  			<button id="btn_inserir_produto" class="btn btn-primary btn-quad"><p><strong><i class="glyphicon glyphicon-search"></i></strong></p><p>Inserir Produto</p></button>
				  		</div>
				  		<div class="col-md-2 bnt-col">
				  			<button class="btn btn-primary btn-quad""></button>
				  		</div>
				  		<div class="col-md-2 bnt-col">
				  			<button class="btn btn-primary btn-quad""></i></button>
				  		</div>
				  		<div class="col-md-2 bnt-col">
				  			<button class="btn btn-primary btn-quad""></i></button>
				  		</div>
				  		<div class="col-md-2 bnt-col">
				  			<button class="btn btn-primary btn-quad""></i></button>
				  		</div>
				  		<div class="col-md-2 bnt-col">
				  			<button class="btn btn-primary btn-quad""></i></button>
				  		</div>	
				  	</div>

		
				  	<div class="row espacado" id="linha_operacoes_caixa_1">
				  		<div class="col-md-2 bnt-col">
				  			<button class="btn btn-info btn-quad" id="btn_nova_venda">
				  				<p><strong><i class="glyphicon glyphicon-plus"></i></strong></p>
				  				<p>Nova Venda</p>
				  			</button>
				  		</div>
				  		<div class="col-md-2 bnt-col">
				  			<button class="btn btn-info btn-quad"></button>
				  		</div>
				  		<div class="col-md-2 bnt-col">
				  			<button class="btn btn-info btn-quad"></i></button>
				  		</div>
				  		<div class="col-md-2 bnt-col">
				  			<button class="btn btn-info btn-quad"></i></button>
				  		</div>
				  		<div class="col-md-2 bnt-col">
				  			<button class="btn btn-info btn-quad"></i></button>
				  		</div>
				  		<div class="col-md-2 bnt-col">
				  			<button class="btn btn-info btn-quad"></i></button>
				  		</div>	
				  	</div>

				  	<div class="row espacado" id="linha_operacoes_finais" style="display: none;">
				  		<div class="col-md-2 bnt-col">
				  			<button class="btn btn-warning btn-quad"></i></button>
				  		</div>	
				  		<div class="col-md-4 bnt-col">
				  			<button class="btn btn-danger btn-quad" id="btn_cancelar_venda">
				  				<p><strong><i class="glyphicon glyphicon-minus"></i></strong></p>
				  				<p>Cancelar Venda</p>
				  			</button>
				  		</div>	
				  		<div class="col-md-6 bnt-col">
				  			<button class="btn btn-success btn-quad"></i></button>
				  		</div>	
				  	</div>
				  	<!-- operacoes finais -->
				</div>  	
		  	</div>

		  	<div class="col-md-8" id="div_selecao_produtos" style="display: none;">
		  		<div class="content">
		  			<div class="row espacado">
		  				<div class="input-group input-group-sm" >
			                	<input type="text" style="text-transform:uppercase" class="form-control pull-right" id="txt_busca_selec_produto" placeholder="Produto">
			                	<div class="input-group-btn">
			                  		<button id="btn_busca_produto" onclick="carrega_selec_produtos();" type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
			                	</div>
			            </div>
		  			</div>
		  		    <div class="row espacado">
		  		    	<div class="table-responsive"  style="overflow-y: scroll;max-height: 410px;">
							<table class="table table-hover" id="tabele_selecao_produto" style="font-size: 11.5px;">
							   <thead>
							        <tr style="background-color: #F4F4F4;">
								        <th>#</th>
								        <th>Produto</th>
								        <th>Estoque</th>
								        <th>Preço</th>
								    </tr>
								</thead>
								<tbody id="itens_selecao_produto">
								</tbody>
							</table>
						</div>
						<hr>
						<div class="text-left">
							<button class="btn btn-warning" id="btn_voltar_selec_produto"> Voltar</button>
						</div>
		  		    </div>

		  		</div>
			</div>



			<div class="col-md-3" id="div_pre_selecao_produtos" style="display: none;">
		  		<div class="content">
		  			<div class="row espacado">
		  				<div class="col-md-12 text-center">
		  					<p><strong><h4 id="nome_produto_pre_selecionado">PRODUTO</h4></strong></p>
		  					<p><h4 id="preco_produto_selecionado">R$ 00,00</h4></p>
		  				</div>
		  			</div>
		  			<div class="row espacado">
		  				<div class="col-md-6">
		  					<label>Qtde:</label>
		  					<input step=0.01 onfocusout='recalcular_subtotal_selecionado();' type="number" class="form-control" id="qtde_produto_pre_selecionado">
		  				</div>
		  				<div class="col-md-6">
		  					<label>SubTotal:</label>
		  					<input step=0.01  type="number" onfocusout='recalcular_qtde_selecionado();' class="form-control" id="subtotal_produto_selecionado">
		  					<input step=0.01  type="number" class="form-control" style="display: none;" id="vlr_unit_produto_selecionado">
		  					<input step=0.01  type="number" class="form-control" style="display: none;" id="cod_produto_selecionado">
		  				</div>
		  			</div>
		  			<hr>
		  			<div class="row espacado">
		  				<div class="col-md-12">
							<button class="btn btn-primary" id="btn_inserir_produto_selecionado"> Inserir</button>
		  				</div>
		  			</div>
		  		</div>
			</div>
		  		



		</div>
		</div>
	</div>
</div>



<script src="{{PASTA_PUBLIC}}/template/plugins/jQuery/jquery.min.js"></script>
<script src="{{PASTA_PUBLIC}}/template/bootstrap/js/custom.js"></script>
<script type="text/javascript">
	var cupom_aberto = false;
	var qtde_itens = 0;
	var valor_desconto = 0;
	var valor_acrescimo = 0;
	var total_venda = 0;
	var itens = [];
	// window.onbeforeunload = function()
	// {
	// 	if(cupom_aberto)
	// 		return "Venda em andamento, Deseja fechar a Página Consequentemente a Venda?";
	// };

	$("#txt_busca_produto").keyup(function(event)
	{
		if(event.keyCode == 13)
		{
			var produto = $('#txt_busca_produto').val();
			buscar_produto(produto);
		}
	});

	$("#txt_busca_selec_produto").keyup(function(event)
	{
		if(event.keyCode == 13)
		{
			var produto = $('#txt_busca_selec_produto').val();
			carrega_selec_produtos(produto);
		}
	});

	$("#qtde_produto_pre_selecionado").keyup(function(event)
	{
		if(event.keyCode == 13)
		{
			$('#subtotal_produto_selecionado').focus();
		}
	});

	$("#subtotal_produto_selecionado").keyup(function(event)
	{
		if(event.keyCode == 13)
		{
			recalcular_qtde_selecionado();
			$('#btn_inserir_produto_selecionado').click();
		}
	});

	$('#btn_inserir_produto_selecionado').on('click', function() 
	{
		codigo = $('#cod_produto_selecionado').val();
		descricao = $('#nome_produto_pre_selecionado').html();
		precovenda = $('#preco_produto_selecionado').html();
		precovenda = precovenda.substring(2,precovenda.length);
		qtde_item = $('#qtde_produto_pre_selecionado').val();
		preco_selecionado = $('#subtotal_produto_selecionado').val();
		operacao = "*";
		if(!cupom_aberto)
			abrir_venda();
		inserir_item(codigo,descricao,precovenda,qtde_item,operacao,preco_selecionado);	 

		$('#div_selecao_produtos').removeClass("col-md-5");
		$('#div_selecao_produtos').addClass("col-md-8"); 
		$('#div_pre_selecao_produtos').hide();  
	}); 



	$("#txt_busca_selec_produto").keyup(function(event)
	{
		var produto = $('#txt_busca_selec_produto').val();
		carrega_selec_produtos(produto);
	});


	function click_buscar_produto()
	{
		var produto = $('#txt_busca_produto').val();
		buscar_produto(produto);
	}

	function buscar_produto(produto)
	{
		var qtde_item = 0;
		var posicao = -1;
		var operacao = "";
		var preco_selecionado = "";
		if(posicao==-1)
			posicao = produto.indexOf("*");
		if(posicao==-1)
			posicao = produto.indexOf("$");
		if(posicao==-1)
			qtde_item=1;
		else
		{
			operacao = produto.substring(posicao,posicao+1);
			if(operacao=="*")
				qtde_item = produto.substring(0,posicao).replace(',','.');
			if(operacao=="$")
				preco_selecionado = produto.substring(0,posicao).replace(',','.');
			produto = produto.substring(posicao+1,produto.length);		
		}

		$.getJSON("{{asset('caixas/Produto')}}/"+produto, function(data) 
		{
			qtde_resultados = data.length;
			if(qtde_resultados>0)
			{
				if(qtde_resultados==1)
				{
					$.each(data, function(index,p)
		      		{    
		      			inserir_item(p.codigo,p.descricao,p.precovenda,qtde_item,operacao,preco_selecionado);
		      		});
		      	}
		      	else if(qtde_resultados>1)
		      	{
		      		abrir_selecao_produtos(produto);
		      	}
		    }
		    else
		    {
		    	abrir_selecao_produtos(produto);
		    }
		});
	}

	function abrir_selecao_produtos(produto="")
	{
		$('#div_botoes').hide();
		$('#div_pre_selecao_produtos').hide();
		$('#div_selecao_produtos').hide();
		$('#div_selecao_produtos').toggle(150);

		$('#txt_busca_selec_produto').val(produto);

		carrega_selec_produtos(produto);
	}

	function carrega_selec_produtos(produto="")
	{
		if(produto=="")
			produto = $('#txt_busca_selec_produto').val();
		$('#itens_selecao_produto').html(null);
		$.getJSON("{{asset('caixas/Produto')}}/"+produto, function(data) 
		{
			var produtos = "";
			$.each(data, function(index,p)
			{
				produtos += "<tr id='item_selec_"+p.codigo+"' onclick='pre_inserir_item("+p.codigo+")'>"+
								"<td id='item_cod_selec_"+p.codigo+"'>"+p.codigo+"</td>"+
								"<td id='item_desc_selec_"+p.codigo+"'>"+p.descricao+"</td>"+
								"<td id='item_qtde_selec_"+p.codigo+"'>"+p.estoque+"</td>"+
								"<td id='item_prec_selec_"+p.codigo+"'>R$ "+format_numero(p.precovenda,2)+"</td>"+
							"</tr>";
			});
			$('#itens_selecao_produto').html(produtos);
		});
	}

	function pre_inserir_item(codigo)
	{
		$('#div_selecao_produtos').removeClass("col-md-8");
		$('#div_selecao_produtos').addClass("col-md-5");
		$('#div_pre_selecao_produtos').hide();
		$('#div_pre_selecao_produtos').toggle(150);

		$('#nome_produto_pre_selecionado').html($('#item_desc_selec_'+codigo).html());
		$('#preco_produto_selecionado').html($('#item_prec_selec_'+codigo).html());
		$('#cod_produto_selecionado').val($('#item_cod_selec_'+codigo).html());
		$('#qtde_produto_pre_selecionado').val(1);
		preco = $('#item_prec_selec_'+codigo).html();
		preco = preco.substring(2,preco.length);
		$('#subtotal_produto_selecionado').val(parseFloat(preco));
		$('#vlr_unit_produto_selecionado').val(parseFloat(preco));

		$('#qtde_produto_pre_selecionado').focus();
	}
	function item_novo(item)
	{
		if(itens.indexOf(parseInt(item))==-1)
			return true;
		else
			return false;
	}

	function calcular_total()
	{
		var total = 0;
		var tabela = document.getElementById('table_cupom');
		var linhas = tabela.rows.length;
		for(i=1;i<linhas;i++)
		{
			valor =  tabela.rows[i].cells[4].innerHTML;
			valor =  parseFloat(valor.substring(2,valor.length));
			total+=valor;
		}
		$('#total_venda').html(format_numero(total,2));
	}	

	$('#btn_nova_venda').on('click', function() 
	{
	    abrir_venda();
	}); 

	function abrir_venda()
	{
		$('#linha_operacoes_finais').hide();
	    $('#div_cupom_fechado').hide();
	    $('#div_cupom_aberto').hide();
	    $('#div_cupom_aberto').toggle(150);
	    $('#linha_operacoes_finais').toggle(150);
	    $('#btn_nova_venda').prop('disabled','disabled');
	    cupom_aberto=true;
	    $('#txt_busca_produto').focus();
	}


	$('#btn_cancelar_venda').on('click', function() 
	{
		msg_confirm('<strong>Confirmação</strong>','Deseja Cancelar Venda?',"cancelar_venda()"); 	    
	}); 

	function cancelar_venda()
	{
		$('#btn_nova_venda').removeAttr('disabled');  
	    $('#linha_operacoes_finais').hide();
	    $('#div_cupom_fechado').hide();
	    $('#div_cupom_aberto').hide();	    
	    $('#div_cupom_fechado').toggle(150);
	    itens=[];
	    $('#itens_cupons').html(null);
	    calcular_total();
	    cupom_aberto=false;
	}

	$('#btn_fechar_caixa').on('click', function() 
	{
		msg_confirm('<strong>Confirmação</strong>','Deseja Fechar Caixa?',"fechar_caixa()"); 	    
	}); 

	$('#btn_inserir_produto').on('click', function() 
	{
	    abrir_selecao_produtos($('#txt_busca_produto').val());
	}); 

	$('#btn_voltar_selec_produto').on('click', function() 
	{
		$('#div_selecao_produtos').hide();
		$('#div_selecao_produtos').removeClass("col-md-5");
		$('#div_selecao_produtos').addClass("col-md-8");
		$('#div_pre_selecao_produtos').hide();
	    $('#div_botoes').toggle(150);		
	}); 

	function recalcular_subtotal_selecionado()
	{
		qtde = parseFloat($('#qtde_produto_pre_selecionado').val());
		precounitario = parseFloat($('#vlr_unit_produto_selecionado').val());
		$('#subtotal_produto_selecionado').val(qtde*precounitario);
	}

	function recalcular_qtde_selecionado()
	{
		subtotal = parseFloat($('#subtotal_produto_selecionado').val());
		precounitario = parseFloat($('#vlr_unit_produto_selecionado').val());
		$('#qtde_produto_pre_selecionado').val(subtotal/precounitario);
	}

	function selecionar_cliente()
	{
		alert('selecionar cliente');
	}

	function fechar_caixa()
	{
		alert('fechar caixa');
	}

	function inserir_item(codigo,descricao,precovenda,qtde_item,operacao,preco_selecionado)
	{
		codigo = parseInt(codigo);
		precovenda = parseFloat(precovenda);
		qtde_item = parseFloat(qtde_item);
		preco_selecionado = parseFloat(preco_selecionado);

		if(item_novo(codigo))
		{
			var preco_item = precovenda*qtde_item;

			if(operacao=="$")
			{
				qtde_item = parseFloat(preco_selecionado)/parseFloat(precovenda);
				preco_item = parseFloat(preco_selecionado);
			}

			$('#itens_cupons').append("<tr id='item_"+codigo+"'>"+
					        			"<td id='item_cod_"+codigo+"'>"+codigo+"</td>"+
										"<td id='item_desc_"+codigo+"'>"+descricao+"</td>"+
										"<td id='item_qtde_"+codigo+"'>"+qtde_item+"</td>"+
										"<td id='item_prec_"+codigo+"'>R$ "+format_numero(precovenda,2)+"</td>"+
										"<td id='item_subtotal_"+codigo+"'>R$ "+format_numero(preco_item,2)+"</td>"+
									  "</tr>");
			qtde_itens+=qtde_item;
			calcular_total();
			$('#txt_busca_produto').val(null);
			$('#txt_busca_produto').focus();
			itens.push(parseInt(codigo));
		}
		else
		{
			var qtde_item_inserido = parseFloat($('#item_qtde_'+codigo).html());
			var preco_anterior_itens = qtde_item_inserido * precovenda;
			qtde_item_inserido+=parseFloat(qtde_item);
			var preco_item = precovenda*qtde_item_inserido;

			$('#item_qtde_'+codigo).html(qtde_item_inserido);
			$('#item_subtotal_'+codigo).html("R$ "+format_numero(preco_item,2));
			qtde_itens++;
			calcular_total();
			$('#txt_busca_produto').val(null);
			$('#txt_busca_produto').focus();
			itens.push(parseInt(codigo));
		}
	}

</script>
@stop