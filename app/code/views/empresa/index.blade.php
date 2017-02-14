@extends('templates.principal.principal')

@section('titulo','Empresa')

@section('topo')
<h1>Empresa
  <small>Listagem
  @if(Access('PUT','config_redes'))
  	 e Configuração
 @endif
 </small>
</h1>
<ol class="breadcrumb">
  <li><a href="{{asset('inicio')}}"><i class="fa fa-dashboard"></i> Início</a></li>
  <li><a href="{{asset('empresa')}}"><i class="glyphicon glyphicon-object-align-bottom"></i> Empresa</a></li>
</ol>
@stop


@section('conteudo')
<div id="selec_empresas">
	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="box-header with-border">
				    <p class="title_box">Empresas Selecionadas (<span id="qtde_selecionada">0</span>) : <strong id="nome_rede"></strong></p>     

				    	
				        <div class="row">
				          <div class="box-body table-responsive no-padding">  
				            <div class="col-md-12">
					            <table class="table table-striped" id="tabela">
					            		<table class="table table-striped">
							            <thead>
							               <tr>
							                   <th></th>
							                   <th>Serie</th>
							                   <th>Razão</th>
							                   <th>Nome</th>
							               </tr>
							            </thead>
							            <tbody>
								            <form id="form_empresas"> 
								            @foreach($empresas as $emp)
								               <tr onclick="seleciona('{{$emp->serie}}')" id="tr_{{$emp->serie}}"
								               	@if(in_array($emp->serie,Auth('empresa_selecionada'))) 
								               		style="background-color:#d8ffd8;" 
								               	@else							               		
								               		style="background-color:#fad7d7;" 
								               	@endif
								               	>
								                 <td>
									                @if(in_array($emp->serie,Auth('empresa_selecionada'))) 
									                	<span class="glyphicon glyphicon-check" id="spam_{{$emp->serie}}"></span>	
									                	<input type="text" id="check_{{$emp->serie}}" name="check_{{$emp->serie}}" value="S" style="display: none">
									                @else							               		
									               		<span class="glyphicon glyphicon-unchecked" id="spam_{{$emp->serie}}" ></span>	
									                	<input type="text" id="check_{{$emp->serie}}" name="check_{{$emp->serie}}" value="N" style="display: none">	
									               	@endif
								                 </td>
								                 <td>{{$emp->serie}}</td>
								                 <td>{{$emp->razao}}</td>
								                 <td>{{$emp->nome}}</td>						                  
								               </tr>
							               @endforeach
							               </form>
							            </tbody>
							          </table>

					            </table>
				            </div>
				          </div>
				        </div>        

		  		</div>
			</div>
		</div>	
	</div>

	<div class="row" >
	    <div class="col-md-6">
	      <button id="btn_salvar"  class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-ok"></span> Salvar Alteração</button>
	    </div>
	</div>
</div>


@stop
