@extends('templates.principal.principal')

@section('titulo','Tribuatações / Códigos')

@section('topo')
<h1>Relatório
  <small>Tribuatações / Códigos</small>
</h1>
<ol class="breadcrumb">
  <li><a href="{{asset('')}}"><i class="fa fa-dashboard"></i> Início</a></li>
  <li><i class="glyphicon glyphicon-list-alt"></i> Relatório de Tribuatações / Códigos</li>
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
		
		<div class="row">
			<div class="col-md-12">

				<form action="{{asset('relatorios/imprimir_tributacoes_codigos')}}" method="POST">		
					<div class="row">
						<div class="col-md-4">
							<label>NCM</label>
							<input class="form-control" type="text" pattern="[0-9.]+" name="NCM">
						</div>
						<div class="col-md-4">
							<label>ANP</label>
							<input class="form-control" type="text" pattern="[0-9.]+" name="ANP">
						</div>
						<div class="col-md-4">
							<label>CEST</label>
							<input class="form-control" type="text" pattern="[0-9.]+" name="CEST">
						</div>
					</div>

					<div class="row">
						<div class="col-md-2">
							<label>CST Entrada</label>
							<input class="form-control" type="text" pattern="[0-9.]+" name="CST_entrada">
						</div>
						<div class="col-md-2">
							<label>CST Saida</label>
							<input class="form-control" type="text" pattern="[0-9.]+" name="CST_saida">
						</div>
						<div class="col-md-2" style="padding-top: 27px;">
							<label>Calcula PIS <input type="checkbox" name="calcula_pis"></label>
						</div>
						<div class="col-md-2" style="padding-top: 27px;">
							<label>Calcula COFINS <input type="checkbox" name="calcula_cofins"></label>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-md-2">
							<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-print"></span> Relatório</button>
						</div>
					</div>
				</form>


			</div>
		</div>


		</div>
		<div class="box-footer">
			<!-- rodapé -->
		</div>
	</div>
</div>
@stop