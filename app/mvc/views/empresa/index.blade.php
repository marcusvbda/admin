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



<script src="{{PASTA_PUBLIC}}/template/plugins/jQuery/jquery.min.js"></script>
<script src="{{PASTA_PUBLIC}}/template/bootstrap/js/custom.js"></script>
<script type="text/javascript">
jQuery( document ).ready(function( $ ) 
{
	atualizarTable();	
});

function habilita_salvar()
{
	var cliques = parseInt($('#cliques').val());
	if(cliques==0)
	{
		$('#cliques').val(cliques+1);
		$('#btn_salvar').toggle(150);
	}
}


function atualizarTable()
{
	var qtde_selecionado = 0;
	var nome_rede = "";
	var admin_rede = "{{Auth('admin_rede')}}";
	$.getJSON("empresa/BuscaEmpresas/", function(data) 
	{
        $("#tabela tr").remove();
	    $('#tabela').append(
	       '<tr>'+		                  	
			    '<th></th>'+		
			    '<th>Série</th>'+		                  
			    '<th>Razão Social</th>'+
			    '<th>Nome Fantasia</th>'+
			    '<th>CNPJ</th>'+
			    '<th>Inscrição Estadual</th>'+
			    '<th>Inscrição Municipal</th>'+
			'</tr>');
	    $.each(data, function(index,r)
	    {      
	      html="";
		    if(admin_rede=="S")
		    {
		      	if(r.selecionado=="S")	 
		      	{     		
		          	html +='<tr id="tr_checkbox_'+r.serie+'" style="background-color:#c4ffc4;" onclick="desmarcar('+aspas(r.serie)+');">' +
		      			'<td>'+
		      				'<span id="span_checkbox_'+r.serie+'" style="color:green;" class="glyphicon glyphicon-check"></span></td>';
		      		if(qtde_selecionado==0)		
						$('#empresas').val(r.serie);
					else
						$('#empresas').val($('#empresas').val()+','+r.serie);						

		      		qtde_selecionado++;
		     	}
		      	else
		      		html +='<tr id="tr_checkbox_'+r.serie+'" style="background-color:#ffd1d1;" onclick="marcar('+aspas(r.serie)+');">'+
		      			'<td>'+
		      				'<span id="span_checkbox_'+r.serie+'" style="color:red;" class="glyphicon glyphicon-unchecked"></span></td>';
		    } 
		    else
		    {
		    	if(r.selecionado=="S")	 
		      	{     		
		          	html +='<tr style="background-color:#c4ffc4;">'+
		      			'<td><span style="color:green;" class="glyphicon glyphicon-check"></span></td>';
		      		qtde_selecionado++;
		     	}
		      	else
		      		html +='<tr style="background-color:#ffd1d1;">'+
		      			'<td><span style="color:red;" class="glyphicon glyphicon-unchecked"></span></td>';
		    }  	
	          
	        html+=  '<td>'+r.serie+'</td>'+
	          '<td>'+r.razao+'</td>'+
	          '<td>'+r.nome+'</td>'+
	          '<td>'+r.CNPJ_CPF+'</td>'+
	          '<td>'+r.inscricao_estadual+'</td>'+
	          '<td>'+r.inscricao_municipal+'</td>'+
	        '</tr>';
	   		$('#tabela tr:last').after(html);
	        nome_rede = r.nome_rede;	     
	    });
	    $('#qtde_selecionada').html(qtde_selecionado);
	    $('#nome_rede').html(nome_rede);
	    $('#qtde_empresas').val(qtde_selecionado);
    }).fail(function(d) {
        msg("ERRO","Erro ao consultar empresas");
    });
}

function marcar(serie)
{
	if(($('#empresas').val()!="")&&($('#empresas').val()!=null))
		$('#empresas').val($('#empresas').val()+','+serie);
	else
		$('#empresas').val(id);		
	$("#tr_checkbox_"+serie).attr("onclick","desmarcar("+aspas(serie)+")");	

	$('#qtde_empresas').val(parseInt($('#qtde_empresas').val())+1);

	$("#span_checkbox_"+serie).removeClass("glyphicon glyphicon-unchecked");
    $("#span_checkbox_"+serie).addClass("glyphicon glyphicon-check");
    $("#span_checkbox_"+serie).css("color","green");
    $("#tr_checkbox_"+serie).css("background-color","#c4ffc4");
    habilita_salvar();
}

function desmarcar(serie)
{
	qtde_empresas = parseInt($('#qtde_empresas').val());
	if(qtde_empresas>1)
	{
		var empresas = $('#empresas').val();
		empresas = empresas.replace(serie, "");	
		$('#empresas').val(empresas);
		$("#tr_checkbox_"+serie).attr("onclick","marcar("+aspas(serie)+")");	

		$('#qtde_empresas').val(parseInt(qtde_empresas)-1);


		$("#span_checkbox_"+serie).removeClass("glyphicon glyphicon-check");
	    $("#span_checkbox_"+serie).addClass("glyphicon glyphicon-unchecked");
	    $("#span_checkbox_"+serie).css("color","red");
	    $("#tr_checkbox_"+serie).css("background-color","#ffd1d1");
		habilita_salvar();
	}
	else
	{
		msg('AVISO','É necessário ao menos 1 (uma) empresa selecionada !');
	}
}

function salvar()
{
 	var action = "{{asset('empresa/selecionar_empresas')}}";
  	var form = '<form action="'+action+'" method="post">' +
                '<input type="hidden" value="'+$('#empresas').val()+'" name="empresas_selecionadas" />' +
              '</form>';
  	$('body').append(form);
  	$(form).submit();  
}

$('#btn_salvar').on('click', function() 
{
	msg_confirm('<strong>Confirmação</strong>','Selecionar estas empresas?',"salvar()"); 

}); 

</script>

@stop
