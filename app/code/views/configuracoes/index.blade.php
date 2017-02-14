@extends('templates.principal.principal')

@section('titulo','Configurações')

@section('topo')
<h1>Configurações
  <small>Parâmetros de sistema</small>
</h1>
<ol class="breadcrumb">
  <li><a href="{{asset('')}}"><i class="fa fa-dashboard"></i> Início</a></li>
  <li><i class="glyphicon glyphicon-wrench"></i> Configurações / Parâmetros</li>
</ol>
@stop


@section('conteudo')
<input type="text" id="cliques" value="0" hidden>

<div class="col-md-12">
	<div class="box">
		<div class="box-header" style="height: 30px;padding-bottom: 0px;">
      		<p class="title_box">Configurações</p>
		  <div class="box-tools pull-right">
		  </div>
		</div>
		<div class="box-body">
		  <!-- conteudo -->
				
		</div>
	</div>
</div>


<div class="col-md-12">
	<button class="btn btn-primary btn-sm" id="btn_salvar" ><span class="glyphicon glyphicon-ok"></span> Salvar Alterações</button>
</div>


@stop