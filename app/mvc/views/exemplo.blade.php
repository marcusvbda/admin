@extends('templates.principal.principal')

@section('titulo','PÁGINA EM BRANCO')

@section('topo')
<h1>TITULO
  <small>SUBTITULO</small>
</h1>
<ol class="breadcrumb">
  <li><a href="{{asset('')}}"><i class="fa fa-dashboard"></i> Início</a></li>
  <li><i class="fa fa-dashboard"></i> PAGINA ATUAL</li>
</ol>
@stop


@section('conteudo')
<div class="col-md-12">
	<div class="box">
		<div class="box-header">
	      	<p class="title_box"></p>			 
			<div class="box-tools pull-right">
			</div>
		</div>
		<div class="box-body">
		  <!-- conteudo -->
				
				


		</div>
		<div class="box-footer">
			<!-- rodapé -->
		</div>
	</div>
</div>

@stop