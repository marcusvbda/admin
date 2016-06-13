@extends('templates.principal.principal')

@section('titulo','Funções')

@section('topo')
<h1>Funções de funcionários
  <small>Tabela auxiliar</small>
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Início</a></li>
  <li class="glyphicon glyphicon-road">Funções</li> 
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
     <!-- /.box-header -->
     

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
  $("#loading-div").show();
  $("#tabela").hide();
  var filtro = document.getElementById("filtro").value;
  $.ajaxSetup({ cache: false });
  $.getJSON("../funcoes/selectfuncoes/"+filtro, function(data)
  {    
    $("#tabela tr").remove();
    $('#tabela').append(
      '<tr>'+
        '<th  style="width:88%;" >Descrição</th>'+  
        '<th class="centro"><span class="glyphicon glyphicon-cog"></span></th>'+  
      '</tr>');
    $.each(data, function(funcoes,funcoes)
    {      
      $('#tabela tr:last').after(
        '<tr>'+
          '<td>'+funcoes.descricao+'</td>'+
          '<td>'+
            '<div class="col-md-6"><a title="Editar" onclick="alterar('+funcoes.id+')" class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span></a></div>'+
            '<div class="col-md-6"><a title="Excluir" onclick="msgexcluir('+funcoes.id+')" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></a></div>'+
          '</td>'+
        '</tr>');
    });
  });
  $("#tabela").show();
  $("#loading-div").hide();
}

function msgexcluir(id)
{  
  $('#titulo_msg1').html('Confirmação');
  $('#msg_msg1').html('Deseja excluir este registro ?');
  $('#mensagem1').modal('show');   
  document.getElementById('id').value=id;
}

function excluir()
{  
  id = document.getElementById('id').value;
  $.post("../funcoes/excluir",
  {
    id: id
  },
  function(resultado)
  {
    $('#titulo_msg2').html('Aviso');
    if(resultado=="SIM")
      $('#msg_msg2').html('Registro excluido');
    else
      $('#msg_msg2').html('Registro não excluido, verifique ...');
    $('#mensagem2').modal('show');     
  });
  $("#btn-filtro").click();
}

function alterar(id)
{
  $('#alterar-modal').modal('show');   
}

</script>



<!-- Modal -->
<div class="modal fade" id="mensagem1" role="dialog">
  <div class="modal-dialog modal-sm">
  
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">
          <div id="titulo_msg1"></div>
        </h4>
      </div>
      <div class="modal-body">
        <p><div id="msg_msg1"></div></p>
      </div>
      <div  class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Não</button>
        <button type="button" onclick="excluir()" data-dismiss="modal" class="btn btn-primary">Sim</button>
      </div>
    </div>    
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="mensagem2" role="dialog">
  <div class="modal-dialog modal-sm">
  
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">
          <div id="titulo_msg2"></div>
        </h4>
      </div>
      <div class="modal-body">
        <p><div id="msg_msg2"></div></p>
      </div>
      <div  class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Voltar</button>
      </div>
    </div>    
  </div>
</div>


<div class="modal fade" id="alterar-modal" role="dialog">
  <div class="modal-dialog modal-sm">
  
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">
          Alteração
        </h4>
      </div>
      <div class="modal-body">
        
      formulario

      </div>
      <div  class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <button type="button"  data-dismiss="modal" class="btn btn-primary">Sim</button>
      </div>
    </div>    
  </div>
</div>


@stop