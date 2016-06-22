@extends('templates.principal.principal')

@section('titulo','Relatórios customizado')

@section('topo')
<h1>Relatórios
  <small>Customizados</small>
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Início</a></li>
  <li><a><i class="glyphicon glyphicon-equalizer"></i> Relatórios customizados</a></li>
</ol>
@stop


@section('conteudo')
<div class="col-md-12">
	<div class="box">
		<div class="box-header with-border">
		  <h3 class="box-title">

		  </h3>
		  <div class="box-tools pull-right">
		    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"><i class="fa fa-minus"></i></button></div>
		</div>
		<div class="box-body">
		  <!-- conteudo -->
				


		<div id="grid">	
	      <div class="row">
	        <div class="col-md-12">
	          <div class="input-group input-group-sm" >
	            <input type="text" name="table_search" class="form-control pull-right" id="filtro" placeholder="Filtro de busca">
	            <input id="id" hidden>
	            <div class="input-group-btn">
	              <button id="btn-filtro" onclick="buscar()" name="btn-filtro" class="btn btn-default"><i class="fa fa-search"></i></button>
	            </div>
	          </div>
	        </div>
	      </div>

	    <hr>
	      
	      <div class="row">
	        <div class="col-md-12">

	          <div class="box-body table-responsive no-padding">
	          <div id="loading-div" style="width:100%;" class="centro">
	            <img src="{{PASTA_PUBLIC}}/template/img/loading.gif">
	          </div>
	           <table class="table table-striped" id="tabela"></table>
	         </div>
	        </div>
	      </div>
	      <div class="row">
	        <hr>
	        <div class="col-md-12"> 
	        @if(Auth('admin')=="S")
	          <button class="btn btn-primary" onclick="cadastrar()" id="novo_reg"><span class="glyphicon glyphicon-plus"></span>  Cadastar</button>
	        @endif
	        </div>
	      </div>

	    </div>









		</div>
		<div class="box-footer">
			<!-- rodapé -->
		</div>
	</div>
</div>



<script src="{{PASTA_PUBLIC}}/template/plugins/jQuery/jquery.min.js"></script>
<script type="text/javascript">
$("#filtro").keyup(function(event)
{
    if(event.keyCode == 13)
    {
        $("#btn-filtro").click();
    }
});

$( document ).ready(function()
{
    $("#btn-filtro").click();
});

function buscar()
{
  admin = $("#admin").val();
  $("#loading-div").show();
  $("#loading-div").show();  
  $("#tabela").hide();
  filtro = $("#filtro").val();
  $.ajaxSetup({ cache: false });
  $.getJSON("selectrelatorioscustomizados/"+filtro, function(data)
  {    
    $("#tabela tr").remove();
    $('#tabela').append(
      '<tr>'+
        '<th>Descrição</th>'+  
      '</tr>');
    $.each(data, function(index,r)
    {      
      html=
      '<tr>'+
          '<td>'+r.descricao+'</td>'+
        '</tr>';
      $('#tabela tr:last').after(html);
    });
  });
  $("#tabela").toggle(150);
  $("#loading-div").toggle(150);
}
</script>
@stop