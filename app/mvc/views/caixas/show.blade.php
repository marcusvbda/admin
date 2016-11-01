@extends('templates.principal.principal')

@section('titulo','Visualização Caixa')

@section('topo')
<h1>Visualização 
  <small>de Caixa <strong>N° {{str_pad($caixa->numero, 6, "0", STR_PAD_LEFT)}}</strong></small>
</h1>
<ol class="breadcrumb">
  <li><a href="{{asset('')}}"><i class="glyphicon glyphicon-stats"></i> Início</a></li>
  <li><a href="{{asset('caixas')}}"><i class="glyphicon glyphicon-indent-left"></i> Caixas</a></li>
  <li><i class="glyphicon glyphicon-indent-left"></i> Caixa - {{str_pad($caixa->numero, 6, "0", STR_PAD_LEFT)}}</li>
</ol>
@stop


@section('conteudo')
<div class="row">
	<div class="col-md-12">
		<div class="box">
			<div class="box-header" style="height: 10px">
		      	<p class="title_box">Resumo</p>	
		      	<div class="box-tools pull-right">
			    	<button type="button" class="btn btn-box-tool" data-widget="collapse">
			    		<i class="fa fa-minus"></i>
			    	</button>		                
			    </div>	
			</div>
			<div class="box-body"> 
			  <!-- conteudo -->
					
					<div class="row">
						<div class="col-md-2">
							<label>N° Caixa</label>
							<input type="text" class="form-control" value="{{str_pad($caixa->numero, 6, "0", STR_PAD_LEFT)}}" readonly>
						</div>
						<div class="col-md-4">
							<label>Ilha</label>
							<input type="text" class="form-control" value="{{$caixa->numero_ilha}} - {{$caixa->nome_ilha}}" readonly>
						</div>	
						<div class="col-md-6">
							<label>Funcionário</label>
							<input type="text" class="form-control" value="{{$caixa->numero_funcionario}} - {{$caixa->nome_funcionario}}" readonly>
						</div>				
					</div>

					<div class="row">
						<div class="col-md-3">
							<label>Abertura</label>
							<input type="text" class="form-control" value="{{dia_semana($caixa->dataabertura)}} , {{$caixa->dataabertura_formatada}} , {{$caixa->horaabertura}}" readonly>
						</div>
						<div class="col-md-3">
							<label>Fechamento</label>
							<input type="text" class="form-control" value="{{dia_semana($caixa->dataabertura)}} , {{$caixa->datafechamento_formatada}}, {{$caixa->horafechamento}}" readonly>
						</div>
						<div class="col-md-3">
							<label>Permanencia</label>
							<input type="text" class="form-control" value="{{$dias_permanencia }} Dia(s), {{$horas_permanencia}} Hora(s)" readonly>
						</div>
						<div class="col-md-3">
							<label>Situação</label>
								<input type="text" class="form-control" value="{{$caixa->situacao}}" readonly>
						</div>
					</div>
					<hr>

			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="box"  id="movimento_porcento_circulos">
			<div class="box-header" style="height: 10px">
		      	<p class="title_box">Movimento Grupos de Produto (%)</p>	
		      	<div class="box-tools pull-right">
			    	<button type="button" class="btn btn-box-tool" data-widget="collapse">
			    		<i class="fa fa-minus"></i>
			    	</button>		                
			    </div>	
			</div>
			<div class="box-body"> 
			  <!-- conteudo -->
			  	<div class="col-md-12" style="padding: 10px;">

			  		@foreach($porcentagem_grupo as $grupo_porcentagem)	
						<div class="col-md-2">
					        <div id="circulo_porcentagem_{{$grupo_porcentagem->grupo}}" class="text-center">
							    <label style="margin-bottom: -30">{{$grupo_porcentagem->grupo}}</label>				        	
					        </div>
						</div>
					@endforeach
									
				</div>					

				<hr>				
			</div>
		</div>
	</div>
</div>

@if($tem_combustiveis)
	<div class="row">
		<div class="col-md-12">
			<div class="box"  id="movimento_porcento_circulos">
				<div class="box-header" style="height: 10px">
			      	<p class="title_box">Movimento Combustíveis (%)</p>		
			      	<div class="box-tools pull-right">
			            <button type="button" class="btn btn-box-tool" data-widget="collapse">
			            	<i class="fa fa-minus"></i>
			            </button>		                
			        </div>
				</div>
				<div class="box-body"> 
				  <!-- conteudo -->
				  	<div class="col-md-12" style="padding: 10px;">

				  		@foreach($ag_combustiveis as $ag)	
				  			<div class="col-md-2">
							    <div id="circulo_porcentagem_comb_{{$ag->NUMERO_PRODUTO}}" class="text-center">
							    	<label style="margin-bottom: -30">{{$ag->DESCRICAO_PRODUTO}}</label>
							    </div>
							</div>
						@endforeach
										
					</div>					

					<hr>				
				</div>
			</div>
		</div>
	</div>
@endif

<div class="row" id="movimento_table_agrupado_grupos">
	<div class="col-md-12" >
		<div class="box" >
			<div class="box-header" style="height: 10px">
		      	<p class="title_box">Movimento Agrupado</p>		
		      	<div class="box-tools pull-right">
			    	<button type="button" class="btn btn-box-tool" data-widget="collapse">
			    		<i class="fa fa-minus"></i>
			    	</button>		                
			    </div>
			</div>
			<div class="box-body" > 
			  <!-- conteudo -->
				

				<div class="col-md-8">
					<div class="box">
						<div class="box-header" style="height: 10px;">
					      	<p class="title_box" style="background-color: darkgray;color:white">... Por Produto</p>		
					      	<div class="box-tools pull-right">
					            <button type="button" class="btn btn-box-tool" data-widget="collapse">
					            	<i class="fa fa-minus"></i>
					            </button>		                
					        </div>
						</div>
						<div class="box-body" > 

							<div class="table-responsive" >
								 <table class="table table-hover" style="font-size: 14px">
								    <thead>
									    <tr style="background-color: #F4F4F4;border-radius: 100px;">
									      <th>Produto</th>
									      <th>Grupo</th>						      
									      <th>Qtde</th>
									      <th>Valor</th>
									      <th>%</th>
									    </tr>
								    </thead>
								   <tbody>
								   		@foreach($agrupado as $ag)
								   		<tr>
								   			<td>{{$ag->DESCRICAO_PRODUTO}}</td>
								   			<td>{{$ag->DESCRICAO}}</td>					   			
								   			<td>{{$ag->QUANTIDADE}}</td>
								   			<td>{{format_dinheiro('R$',$ag->VALORNEGOCIACAO)}}</td>
								   			<td>{{number_format((($ag->VALORNEGOCIACAO*100)/$vlr_total), 2, ',', ' ')   }} %</td>
								   		</tr>
								   		@endforeach
								   </tbody>
								 </table>
								 <hr>
							</div>							

						</div>
					</div>
				</div>


				<div class="col-md-4" >
					<div class="box" >
						<div class="box-header" style="height: 10px">
					      	<p class="title_box" style="background-color: darkgray;color:white">... Por Grupo de Produto</p>
					      	<div class="box-tools pull-right">
					            <button type="button" class="btn btn-box-tool" data-widget="collapse">
					            	<i class="fa fa-minus"></i>
					            </button>		                
					        </div>
					      	<div class="box-tools pull-right">
				            <button type="button" class="btn btn-box-tool" data-widget="collapse">
				            	<i class="fa fa-minus"></i>
				            </button>		                
			        </div>		
						</div>
						<div class="box-body" > 
						  <!-- conteudo -->
							<div class="table-responsive" >
								 <table class="table table-hover" style="font-size: 14px">
								    <thead>
									    <tr style="background-color: #F4F4F4;border-radius: 100px;">
									      <th>Grupo</th>						      
									      <th>Qtde</th>
									      <th>Valor</th>
									      <th>%</th>
									    </tr>
								    </thead>
								   <tbody>
								   		@foreach($porcentagem_grupo as $ag)
								   		<tr>
								   			<td>{{$ag->grupo}}</td>					   			
								   			<td>{{$ag->QUANTIDADE}}</td>
								   			<td>{{format_dinheiro('R$',$ag->VALORNEGOCIACAO)}}</td>
								   			<td>{{number_format((($ag->VALORNEGOCIACAO*100)/$vlr_total), 2, ',', ' ')   }} %</td>
								   		</tr>
								   		@endforeach
								   </tbody>
								 </table>
								 <hr>
							</div>
						</div>
					</div>


					<div class="box" style="bottom: 0">
						<div class="box-header" style="height: 10px">
					      	<p class="title_box" style="background-color: darkgray;color:white">Valores</p>
					      	<div class="box-tools pull-right">
					            <button type="button" class="btn btn-box-tool" data-widget="collapse">
					            	<i class="fa fa-minus"></i>
					            </button>		                
					        </div>		
						</div>
						<div class="box-body"  style="background-color:whitesmoke "> 
						  <!-- conteudo -->

							<div class="row text-center"><strong>Créditos</strong></div>
							<div class="row">
								<div class="col-md-6 text-left">Total Vendas :</div>
								<div class="col-md-6 text-right" >{{format_dinheiro('R$',$vlr_total)}}</div>
							</div>
							<div class="row">
								<div class="col-md-6 text-left">Total Inserções :</div>
								<div class="col-md-6 text-right">{{format_dinheiro('R$',$vlr_manutencoes['I'])}}
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 text-left">Total Créditos :</div>
								<div class="col-md-6 text-right">{{format_dinheiro('R$',$vlr_manutencoes['I']+$vlr_total)}}
								</div>
							</div>
							<div class="row text-center"><strong>Débitos</strong></div>							
							<div class="row">
								<div class="col-md-6 text-left">Total Retiradas :</div>
								<div class="col-md-6 text-right">{{format_dinheiro('R$',$vlr_manutencoes['R'])}}
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 text-left">Total a Prazo :</div>
								<div class="col-md-6 text-right">{{format_dinheiro('R$',$total_prazo)}}</div>
							</div>
							<div class="row">
								<div class="col-md-6 text-left">Total a Pagto Antecipado :</div>
								<div class="col-md-6 text-right">{{format_dinheiro('R$',0)}}
								</div>
							</div>

							<hr>
							<!-- revisar -->
							<div class="row">
								<div class="col-md-6 text-left"><strong>Sub Total</strong> :</div>
								<div class="col-md-6 text-right">
									<strong>{{format_dinheiro
											('R$', 
												$caixa->VALOR_INICIAL + $vlr_total-$vlr_manutencoes['R'] + $vlr_manutencoes['I'] - $total_prazo 
											)}}</strong>
								</div>
							</div>
							<!-- revisar -->

						</div>
					</div>

				</div>





			</div>
		</div>
	</div>
</div>



<div class="row">
		<div class="col-md-6">
			<div class="box">
				<div class="box-header" style="height: 10px;">
			      	<p class="title_box">Manutenções de Caixa</p>		
			      	<div class="box-tools pull-right">
			            <button type="button" class="btn btn-box-tool" data-widget="collapse">
			            	<i class="fa fa-minus"></i>
			            </button>		                
			        </div>
				</div>
				<div class="box-body" > 

					<div class="table-responsive" >
						 <table class="table table-hover" style="font-size: 14px">
						    <thead>
							    <tr style="background-color: #F4F4F4;border-radius: 100px;">
							      <th>Documento</th>
							      <th>Descrição</th>
							      <th>Data</th>						      
							      <th>Hora</th>
							      <th>Usuário</th>
							      <th>Tipo</th>
							      <th>Valor</th>
							    </tr>
						    </thead>
						   <tbody>
						   		@foreach($manutencoes as $mn)
						   		@if($mn->tipo=="R")
						   			<tr style="background-color: mistyrose">
						   		@else
						   			<tr style="background-color: #c0ffc0">
						   		@endif

						   			<td>{{$mn->documento}}</td>
						   			<td>{{$mn->descricao}}</td>
						   			<td>{{$mn->data_formatada}}</td>
						   			<td>{{$mn->hora}}</td>
						   			<td>{{$mn->usuariolancamento}}</td>
						   			@if($mn->tipo=="R")
						   				<td>Retirada</td>
						   			@else
						   				<td>Inserção</td>
						   			@endif
						   			<td>{{format_dinheiro('R$',$mn->valor)}}</td>
						   		</tr>
						   		@endforeach
						   </tbody>
						 </table>
						 <hr>
					</div>							

				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="box">
				<div class="box-header" style="height: 10px;">
			      	<p class="title_box">Cancelamentos</p>
			      	<div class="box-tools pull-right">
			            <button type="button" class="btn btn-box-tool" data-widget="collapse">
			            	<i class="fa fa-minus"></i>
			            </button>		                
			        </div>		
				</div>
				<div class="box-body" > 

					<div class="table-responsive" >
						 <table class="table table-hover" style="font-size: 14px">
						    <thead>
							    <tr style="background-color: #F4F4F4;border-radius: 100px;">
							      <th>Cupom</th>
							      <th>Data</th>						      
							      <th>Hora</th>
							      <th>Usuário</th>
							      <th>Valor</th>
							    </tr>
						    </thead>
						   <tbody>
						   		@foreach($cancelamentos as $canc)
						   		<tr title="Duplo clique para ver o cupom" ondblclick="verDocumento({{$canc->numeronota}});">
						   			<td>{{str_pad($canc->numeronota, 6, "0", STR_PAD_LEFT)}}</td>
						   			<td>{{$canc->data_formatada}}</td>
						   			<td>{{$canc->hora}}</td>
						   			<td>{{$canc->usuariocancelamento}}</td>
						   			<td>{{format_dinheiro('R$',$canc->valor)}}</td>
						   		</tr>
						   		@endforeach
						   </tbody>
						 </table>
						 <hr>
					</div>							

				</div>
			</div>
		</div>
</div>



<div class="row">
		<div class="col-md-12" style="height: 400px;overflow-y: auto">
			<div class="box">
				<div class="box-header" style="height: 10px;">
			      	<p class="title_box">Cupons</p>	
				    <div class="box-tools pull-right">
			            <button type="button" class="btn btn-box-tool" data-widget="collapse">
			            	<i class="fa fa-minus"></i>
			            </button>		                
			        </div>
				</div>
				<div class="box-body" > 

					<div class="table-responsive" >
						 <table class="table table-hover" style="font-size: 14px">
						    <thead>
							    <tr style="background-color: #F4F4F4;border-radius: 100px;">
							      <th>ECF / S@T</th>
							      <th>Cupom</th>
							      <th>Data</th>						      
							      <th>Hora</th>
							      <th>Cód. Cliente</th>
							      <th>Nome Cliente</th>
							      <th>Valor</th>
							      <th>Tipo Venda</th>
							    </tr>
						    </thead>
						   <tbody>
						   		@foreach($cupons as $c)
						   		<tr title="Duplo clique para ver o cupom" ondblclick="verDocumento({{$c->numeronota}});">
						   			<td>{{str_pad($c->ecf, 6, "0", STR_PAD_LEFT)}}</td>
						   			<td>{{str_pad($c->numeronota, 6, "0", STR_PAD_LEFT)}}</td>						   			
						   			<td>{{$c->data_formatada}}</td>
						   			<td>{{$c->hora}}</td>
						   			<td>{{str_pad($c->numero_cliente, 6, "0", STR_PAD_LEFT)}}</td>
						   			@if($c->numero_cliente=='999999')
						   				<td>COMSUMIDOR</td>
						   			@else
						   				<td>{{$c->nome_cliente}}</td>
						   			@endif
						   			<td>{{format_dinheiro('R$',$c->valortotalcupom)}}</td>
						   			@if($c->recebido=='S')
						   				<td>À Vista</td>
						   			@else
						   				<td>A Prazo</td>
						   			@endif
						   		</tr>
						   		@endforeach
						   </tbody>
						 </table>
						 <hr>
					</div>							

				</div>
			</div>
		</div>
</div>

<script src="{{PASTA_PUBLIC}}/template/plugins/jQuery/jquery.min.js"></script>
<script src="{{PASTA_PUBLIC}}/template/bootstrap/js/custom.js"></script>
<script src="{{PASTA_PUBLIC}}/template/bootstrap/js/circulos.js"></script>
<script type="text/javascript">		
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
									    			"<td>R$ "+r.totaldinheiro+"</td>"+
									    		"</tr>");

	      });

	}, 'json')
	.done(function() {
	    $('#Modal_Documento').modal('show');
	});
}
	

</script>










  <div class="modal fade"  id="Modal_Documento" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
        	<h4 class="text-center"><strong><span id="documento_titulo"></span></strong></h4>
        </div>
        <div class="modal-body">
           

          	<ul class="nav nav-tabs" id="myTab" role="tablist">
			  <li class="nav-item active">
			    <a class="nav-link active" data-toggle="tab" href="#cupom" role="tab" aria-controls="cupons">Cupom</a>
			  </li>
			  <li class="nav-item">
			    <a class="nav-link" data-toggle="tab" href="#itens" role="tab" aria-controls="itens">Itens</a>
			  </li>
			 <!--  <li class="nav-item">
			    <a class="nav-link" data-toggle="tab" href="#formaspagtos" role="tab" aria-controls="formaspagtos">Formas Pagtos</a>
			  </li> -->
			</ul>

			<div class="tab-content">
			  <div class="tab-pane active" id="cupom" role="tabpanel">

			  			<br>
			  	       	<div class="row">
          					<div class="col-md-8">
			          			<label>Nome Cliente:</label>
			          			<input type="text" id="Nome_Cliente" class="form-control" disabled>
			          		</div>
			          		<div class="col-md-4">
			          			<label>CPF/CNPJ:</label>
			          			<input type="text" id="cnpj" class="form-control" disabled>
			          		</div>
			          	</div>

			          	<div class="row">
			          		<div class="col-md-12">
			          			<label>Condição de Pagto:</label>
			          			<input type="text" id="Cond_pagto" class="form-control" disabled>
			          		</div>
			          	</div>

			          	<div class="row">
			          		<div class="col-md-3">
			          			<label>Data Negociação:</label>
			          			<input type="text" id="Data_Negociacao" class="form-control" disabled>
			          		</div>
			          		<div class="col-md-3">
			          			<label>Emissão:</label>
			          			<input type="text" id="Emissao" class="form-control" disabled>
			          		</div>
			          		<div class="col-md-3">
			          			<label>Data Vencimento:</label>
			          			<input type="text" id="Data_Vencimento" class="form-control" disabled>
			          		</div>
			          		<div class="col-md-3">
			          			<label>Hora:</label>
			          			<input type="text" id="Hora" class="form-control" disabled>
			          		</div>
			          	</div>

			          	<div class="row">
			          		<div class="col-md-3">
			          			<label>Número ECF/S@T:</label>
			          			<input type="text" id="ECF" class="form-control" disabled>
			          		</div>
			          		<div class="col-md-3">
			          			<label>Cupom:</label>
			          			<input type="text" id="Cupom" class="form-control" disabled>
			          		</div>
			          		<div class="col-md-3">
			          			<label>Tipo Nota:</label>
			          			<input type="text" id="Tipo" class="form-control" disabled>
			          		</div>
			          		<div class="col-md-3">
			          			<label>Funcionário:</label>
			          			<input type="text" id="Funcionario" class="form-control" disabled>
			          		</div>
			          	</div>

			          	<div class="row">
			          		<div class="col-md-3">
			          			<label>Motorista</label>
			          			<input type="text" id="Motorista" class="form-control" disabled>
			          		</div>
			          		<div class="col-md-3">
			          			<label>KM:</label>
			          			<input type="text" id="km" class="form-control" disabled>
			          		</div>
			          		<div class="col-md-3">
			          			<label>Placa:</label>
			          			<input type="text" id="Placa" class="form-control" disabled>
			          		</div>
			          		
			          	</div>

			  </div>
			  <div class="tab-pane" id="itens" role="tabpanel" style="height: 315px;overflow-y: auto">
			  		<div class="table-responsive" >
						 <table class="table table-hover" style="font-size: 14px">
						    <thead>
							    <tr style="background-color: #F4F4F4;border-radius: 100px;">
							      <th>Produto</th>
							      <th>Bico</th>
							      <th>P.Unitário</th>						      
							      <th>Qtde</th>
							      <th>Valor</th>
							    </tr>
						    </thead>
						   <tbody id="itens_table_itens_cupom">
						   	
						   </tbody>
						 </table>
						 <hr>
					</div>	
				</div>
			<!--   <div class="tab-pane" id="formaspagtos" role="tabpanel">...</div> -->
			</div>


        </div>
        <br>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
        </div>
      </div>
      
    </div>
  </div>

@stop