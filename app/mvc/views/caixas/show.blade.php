@extends('templates.principal.principal')

@section('titulo','PÁGINA EM BRANCO')

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

<div class="col-md-6">
	<div class="box">
		<div class="box-header" style="height: 10px">
	      	<p class="title_box">Movimento</p>		
		</div>
		<div class="box-body"> 
		  <!-- conteudo -->
		  	<div class="row">
		  		<div class="col-md-3 text-center">
		  			<label>Cigarros</label>
					<div id="circulo_porcentagem_cervejas" style="padding-left: 12px;padding-right: 12px;" data-percent="1"></div>
				</div>
				<div class="col-md-3 text-center">
		  			<label>Cervejas</label>
					<div id="circulo_porcentagem_cigarros" style="padding-left: 12px;padding-right: 12px;" data-percent="6"></div>
				</div>
				<div class="col-md-3 text-center">
		  			<label>Lubrificantes</label>
					<div id="circulo_porcentagem_lubrificantes" style="padding-left: 12px;padding-right: 12px;" data-percent="15"></div>
				</div>
				<div class="col-md-3 text-center">
		  			<label>Combustiveis</label>
					<div id="circulo_porcentagem_combustiveis" style="padding-left: 12px;padding-right: 12px;" data-percent="78"></div>
				</div>
			</div>

					

			<hr>				
		</div>
	</div>
</div>


<script src="{{PASTA_PUBLIC}}/template/plugins/jQuery/jquery.min.js"></script>
<script src="{{PASTA_PUBLIC}}/template/bootstrap/js/custom.js"></script>
<script src="{{PASTA_PUBLIC}}/template/bootstrap/js/percent_circle.js"></script>
<script type="text/javascript">		
$('#circulo_porcentagem_cervejas').percentcircle();
$('#circulo_porcentagem_cigarros').percentcircle();
$('#circulo_porcentagem_lubrificantes').percentcircle();
$('#circulo_porcentagem_combustiveis').percentcircle();
</script>
@stop