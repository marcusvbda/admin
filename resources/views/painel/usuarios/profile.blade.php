@extends('painel.template.painel')
@section('titulo','Profile')
@section('topo')
<section class="content-header">
  <h1>
     <i class="fa fa-user"></i>  Perfil de Usuário
    <small>Profile e edição</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{asset('admin')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="{{asset('admin/users')}}"><i class="fa fa-users"></i> Usuários</a></li>
    <li class="active">Perfil</li>
  </ol>
</section>
@stop
@section('conteudo')
<div class="row">
	<div class="col-md-2" id="div_resumo">
		<div class="box box-primary">
		    <div class="box-header">  
		        <h3 class="box-title">Resumo</h3>  
		    </div>
		  <!-- /.box-header -->
		    <div class="box-body">
		    	<div class="text-center">
					<div id="img_iniciais" style="background-color:{{$usuario->cor_profile->cor}};font-size: 600%;color:#e8e2ff;text-align: center;
					   border-radius: 8%;padding-top: 5%">
				        {{Iniciais($usuario->nome.' '.$usuario->sobrenome)}}
				    </div>  
				</div>
			   <hr>
			   <div class="text-left">
			       <p><strong>Nome : </strong>{{$usuario->nome}} {{$usuario->sobrenome}}</p>
			       <p><strong>Aniversário : </strong>{{dt_format($usuario->dt_nascimento,'d/m')}}</p>
			       <?php $idade = calc_idade($usuario->dt_nascimento); ?>
			       <p><strong>Idade : </strong>{{$idade}} Anos</p>
			       <p><strong>Sexo  : </strong>@if($usuario->sexo=='M') Masculino @else Feminino @endif</p>           	
			   </div>
		    </div>
		</div>
	</div>

	<div class="col-md-10" id="div_campos">
		<div class="box box-primary">
		    <div class="box-header">  
		        <h3 class="box-title">Informações</h3> 
		    </div>
		  <!-- /.box-header -->
		    <div class="box-body">
		    	
		    	<h3> <span id="txt_nome_completo"> {{$usuario->nome}} {{$usuario->sobrenome}}</span> </h3>
			    <ul class="nav nav-pills">
			       <li class="nav-item"> 
			       	<a href="" class="nav-link active" data-target="#info-pills" aria-controls="info-pills" data-toggle="tab" role="tab">Informações</a> 
				 	</li>
			    	<li class="nav-item"> 
			    		<a href="" class="nav-link" data-target="#config-pills" aria-controls="config-pills" data-toggle="tab" role="tab">Configurações</a> 
			    	</li>
			    </ul>

			    <div class="tab-content">
			       <div class="tab-pane fade in active" id="info-pills">
			           <hr>
			           <form id="form_info">
			               <div class="row">
			               	<div class="col-md-6">
			               		<div class="input-group input-group-sm"> 
			               			<span class="input-group-addon">Nome</span> 
			               			<input type="text" class="form-control" name="nome" required id="nome" value="{{$usuario->nome}}" disabled maxlength="150"> 
			               		</div>
			               	</div>
			               	<div class="col-md-6">
			               		<div class="input-group input-group-sm"> 
			               			<span class="input-group-addon">Sobrenome</span> 
			               			<input type="text" class="form-control" name="sobrenome" id="sobrenome"  value="{{$usuario->sobrenome}}" disabled maxlength="200"> 
			               		</div>
			               	</div>                        	
			               </div>
			               <div class="row">
			               	<div class="col-md-12">
			               		<div class="input-group input-group-sm"> 
			               			<span class="input-group-addon">Gostaria de ser chamado de ...</span> 
			               			<input type="text" class="form-control" name="apelido" id="apelido" disabled value="{{$usuario->apelido}}"  maxlength="100"> 
			               		</div>
			               	</div>
			               </div>
			               <div class="row">
			               	<div class="col-md-5">
			               		<div class="input-group input-group-sm"> 
			               			<span class="input-group-addon">Sexo</span> 
			               			<select class="form-control" name="sexo" id="sexo" disabled>
			               				<option value="M" @if($usuario->sexo=="M") selected @endif >Masculino</option>
			               				<option value="F" @if($usuario->sexo=="F") selected @endif >Feminino</option>
			               			</select>
			               		</div>
			               	</div>
			               	<div class="col-md-7">
			               		<div class="input-group input-group-sm"> 
			               			<span class="input-group-addon">Email</span> 
			               			<input type="text" class="form-control" value="{{$usuario->email}}" name="email" id="email" disabled maxlength="250"> 
			               		</div>
			               	</div>
			               </div>
			               <div class="row">		                	
			               	<div class="col-md-4">
			               		<div class="input-group input-group-sm"> 
			               			<span class="input-group-addon">Nascimento</span> 
			               			<input type="date" class="form-control" name="dt_nascimento" id="dt_nascimento" value="{{$usuario->dt_nascimento}}" disabled required="" "> 
			               		</div>
			               	</div>
			               	<div class="col-md-4">
			               		<div class="input-group input-group-sm"> 
			               			<span class="input-group-addon">Função</span> 
			               			<select class="form-control" name="funcao_id" id="funcao"  disabled>
			               				@foreach($funcoes as $f)
			               					<option value="{{$f->id}}" 
			               						@if($f->id==$usuario->funcao_id){{'selected'}}@endif>{{$f->descricao}}
			               					</option>
			               				@endforeach
			               			</select> 
			               		</div>
			               	</div>	
			               	<div class="col-md-4">
			               		<div class="input-group input-group-sm"> 
			               			<span class="input-group-addon">Grupo</span> 
			               			<select class="form-control" name="grupo_acesso_id" id="grupo_acesso" >       				
			               				@foreach($grupos as $g)
			               					<option value="{{$g->id}}"
			               						@if($g->id==$usuario->grupo_acesso_id){{'selected'}}@endif>{{$g->descricao}}
			               					</option>
			               				@endforeach
			               			</select> 
			               		</div>
			               	</div>		                	
			               </div>
			               <input type="submit" class="submit" style="display:none;">	
			           </form>  
			           <hr>

			           <div class="row" id="danger_zone" style="display: none;">
			           		<div class="col-md-12">
								<div class="card card-danger" style="border:1px solid red;">
								    <div class="card-header">
								        <div class="header-block">
								            <p class="title" style="color: white;font-size: 18px;"><strong><i class="fa fa-exclamation-triangle"></i> Zona de Risco
								            <i class="fa fa-exclamation-triangle"></i>
								            </strong></p>
								        </div>
								    </div>
								    <div class="card-block">            
								        <div class="row" id="div_danger_zone_senha">	
								        	<div class="col-md-12">
										        @if(can('usuarios','put'))
										           	@include('painel.usuarios.edit.password', ['id' => $usuario->id])  
										        @endif
										    </div>
								        </div> 

								        <hr style="border-top: 1px solid #d7dde4;">	
								        <div class="row"  id="div_danger_zone_excluir">	
								        	<div class="col-md-12">							        	
										        @if(can('usuarios','delete'))
										        	@include('painel.usuarios.edit.excluir', ['id' => $usuario->id])
										        @endif
										    </div>
										</div>
										<br>

								    </div>
								</div>
							</div>
						</div>

			        </div>
			        <br>
			        <div class="tab-pane fade" id="config-pills">
			           <hr>
			           <form id="form_config" onsubmit="return false">
			           	<div class="row">
			           		<div class="col-md-12">
			                		<div class="input-group input-group-sm"> 
				                		<span class="input-group-addon">Cor de Fundo Profile</span> 
										<select class="form-control" name="cor_profile_id" id="cor_profile" disabled >
					                		@foreach($cores as $cor)
					                			<option value="{{$cor->id}}" 
					                				@if($cor->cor==$usuario->cor_profile){{'selected'}}@endif >{{$cor->descricao}}
					                			</option>
					                		@endforeach
					                	</select>
					                </div>
					            </div>
			           		<div class="col-md-12">
			               		<div class="input-group input-group-sm"> 
			               			<span class="input-group-addon">Fuso Horário</span> 
			               			<select class="form-control" name="timezone" id="timezone" disabled >      				
			               				@foreach(timezone_abbreviations_list()['brst'] as $time)
			               					<option value="{{$time['timezone_id']}}"
			               					@if($time['timezone_id']==$usuario->timezone){{'selected'}}@endif>
			               						{{$time['timezone_id']}}
			               					</option>
			               				@endforeach
			               			</select> 
			               		</div>
			               	</div>
			           	</div>
			           </form>  
			           <hr>			        	
			       </div>	
				</div>


				@if(can('usuarios','put'))
				<div>
					<button type="button" class="btn btn-primary btn-sm" id="btn_editar_info" onclick="editar()">Editar</button>
					<div id="btn_salvar_info" style="display: none;">
						<button type="button" class="btn  btn-success btn-sm" onclick="salvar()">Salvar</button>
						<button type="button" class="btn btn-danger btn-sm" onclick="cancelar()">Cancelar</button>
					</div>
				</div>  
				@endif
		    </div>

			</div>
		</div>

	</div>
</div>

<script type="text/javascript">
$('#nome').focusout(function()
{
	if($('#apelido').val()=="")
		$('#apelido').val($('#nome').val());
});

function editar()
{
	liberar();
}

function liberar()
{
	$("#btn_editar_info").hide();
	$("#btn_salvar_info").hide();
	$("#danger_zone").hide();
	$("#btn_salvar_info").toggle(150);
	$("#danger_zone").toggle(150);
	$("#form_info :input").prop('disabled', false);
	$("#form_config :input").prop('disabled', false); 
	$('#div_resumo').toggle(150);
	$('#div_campos').removeClass('col-md-10');
	$('#div_campos').removeClass('col-md-12');
}

function cancelar()
{
	msg_confirm("Cancelar","As alterações serão perdidas ?",function()
	{
		reload();
	});
}


function salvar()
{
    $('#form_info .submit').click();
    return false;
}


$('#form_info').submit(function(form) 
{
   	msg_confirm("Salvar","Deseja Salvar ?",function()
	{
		var dados        = $('#form_info').FormData();
		var config       = $('#form_config').FormData();
		$.each(config,function(field,value)
		{
			dados[field]=value;
		});
		dados['id']={{$usuario->id}};
		xCode.ajax("post","{{asset('admin/users/edit')}}",dados).then(function(response)
		{
			if(response.success)
	        {
	            msg_stop(':)',response.msg,function()
	            {
	                reload();
	            },'success');
	        }
	        else
	            return msg('Oops',response.msg,"error");
		});  
	},false);
    return false;
});

</script>
@stop