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
			    <p class="title_box">Empresas Selecionadas (<span id="qtde_selecionada">0</span>) : <strong id="nome_rede"></strong></p>     

			    	
			        <div class="row">
			          <div class="box-body table-responsive no-padding">  
			            <div class="col-md-12">
			               <table class="table table-striped" id="tabela"></table>
			            </div>
			          </div>
			        </div>        

	  		</div>
		</div>
	</div>	



<script src="{{PASTA_PUBLIC}}/template/plugins/jQuery/jquery.min.js"></script>
<script src="{{PASTA_PUBLIC}}/template/bootstrap/js/custom.js"></script>
<script type="text/javascript">
jQuery( document ).ready(function( $ ) 
{
	atualizarTable();	
});

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
		          	html +='<tr style="background-color:#c4ffc4;" onclick="desmarcar('+r.id+');">'+
		      			'<td><span style="color:green;" class="glyphicon glyphicon-check"></span></td>';
		      		qtde_selecionado++;
		     	}
		      	else
		      		html +='<tr style="background-color:#ffd1d1;" onclick="marcar('+r.id+');">'+
		      			'<td><span style="color:red;" class="glyphicon glyphicon-unchecked"></span></td>';
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
    }).fail(function(d) {
        msg("ERRO","Erro ao consultar empresas");
    });
}

function marcar(id)
{
	$.getJSON("empresa/Checar_empresa/"+id, function(data){});
	atualizarTable();
}

function desmarcar(id)
{
	if($('#qtde_selecionada').html()==1)
	{
		msg("Aviso","Não é possível selecionar menos de 1 (uma) empresa para esta sessão !");
		return false;
	}
	else
	{
		$.getJSON("empresa/Deschecar_empresa/"+id, function(data){});
		atualizarTable();
	}
}
</script>

@stop