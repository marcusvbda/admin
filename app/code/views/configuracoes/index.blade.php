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
      		<p class="title_box">Configurações de acesso</p>
		  <div class="box-tools pull-right">
		  </div>
		</div>
		<div class="box-body">
		  <!-- conteudo -->
				<div class="row">
					@foreach($parametros as $parametro)
						@if($parametro->classificacao=="ACESSO")
							<div class="col-md-2">							
								@if($parametro->tipo=="CHECKBOX")
									@if($parametro->valor=="S")
									<label>
										<input onchange="clique()" type="checkbox" checked id="{{$parametro->id}}" name="{{$parametro->id}}">
											{{$parametro->titulo}}<br>
										<small style="font-weight:lighter;">{{$parametro->descricao}}</small>
									</label>
									@else
									<label>
										<input onchange="clique()" type="checkbox"  id="{{$parametro->id}}" name="{{$parametro->id}}">
											{{$parametro->titulo}}<br>
										<small style="font-weight:lighter;">{{$parametro->descricao}}</small>
									</label>
									@endif
								@elseif($parametro->tipo=="TEXTO")
									<label>{{$parametro->titulo}}</label>
									<input onchange="clique()" type="text" id="{{$parametro->id}}" value="{{$parametro->valor}}" name="{{$parametro->id}}"><br>
									<small>{{$parametro->descricao}}</small>
								@elseif($parametro->tipo=="NUMERO")
									<label>{{$parametro->titulo}}</label>									
									<input onkeyup="clique()" onchange="clique()" type="number" id="{{$parametro->id}}" value="{{$parametro->valor}}" name="{{$parametro->id}}"><br>
									<small>{{$parametro->descricao}}</small>
								@endif							
							</div>	
						@endif
					@endforeach			
				</div>
		</div>
	</div>
</div>

<div class="col-md-12">
	<div class="box">
		<div class="box-header" style="height: 30px;padding-bottom: 0px;">
      		<p class="title_box">Configurações de Relatórios</p>
		  <div class="box-tools pull-right">
		  </div>
		</div>
		<div class="box-body">
		  <!-- conteudo -->
				<div class="row">
					@foreach($parametros as $parametro)
						@if($parametro->classificacao=="RELATORIOS")
							<div class="col-md-2">							
								@if($parametro->tipo=="CHECKBOX")
									@if($parametro->valor=="S")
									<label>
										<input onchange="clique()" type="checkbox" checked id="{{$parametro->id}}" name="{{$parametro->id}}">
											{{$parametro->titulo}}<br>
										<small style="font-weight:lighter;">{{$parametro->descricao}}</small>
									</label>
									@else
									<label>
										<input onchange="clique()" type="checkbox"  id="{{$parametro->id}}" name="{{$parametro->id}}">
											{{$parametro->titulo}}<br>
										<small style="font-weight:lighter;">{{$parametro->descricao}}</small>
									</label>
									@endif
								@elseif($parametro->tipo=="TEXTO")
									<label>{{$parametro->titulo}}</label>
									<input onchange="clique()" type="text" id="{{$parametro->id}}" value="{{$parametro->valor}}" name="{{$parametro->id}}"><br>
									<small>{{$parametro->descricao}}</small>
								@elseif($parametro->tipo=="NUMERO")
									<label>{{$parametro->titulo}}</label>									
									<input onkeyup="clique()" onchange="clique()" type="number" id="{{$parametro->id}}" value="{{$parametro->valor}}" name="{{$parametro->id}}"><br>
									<small>{{$parametro->descricao}}</small>
								@endif							
							</div>	
						@endif
					@endforeach			
				</div>
		</div>
	</div>
</div>

<div class="col-md-12">
	<div class="box">
		<div class="box-header" style="height: 30px;padding-bottom: 0px;">
      		<p class="title_box">Configurações de Ferramentas</p>
		  <div class="box-tools pull-right">
		  </div>
		</div>
		<div class="box-body">
		  <!-- conteudo -->
				<div class="row">
					@foreach($parametros as $parametro)
						@if($parametro->classificacao=="FERRAMENTAS")
							<div class="col-md-2">							
								@if($parametro->tipo=="CHECKBOX")
									@if($parametro->valor=="S")
									<label>
										<input onchange="clique()" type="checkbox" checked id="{{$parametro->id}}" name="{{$parametro->id}}">
											{{$parametro->titulo}}<br>
										<small style="font-weight:lighter;">{{$parametro->descricao}}</small>
									</label>
									@else
									<label>
										<input onchange="clique()" type="checkbox"  id="{{$parametro->id}}" name="{{$parametro->id}}">
											{{$parametro->titulo}}<br>
										<small style="font-weight:lighter;">{{$parametro->descricao}}</small>
									</label>
									@endif
								@elseif($parametro->tipo=="TEXTO")
									<label>{{$parametro->titulo}}</label>
									<input onchange="clique()" type="text" id="{{$parametro->id}}" value="{{$parametro->valor}}" name="{{$parametro->id}}"><br>
									<small>{{$parametro->descricao}}</small>
								@elseif($parametro->tipo=="NUMERO")
									<label>{{$parametro->titulo}}</label>									
									<input onkeyup="clique()" onchange="clique()" type="number" id="{{$parametro->id}}" value="{{$parametro->valor}}" name="{{$parametro->id}}"><br>
									<small>{{$parametro->descricao}}</small>
								@endif							
							</div>	
						@endif
					@endforeach			
				</div>
		</div>
	</div>
</div>

<div class="col-md-12">
	<button class="btn btn-primary" id="btn_salvar" style="display:none;"><span class="glyphicon glyphicon-ok"></span> Salvar Alterações</button>
</div>


@stop