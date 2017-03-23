@extends('painel.template.painel')
@section('titulo','Novo Usuário')
@section('topo')
<section class="content-header">
  <h1>
	<i class="fa  fa-user"></i>
    Usuários
    <small>Cadastro</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{asset('admin')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="{{asset('admin/users')}}"><i class="fa fa-users"></i> Usuários</a></li>
    <li class="active"> Perfil</li>
  </ol>
</section>
@stop
@section('conteudo')
<div class="col-md-2" id="div_resumo">
	<div class="box box-primary">
	    <div class="box-header">
	        <h3 class="box-title">Resumo</h3>    
	    </div>
	  <!-- /.box-header -->
	    <div class="box-body">
			<br>
			<div class="text-center">
				<div id="img_iniciais" style="background-color:#4f5f6f;font-size: 600%;color:#e8e2ff;text-align: center;
				   border-radius: 8%;padding-top: 5%">
			        <span id="txt_inicias">__</span>
			    </div>  
			</div>
		    <hr>
		    <div class="text-left">
		        <p><strong>Usuários : </strong><span id="txt_nome"></span></p>
		        <p><strong>Aniversário : </strong><span id="txt_aniversario"></span></p>
		        <p><strong>Idade : </strong><span id="txt_idade"></span></p>
		        <p><strong>Sexo : </strong><span id="txt_sexo"></span></p>           	
		    </div>
		</div>
	</div>
</div>

<div class="col-md-10">
	<div class="box box-primary">
	    <div class="box-header">
	        <h3 class="box-title">Informações</h3>    
	    </div>
	  <!-- /.box-header -->
	    <div class="box-body">
		    	



	    	<br>
	        <h3> <span id="txt_nome_2"> </h3>
	        <ul class="nav nav-pills">
	            <li class="nav-item"> <a href="" class="nav-link active" data-target="#info-pills" aria-controls="info-pills" data-toggle="tab" role="tab">Informações</a> </li>
	            <li class="nav-item"> <a href="" class="nav-link" data-target="#config-pills" aria-controls="config-pills" data-toggle="tab" role="tab">Configurações</a> </li>
	        </ul>
	        <div class="tab-content">
	            <div class="tab-pane fade in active" id="info-pills">
	                <hr>

	                <form id="form_info">
		                <div class="row">
		                	<div class="col-md-6">
		                		<div class="input-group input-group-sm"> 
		                			<span class="input-group-addon">Nome</span> 
		                			<input type="text" class="form-control" name="nome" id="nome" value="" required maxlength="150"> 
		                		</div>
		                	</div>
		                	<div class="col-md-6">
		                		<div class="input-group input-group-sm"> 
		                			<span class="input-group-addon">Sobrenome</span> 
		                			<input type="text" class="form-control" name="sobrenome" id="sobrenome" value=""  maxlength="200"> 
		                		</div>
		                	</div>                        	
		                </div>
		                <div class="row">
		                	<div class="col-md-12">
		                		<div class="input-group input-group-sm"> 
		                			<span class="input-group-addon">Gostaria de ser chamado de  ...</span> 
		                			<input type="text" class="form-control" name="apelido" id="apelido" value=""  maxlength="100"> 
		                		</div>
		                	</div>
		                </div>
		                <div class="row">		                	
		                	<div class="col-md-3">
		                		<div class="input-group input-group-sm"> 
		                			<span class="input-group-addon">Sexo</span> 
		                			<select class="form-control" name="sexo" id="sexo">
		                				<option value="M" >Masculino</option>
		                				<option value="F" >Feminino</option>
		                			</select>
		                		</div>
		                	</div>
		                	<div class="col-md-9">
		                		<div class="input-group input-group-sm"> 
		                			<span class="input-group-addon">Email</span> 
		                			<input type="text" class="form-control" value="" id="email" name="email" required=""  maxlength="250"> 
		                		</div>
		                	</div>
		                </div>
		                <div class="row">		                	
		                	<div class="col-md-4">
		                		<div class="input-group input-group-sm"> 
		                			<span class="input-group-addon">Nascimento</span> 
		                			<input type="date" class="form-control" name="dt_nascimento" id="dt_nascimento" required=""> 
		                		</div>
		                	</div>
		                	<div class="col-md-4">
		                		<div class="input-group input-group-sm"> 
		                			<span class="input-group-addon">Função</span> 
		                			<select class="form-control" name="funcao_id" id="funcao" >            				
		                				@foreach($funcoes as $f)
		                					<option value="{{$f->id}}"> 
		                						{{$f->descricao}}
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
		                					<option value="{{$g->id}}"> 
		                						{{$g->descricao}}
		                					</option>
		                				@endforeach
		                			</select> 
		                		</div>
		                	</div>		                	
		                </div>
		                <input type="submit" class="submit" style="display:none;">		                           
		            </form>  

					<hr style="border-top: 1px solid #d7dde4;">						            
		            	
		            <div class="row">
		            	<div class="col-md-6">
		            		<div class="input-group input-group-sm"> 
		            			<span class="input-group-addon">Senha</span> 
		            			<input type="password" class="form-control" name="senha" id="senha" value=""  maxlength="15"> 
		            		</div>
		            	</div>  
		            	<div class="col-md-6">
		            		<div class="input-group input-group-sm"> 
		            			<span class="input-group-addon">Confirme a senha</span> 
		            			<input type="password" class="form-control" name="confirmacao" id="confirmacao" value=""  maxlength="15"> 
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
			                		<span class="input-group-addon">Cor de Fundo</span> 
									<select class="form-control" name="cor_profile_id" id="cor_profile"  >
				                		@foreach($cores as $cor)
				                			<option value="{{$cor->id}}"> 
				                				{{$cor->descricao}}
				                			</option>
				                		@endforeach
				                	</select>
				                </div>
				            </div>				           
	                	</div>
	                	<div class="row">
	                		<div class="col-md-12">
		                		<div class="input-group input-group-sm"> 
		                			<span class="input-group-addon">Fuso Horário</span> 
		                			<select class="form-control" name="timezone" id="timezone" >      				
		                				@foreach(timezone_abbreviations_list()['brst'] as $time)
		                					<option value="{{$time['timezone_id']}}"> 
		                						{{$time['timezone_id']}}
		                					</option>
		                				@endforeach
		                			</select> 
		                		</div>
		                	</div>
	                	</div>
		            </form> 			        	
			    	<br>
	            </div>
	            
	            <br>
		    </div>
		<button type="button" class="btn btn-primary btn-sm" id="btn_salvar" ><i class="fa fa-plus-circle"></i> Salvar</button>


	</div>
	</div>
	</div>
</div>



<script type="text/javascript">
$('#btn_salvar').click(function()
{
    $('#form_info .submit').click();
    return false;
});


$('#form_info').submit(function(form) 
{
   	msg_confirm("Confirmação","Deseja finalizar o cadastro deste usuário ?",function()
	{
		if(!confirmaSenha())
			return msg("Oops","Senhas não conferem !!","error");
	
		var dados        = $('#form_info').FormData();
		var config       = $('#form_config').FormData();
		$.each(config,function(field,value)
		{
			dados[field]=value;
		});
		dados['senha']=$('#senha').val();
		xCode.ajax('post',"{{asset('admin/users/store')}}",dados).then(function(response)
		{
			if(response.success)
		    {
		        msg_stop(':)',response.msg,function()
		        {
		           load("{{asset('admin/users/show')}}"+"/"+response.id);
		        },'success');
		    }
		    else
		      	return msg('Oops',response.msg,"error");
		});	
	});
    return false;
});
function confirmaSenha()
{
	var senha       = $('#senha').val();
	var confirmacao = $('#confirmacao').val();
	if(senha==confirmacao)
	{
		$('#confirmacao').removeClass( "error" );		
		$('#senha').removeClass( "error" );	
		return true;
	}
	else
	{
		$('#confirmacao').addClass( "error" );		
		$('#senha').addClass( "error" );	
		return false;
	}
}

$('#nome').focusout(function()
{
	if($('#apelido').val()=="")
		$('#apelido').val($('#nome').val());
});

$('#nome').keyup(function()
{
	var nome = $('#nome').val();
	var sobrenome = $('#sobrenome').val();
	var nome_completo = $('#nome').val()+' '+$('#sobrenome').val();	
	$('#txt_nome').html(nome_completo);
	if(nome=="")
		$('#img_iniciais').html('__');
	else
	{
		xCode.ajax('post',"{{asset('admin/users/iniciais')}}",{nome:nome_completo}).then(function(iniciais)
		{
			$('#img_iniciais').html(iniciais);
		});
	}
});

$('#sobrenome').keyup(function()
{
	var nome = $('#nome').val();
	var sobrenome = $('#sobrenome').val();
	var nome_completo = $('#nome').val()+' '+$('#sobrenome').val();	
	$('#txt_nome').html(nome_completo);
	if(nome=="")
		$('#img_iniciais').html('__');
	else
	{
		xCode.ajax('post',"{{asset('admin/users/iniciais')}}",{nome:nome_completo}).then(function(iniciais)
		{
			$('#img_iniciais').html(iniciais);
		});
	}
});
$('#sexo').change(function()
{
	var sexo = $("#sexo option[value='"+$('#sexo').val()+"']").text();
	$('#txt_sexo').html(sexo);
});

$('#usuario').keyup(function()
{
	var usuario = $('#usuario').val();
	if(usuario =="")		
		$('#txt_usuario').html('');	
	else
		$('#txt_usuario').html('@'+usuario);			
});

$('#dt_nascimento').change(function()
{
	var dt_nascimento = $('#dt_nascimento').val();
	var mes = dt_nascimento.substring(5, 7);
	var dia = dt_nascimento.substring(8, 10);
	var ano = dt_nascimento.substring(0, 4);
	$('#txt_aniversario').html(dia+'/'+mes);
	xCode.ajax('post',"{{asset('admin/users/calculaidade')}}",{dt_nascimento:dt_nascimento}).then(function(idade)
	{
		$('#txt_idade').html(idade);
	});
});

$('#cor_profile').change(function()
{
	var cor_profile = $("#cor_profile option[value='"+$('#cor_profile').val()+"']").text();
	$('#img_iniciais').css("background-color",cor_profile);
});
</script>
@stop

