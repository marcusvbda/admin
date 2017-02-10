@extends('templates.principal.principal')
@section('titulo','Caixas')

@section('topo')
<h1>Caixas
  <small>Consulta de caixas</small>
</h1>
<ol class="breadcrumb">
  <li><a href="{{asset('')}}"><i class="glyphicon glyphicon-stats"></i> Início</a></li>
  <li><i class="glyphicon glyphicon-indent-left"></i> Caixas</li>
</ol>
@stop


@section('conteudo')
<div class="col-md-12" id="div_selec_caixa">
	<div class="box">
		<div class="box-header">
	      	<p class="title_box">Caixas</p>			 
			<div class="box-tools pull-right">
			</div>
		</div>
		<div class="box-body">
		  <!-- conteudo -->
		  	<div class="row">
		  		<div class="col-md-12">
			  		<div class="col-md-2 text-left" id="div_periodo_inicio">
			  			<label>Periodo Inicio</label>
			  			<input type="date" class="form-control" id="data_inicio" value="{{$data_inicio}}">
			  		</div>
			  		<div class="col-md-2 text-left" id="div_periodo_fim">
			  			<label>Periodo Fim</label>
			  			<input type="date" class="form-control" id="data_fim" value="{{$data_fim}}">
			  		</div>
			  		<div class="col-md-1">
			  			<button class="btn btn-success" onclick="consultar();" style="margin-top: 26px;"> <span class="glyphicon glyphicon-search"></span></button>
			  		</div>
			  	</div>
		  	</div>
		  	<hr>
		  	<div class="row">
		  		<div class="col-md-12" style="overflow-y: scroll;max-height: 500px;">
					<table class="table table-hover" id="table_cupom">
						<thead>
						  <tr style="background-color: #F4F4F4;border-radius: 100px;">
						    <th>#</th>
						    <th>Ilha</th>
						    <th>Numero</th>
						    <th>Abertura</th>
						    <th>Fechamento</th>
						  </tr>
						</thead>
						<tbody>
							@foreach($caixas as $caixa)
							<tr onclick="click_caixa({{$caixa->sequencia}})">
				  				<td></td>
				  				<td>{{$caixa->numero_ilha}}</td>
				  				<td>{{$caixa->numero}}</td>
				  				<td>{{$caixa->dataabertura_formatada}}</td>
				  				<td>{{$caixa->datafechamento_formatada}}</td>
				  			</tr>
				  			@endforeach
						</tbody>
					</table>
				</div>
			</div>
				
		</div>
	</div>
</div>


<div class="col-md-4" id="div_visualizacao_caixa" style="display: none;">
	<div class="box">
		<div class="box-header">
	      	<p class="title_box">Caixa - <span id="numero_caixa_titulo"></span></p>		
		</div>
		<div class="box-body">
		 	<div class="row">
		  		<div class="col-md-12 text-left">
					<p><strong>Número :</strong><span id="id_caixa"></span></p>
					<p><strong>Data Abertura :</strong><span id="dt_abertura"></span></p>
					<p><strong>Data Fechamento :</strong><span id="dt_fechamento"></span></p>
					<p><strong>Ilha :</strong><span id="ilha"></span></p>
					<p><strong>Responsável :</strong><span id="responsavel"></span></p>
					<p><strong>Valor Inicial :</strong><span id="vlr_inicial"></span></p>
					<p><strong>Situação :</strong><span id="situacao"></span></p>
				</div>
			</div>
			<hr>
		  	<div class="row">
		  		<div class="col-md-2 text-left">
					<a onclick="voltar_selecao();"><button class="btn btn-warning">Voltar</button></a>
				</div>
				<div class="col-md-2 text-right">
					<a id="btn_visualizar"><button class="btn btn-primary">Visualizar</button></a>
				</div>
			</div>
				
		</div>
	</div>
</div>

@stop


