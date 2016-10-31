@extends('templates.principal.principal')

@section('titulo','Visualização Caixa')

@section('topo')
<h1>Visualização 
  <small>de Caixa <strong>N° {{$caixa->id}}</strong></small>
</h1>
<ol class="breadcrumb">
  <li><a href="{{asset('')}}"><i class="glyphicon glyphicon-stats"></i> Início</a></li>
  <li><a href="{{asset('caixas')}}"><i class="glyphicon glyphicon-indent-left"></i> Caixas</a></li>
  <li><i class="glyphicon glyphicon-indent-left"></i> Caixa - {{$caixa->id}}</li>
</ol>
@stop


@section('conteudo')
<div class="row">
	<div class="col-md-12">
		<div class="box">
			<div class="box-header" style="height: 10px">
		      	<p class="title_box">Resumo</p>		
			</div>
			<div class="box-body"> 
			  <!-- conteudo -->
					
					<div class="row">
						<div class="col-md-2">
							<label>N° Caixa</label>
							<input type="text" class="form-control" value="{{$caixa->numero}}" readonly>
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
			</div>
			<div class="box-body" > 
			  <!-- conteudo -->
				

				<div class="col-md-8">
					<div class="box">
						<div class="box-header" style="height: 10px;">
					      	<p class="title_box" style="background-color: darkgray;color:white">... Por Produto</p>		
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
						</div>
						<div class="box-body"  style="background-color:whitesmoke "> 
						  <!-- conteudo -->
								
							<div class="row">
								<div class="col-md-8 text-left">
									<h4>Valor Inicial :</h4>
								</div>
								<div class="col-md-4 text-right" >
									<h4 ><strong>{{format_dinheiro('R$',$caixa->VALOR_INICIAL)}}</strong></h4>
								</div>
							</div>
							<div class="row">
								<div class="col-md-8 text-left">
									<h4>Total Vendas :</h4>
								</div>
								<div class="col-md-4 text-right" >
									<h4 ><strong>{{format_dinheiro('R$',$vlr_total)}}</strong></h4>
								</div>
							</div>
							<div class="row">
								<div class="col-md-8 text-left">
									<h4>Inserções :</h4>
								</div>
								<div class="col-md-4 text-right">
									<h4><strong>{{format_dinheiro('R$',$vlr_manutencoes['I'])}}</strong></h4>
								</div>
							</div>
							<div class="row">
								<div class="col-md-8 text-left">
									<h4>Retiradas :</h4>
								</div>
								<div class="col-md-4 text-right">
									<h4><strong>{{format_dinheiro('R$',$vlr_manutencoes['R'])}}</strong></h4>
								</div>
							</div>
							<hr>
							<!-- revisar -->
							<div class="row">
								<div class="col-md-8 text-left">
									<h4><strong>Saldo</strong> :</h4>
								</div>
								<div class="col-md-4 text-right">
									<h4><strong>{{format_dinheiro('R$', $caixa->VALOR_INICIAL+$vlr_total-$vlr_manutencoes['R'] + $vlr_manutencoes['I'] )}}</strong></h4>
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
						   		<tr title="Duplo clique para ver o cupom" ondblclick="verCupom({{$canc->numeronota}});">
						   			<td>{{$canc->numeronota}}</td>
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


function verCupom(cupom)
{
	alert("ver cupom numero "+cupom);
}

</script>
@stop