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
  <li><a href="{{asset('admin/inicio')}}"><i class="fa fa-dashboard"></i> Início</a></li>
  <li><a href="{{asset('admin/empresa')}}"><i class="glyphicon glyphicon-object-align-bottom"></i> Empresa</a></li>
</ol>
@stop


@section('conteudo')
	<div class="col-md-12">
		<div class="box">
			<div class="box-header with-border">
			    <p class="title_box">Empresas Selecionadas : <strong>{{$nome_rede}}</strong></p>     

			    	@if(Auth('admin_rede')=="S")
			    	<div class="row">
			          <form method="GET" action="{{asset('empresa')}}">
			            <div class="col-md-12">
			              <div class="input-group input-group-sm" >
			                  <input type="text" style="text-transform:uppercase" name="filtro" value="{{$filtro}}" class="form-control pull-right" id="filtro" placeholder="Filtro de busca">
			                  <div class="input-group-btn">
			                    <button id="btn-filtro" type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
			                  </div>
			              </div>
			            </div>
			          </form>
			        </div>
			        <br>
			         {{$qtde_registros}} 
			          @if($qtde_registros>1)
			            Registros
			          @else  
			            Registro
			          @endif
			          ({{number_format($tempo_consulta,5)}} segundos)
			        <hr>
			        @endif

			        <div class="row">
			          <div class="box-body table-responsive no-padding">  
			            <div class="col-md-12">
			               <table class="table table-striped" id="tabela">
			               <thead>
			                  <tr>			                  	
			                      <th></th>		
			                      <th>Série</th>			                  
			                      <th>Razão Social</th>
			                      <th>Nome Fantasia</th>
			                      <th>CNPJ</th>
			                      <th>Inscrição Estadual</th>
			                      <th>Inscrição Municipal</th>
			                  </tr>
			               </thead>
			               <tbody>
			                  @foreach($empresas_da_rede as $empresa)	
			                  	@if(Auth('admin_rede')=="S")		                    
					                @if(isset($empresa->selecionado))
					                 	<tr style="background-color:#c4ffc4;">
					                  		<td><a href="{{asset('empresa/Deschecar_empresa')}}/{{$empresa->id}}"><span style="color:green;" class="glyphicon glyphicon-check"></span></a></td>
					                @else
					                 	<tr style="background-color:#ffd1d1;">
					                  		<td><a href="{{asset('empresa/Checar_empresa')}}/{{$empresa->id}}"><span style="color:red;" class="glyphicon glyphicon-unchecked"></span></a></td>
					                @endif
					            @else
					            	@if(isset($empresa->selecionado))
					                 	<tr style="background-color:#c4ffc4;">
					                  		<td><span style="color:green;" class="glyphicon glyphicon-check"></span></td>
					                @else
					                 	<tr style="background-color:#ffd1d1;">
					                  		<td><span style="color:red;" class="glyphicon glyphicon-unchecked"></span></td>
					                @endif
					            @endif
				                    <td>{{$empresa->serie}}</td>			                  
				                    <td>{{$empresa->razao}}</td>
				                    <td>{{$empresa->nome}}</td>
				                    <td>{{$empresa->CNPJ_CPF}}</td>
				                    <td>{{$empresa->inscricao_estadual}}</td>
				                    <td>{{$empresa->inscricao_municipal}}</td>
				                  </tr>
			                  @endforeach
			               </tbody>
			             </table>
			             {{$empresas_da_rede->links()}}
			            </div>
			          </div>
			        </div>        

	  		</div>
		</div>
	</div>	

<script src="{{PASTA_PUBLIC}}/template/plugins/jQuery/jquery.min.js"></script>
<script src="{{PASTA_PUBLIC}}/template/bootstrap/js/custom.js"></script>
<script type="text/javascript">

</script>

@stop