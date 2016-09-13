@extends('templates.principal.principal')

@section('titulo','Tanques')

@section('topo')
<h1>Tanques
  <small>Volumes e Capacidades</small>
</h1>
<ol class="breadcrumb">
  <li><a href="{{asset('')}}"><i class="fa fa-dashboard"></i> Início</a></li>
  <li><i class="glyphicon glyphicon-tasks"></i> Tanques</li>
</ol>
@stop


@section('conteudo')
<div class="col-md-12">
	<div class="box">
		<!-- <div class="box-header">
	      	<p class="title_box"></p>			 
			<div class="box-tools pull-right">
			</div>
		</div> -->
		<div class="box-body">
		  <!-- conteudo -->
				<div class="row">
				@foreach($tanques as $tanque)
				  	<div class="col-md-6">
				  		<div class="centro"><h3><b>Tanque {{$tanque->id}}</b></h3></div>
				  		<div class="centro"><h5>Capacidade : {{$tanque->capacidade}} Litros</h5></div>
				  		<div class="centro"><h5><b>{{$tanque->nomefantasia}}</b></h5></div>
						<div id="chartContainer{{$tanque->sequencia}}" style="height: 400px; width: 100%;"></div><br>
						<hr>
						<hr>
					</div>
				@endforeach	
			</div>


		</div>
		<div class="box-footer">
			<!-- rodapé -->
		</div>
	</div>
</div>

<script src="{{PASTA_PUBLIC}}/template/plugins/jQuery/jquery.min.js"></script>
<script src="{{PASTA_PUBLIC}}/template/bootstrap/js/custom.js"></script>
<script src="{{PASTA_PUBLIC}}/template/graficos/graficos.js"></script>
<script type="text/javascript">
	$( document ).ready(function()
	{
	    carrega_graficos();
	});

	function carrega_graficos()
	{
		@foreach($tanques as $tanque)
			var tanque = new CanvasJS.Chart("chartContainer{{$tanque->sequencia}}",
			{
				// title:
				// {
				// 	text: "Tanque {{$tanque->id}} ({{$tanque->nomefantasia}})"
				// },
				animationEnabled: true,
				data: 
				[
					{
						type: "doughnut",
						toolTipContent: "<strong>{y}</strong> Litros",
						showInLegend: true,
					    explodeOnClick: true,
						dataPoints: 
						[
							{y: parseFloat("{{$tanque->capacidade-$tanque->volumeatual}}"),legendText: "Vazio"},
							{y: parseFloat("{{$tanque->volumeatual}}"), indexLabel: "#percent% cheio" , legendText: "Cheio" }
						]
					}
				]
			});
			tanque.render();
		@endforeach
	}
</script>
@stop