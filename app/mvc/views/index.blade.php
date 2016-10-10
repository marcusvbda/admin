@extends('templates.principal.principal')

@section('titulo','Dashboard')

@section('topo')
<h1>Dashboard
  <small>Painel de controle</small>
</h1>
<ol class="breadcrumb">
  <li><i class="fa fa-dashboard"></i> Início</li>
</ol>
@stop



@section('conteudo')


<div class="row" style="display: none;" id="div_importacao_dados">
	<div class="col-md-12">
		<div class="box">
			<div class="box-header">
		      	<p class="title_box">Importação de Dados</p>
		      	<div class="box-tools pull-right">
			    	<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"><i class="fa fa-minus"></i></button>
			    </div>			 
				<div class="box-tools pull-right">
				</div>
			</div>
			<div class="box-body">
			  <!-- conteudo -->
				

		           
		           	<div class="col-md-4" id="importacao_notificacao" style="display:none;">
						<div class="small-box bg-red">
							<div class="inner">
								<h3 id="importacao_qtde">0</h3>
							        <p id="importacao_texto">Arquivo aguardando importação</p>
							</div>
							<a id="importacao_btn_importar" class="small-box-footer">Importar <i class="fa fa-arrow-circle-right"></i></a>
						</div>
					</div>
					<div id="importacao_loading" style="display:none;">
						<div class="col-md-4">
							<div class="small-box">
							    <div class="centro">
							        <p><img src="{{PASTA_PUBLIC}}/template/img/loading.gif"></p>
							    </div>
							    <a class="small-box-footer"> <strong style="color:black;">Importando ...  </strong></a>
							</div>
						</div>
					</div>

					<div class="col-md-4" id="btn_ultima_importacao">
						<div class="small-box bg-green">
							<div class="inner">
								<h3><i class="glyphicon glyphicon-thumbs-up"></i></h3>
							    <p id="data_ultima_importacao">20/09/2016</p>
							</div>
							<a href="{{asset('importacao/Importados')}}" class="small-box-footer"> Ver Importações Com Sucesso <i class="fa fa-arrow-circle-right"></i></a>
						</div>
					</div>

					<div class="col-md-4" id="btn_importacao_erro" style="display:none;">
						<div class="small-box bg-yellow">
							<div class="inner">
								<h3><i class="glyphicon glyphicon-thumbs-down"></i></h3>
							    <p id="qtde_com_erro">0</p>
							</div>
							<a href="{{asset('importacao/erro')}}" class="small-box-footer"> Ver Importações Com Erro <i class="fa fa-arrow-circle-right"></i></a>
						</div>
					</div>






			</div>
			<div class="box-footer">
				<!-- rodapé -->
			</div>
		</div>
	</div>
	
</div>


@if(parametro('lista_de_afazeres')=="S")
	<div class="row" style="display:none;" id="lista_de_afazeres">
		<div class="col-md-5">
			<div class="box">
				<div class="box-header with-border" style="height: 31px;">
				  <p class="title_box">Lista de Afazeres (<span id="porcentagem_afazeres">0%</span>)</p>		
				  <div class="box-tools pull-right">
				    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"><i class="fa fa-minus"></i></button></div>
				</div>
				<div class="box-body">
				  <!-- conteudo -->
						
						<div class="progress sm">
	                      <div class="progress-bar progress-bar-aqua" id="afazeres_porcentagem_progresso" style="width: 0%"></div>
	                    </div>
			           
			            <!-- /.box-header -->
			              <ul class="todo-list ui-sortable" id="afazeres" style="overflow: hidden;"> 
			                
			               
			              </ul>
			            <!-- /.box-body -->
			            <div class="box-footer clearfix no-border">
			              <button onclick="novoafazer();" type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Novo Afazer</button>
			            </div>



				</div>
				<div class="box-footer">
					<!-- rodapé -->
				</div>
			</div>
		</div>

	</div>
@endif



<script src="{{PASTA_PUBLIC}}/template/plugins/jQuery/jquery.min.js"></script>
<script src="{{PASTA_PUBLIC}}/template/bootstrap/js/custom.js"></script>
<script type="text/javascript">
	$( document ).ready(function()
	{
		admin_rede = "{{Auth('admin_rede')}}";
		admin = "{{Auth('admin')}}";

		if((admin_rede=="N")&&(admin=="S"))
	    	procura_arquivos_para_importar();

		lista_de_afazeres = "{{parametro('lista_de_afazeres')}}";
	    if(lista_de_afazeres=="S")
	    	atualizar_afazeres();

	});


	$("#afazer_0").keyup(function(event)
	{
		  if(event.keyCode == 13)
		  {
		    salvar_afazer(0,false);
		  }
	});

	$('#importacao_btn_importar').on('click', function() 
	{
	    $('#titulo_msg1').html('<strong>Confirmação</strong>');
		$('#msg_msg1').html('<strong>Confirma importação ?</strong><br>Este processo pode demorar alguns minutos.');
		$('#btn_confirmar_mensagem1').attr("onclick","importar_arquivo()");		
		$('#mensagem1').modal('show');  
		msg_confirm('<strong>Confirmação</strong>','<strong>Confirma importação ?</strong><br>Este processo pode demorar alguns minutos.',"importar_arquivo()"); 
		$('#id').val(id);
	}); 

	function procura_arquivos_para_importar()
	{
		$('#div_importacao_dados').hide();

		$.post("importacao/qtde_arquivos/importar", function(qtde)
	  	{ 
	  		if(qtde>0)
	  		{
		  		$('#importacao_notificacao').show();
		  		$('#importacao_qtde').html(qtde);
		  		if(qtde>1)
		  			$('#importacao_texto').html("Arquivos aguardando importação");
	  		}		

	  	});
	
	  	$.getJSON("{{asset('importacao/DadosImportacoes')}}", function(dados)
	  	{ 
	  		if(dados.nao_importados>0)	  		
	  		{
		  		if(dados.nao_importados>1)	  			
		  			$('#qtde_com_erro').html(dados.nao_importados+" Arquivos com erro");
		  		else
		  			$('#qtde_com_erro').html(dados.nao_importados+" Arquivo com erro");	 
	  			$('#btn_importacao_erro').show();
		  	} 		

		  	if(dados.importados>0)	  		
	  		{
		  		if(dados.data_ultima_importacao!="0")
	  				$('#data_ultima_importacao').html("Última importação, "+dados.data_ultima_importacao);
	  			else
	  				$('#data_ultima_importacao').html("Não foi possível capturar a data da ultima importação");
	  			$('#btn_ultima_importacao').show();
		  	} 		
	  	});
		$('#div_importacao_dados').toggle(150);
	}

	function importar_arquivo()
	{
		$('#importacao_loading').toggle(150);
		$('#importacao_notificacao').toggle(150);
		$.post("importacao/importar", function(qtde_arquivos_importados)
	  	{ 
	  		if(qtde_arquivos_importados==0)
	  		{
	  			$('#titulo_msg2').html('<strong>ERRO</strong>');
			    $('#msg_msg2').html('Erro ao importar arquivo(s) !');
				$('#btn_voltar_mensagem2').attr("class","btn btn-danger");			    		    	
				$('#btn_voltar_mensagem2').html("Voltar");			    		    	
			    $('#mensagem2').modal('show'); 
			    exit();    	
	  		}
	  		$('#titulo_msg2').html('<strong>Aviso</strong>');
	  		if(qtde_arquivos_importados>1)
		    	$('#msg_msg2').html('Arquivos importados com sucesso !');
		    else
		    	$('#msg_msg2').html('Arquivo importado com sucesso !');
			$('#btn_voltar_mensagem2').attr("class","btn btn-success");			    		    	
			$('#btn_voltar_mensagem2').html("Confirmar");			    		    	
		    $('#mensagem2').modal('show'); 
		    $('#importacao_loading').hide();
			$('#importacao_notificacao').hide();
	    	procura_arquivos_para_importar();	
	  	});
	}

	function atualizar_afazeres()
	{
		$('#lista_de_afazeres').hide();
		$('#afazeres').html(null);
		$.getJSON("{{asset('todolist/Afazeres')}}", function(data)
		{
			$.each(data.afazeres, function(data,d)
		    { 
		    	afazeres = '<li id="li_afazer_'+d.id+'">'+
					         '<div class="row">'+
					         	'<div class="col-md-1">';
				if(d.feito=="S")
					afazeres +='<input  type="checkbox" checked onchange="feito_afazer('+d.id+')" value="">';
				else
					afazeres +='<input  type="checkbox" onchange="feito_afazer('+d.id+')" value="">';					
				    afazeres +='</div>'+
					         '<div class="col-md-9">'+					         
					         	'<input class="form-control" maxlength="150" style="border:none;background-color:#F4F4F4;margin-top: -5;" id="afazer_'+d.id+'" onfocusout="feito_afazer('+d.id+',true)" disabled type="text" value="'+d.descricao+'">'+
					         '</div>'+
					         '<div class="col-md-2 tools">'+
					           '<a onclick="editar_afazer('+d.id+')"><i class="fa fa-edit" style="color:#3C8DBC;" title="Editar"></i></a>'+
					           '<a onclick="excluir_afazer('+d.id+')"<i class="fa fa-trash-o" style="color:#DD4B39;" title="Excluir"></i></a>'+
					        '</div>'+
					        '</div>'+
					       '</li>';
		    	$('#afazeres').append(afazeres);
		    });
		    $('#porcentagem_afazeres').html(data.porcentagem+'%');
		    $('#afazeres_porcentagem_progresso').width(data.porcentagem+'%');
			$('#lista_de_afazeres').toggle(150);
		});
	}
	
	function feito_afazer(id,efetivar=false)
	{
		if(efetivar)
			msg_confirm('<strong>Confirmação</strong>','Confirma afazer?',"efetivar("+id+")"); 
		else
			$.post("{{asset('todolist/feito')}}", { id: id });
		atualizar_porcentagem();
	}

	function editar_afazer(id)
	{
		$('#afazer_'+id).removeAttr('disabled');
		$('#afazer_'+id).focus();
	}

	function efetivar(id)
	{
		texto_descricao = $("#afazer_"+id).val();
		$.post("{{asset('todolist/alterar')}}", { id: id, descricao:texto_descricao });
		atualizar_porcentagem();
		$('#afazer_'+id).prop('disabled','disabled');

	}

	function atualizar_porcentagem()
	{
		$.getJSON("{{asset('todolist/Afazeres')}}", function(data)
		{
			$('#porcentagem_afazeres').html(data.porcentagem+'%');
		    $('#afazeres_porcentagem_progresso').width(data.porcentagem+'%');
		});
	}

	function novoafazer()
	{
		add_nova_linha();		
	}

	function add_nova_linha()
	{
		afazer = '<li id="li_afazer_0">'+
					         '<div class="row">'+
					         	'<div class="col-md-1">'+
									'<input  type="checkbox" onchange="feito_afazer(0)" value="">'+				
					    		'</div>'+
						         '<div class="col-md-9">'+					         
						         	'<input maxlength="150" class="form-control" style="border:none;background-color:#F4F4F4;margin-top: -5;" id="afazer_0" onfocusout="salvar_afazer(0,true)" type="text" value="">'+
						         '</div>'+
					         '<div class="col-md-2 tools">'+
					           '<a onclick="editar_afazer(0)"><i class="fa fa-edit" style="color:#3C8DBC;" title="Editar"></i></a>'+
					           '<a onclick="excluir_afazer(0)"<i class="fa fa-trash-o" style="color:#DD4B39;" title="Excluir"></i></a>'+
					        '</div>'+
					        '</div>'+
					       '</li>';

		$('#afazeres').append(afazer);
		$('#afazer_0').focus();		
	}

	function salvar_afazer(efetivar = false)
	{
		if(efetivar)
		{
			$.post("{{asset('todolist/Novo')}}", { descricao: $('#afazer_0').val() });
			atualizar_afazeres();
		}
		else
			msg_confirm('<strong>Confirmação</strong>','Deseja salvar as afazer?',"salvar_afazer(true)"); 			
	}

	function excluir_afazer(id,efetivar=false)
	{
		if(efetivar)
		{
			$.post("{{asset('todolist/excluir')}}", { id: id });
			$('#li_afazer_'+id).toggle(150);
			atualizar_porcentagem();
		}
		else
			msg_confirm('<strong>Confirmação</strong>','Deseja Excluir afazer?',"excluir_afazer("+id+",true)"); 

	}


</script>
@stop
