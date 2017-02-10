@extends('templates.principal.principal')

@section('titulo','Empresa')

@section('topo')
<h1>Empresa
  <small>Listagem
  @if(Auth('admin_rede')=='S')
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
				            	<input type="text" id="empresas" hidden>
				            	<input type="text" id="qtde_empresas" hidden>
				            	<input type="text" id="cliques" value="0" hidden>
				               <table class="table table-striped" id="tabela"></table>
				            </div>
				          </div>
				        </div>        

		  		</div>
			</div>
		</div>	
	</div>

	<div class="row" >
	    <div class="col-md-6">
	      <button id="btn_salvar" style="display:none;" class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span> Salvar Alteração</button>
	    </div>
	</div>
</div>


@stop
