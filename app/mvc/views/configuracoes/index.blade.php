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
	<button class="btn btn-primary" id="btn_salvar" style="display:none;"><span class="glyphicon glyphicon-ok"></span> Salvar Alterações</button>
</div>



<script src="{{PASTA_PUBLIC}}/template/plugins/jQuery/jquery.min.js"></script>
<script src="{{PASTA_PUBLIC}}/template/bootstrap/js/custom.js"></script>
<script type="text/javascript">
// jQuery( document ).ready(function( $ ) 
// {
	
// });

function clique()
{	
	var cliques = parseInt($('#cliques').val());
	if(cliques==0)
	{
		$('#cliques').val(cliques+1);
		$('#btn_salvar').toggle(150);
	}
}

$('#btn_salvar').on('click', function() 
{
	msg_confirm('<strong>Confirmação</strong>','Deseja salvar as alterações?',"salvar()"); 

}); 

function salvar()
{
	var admin_rede = "{{Auth('admin_rede')}}";
	var action = "{{asset('configuracoes/salvar')}}";
	var form = '<form action="'+action+'" method="post">';

	$.getJSON("{{asset('configuracoes/Buscaparametros')}}", function(data) 
	{
		$.each(data, function(dados,d)
        {      
        	tipo = $('#'+d.id).attr('type');
         	if(tipo=="checkbox")
         	{
         		if( $('#'+d.id).prop("checked") == true)         			
         			form += '<input type="text" value="S" name="'+d.id+'" />';
         		else
         			form += '<input type="text" value="N" name="'+d.id+'" />';
         	}
         	else if((tipo=="number")||(tipo=="text"))
         	{
         			valor = $('#'+d.id).val();
         			form += '<input type="text" value="'+valor+'" name="'+d.id+'" />';
         	}
        });
    form += "</form>";
  	$('body').append(form);
  	$(form).submit(); 
	});	
}

</script>
@stop