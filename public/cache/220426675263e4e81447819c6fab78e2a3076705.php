<?php $__env->startSection('titulo','Funções'); ?>

<?php $__env->startSection('topo'); ?>
<h1>Funções de funcionários
  <small>Tabela auxiliar</small>
</h1>
<ol class="breadcrumb">
   <li><a href="<?php echo e(asset('')); ?>"><i class="fa fa-dashboard"></i> Início</a></li>
   <li><a href="<?php echo e(asset('usuarios/funcoes')); ?>"><i class="glyphicon glyphicon-road"></i> Funções</a></li>
</ol>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('conteudo'); ?>
<div class="col-md-12">
	<div class="box">
		<div class="box-header with-border">
		  <h3 class="box-title">

		  </h3>
		  <div class="box-tools pull-right">
		    <!-- <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"><i class="fa fa-minus"></i></button></div> -->
		</div>
		<div class="box-body">
		  <!-- conteudo -->

    <div id="alt_insert" style="display:none;">
      <h3 id="titulo_alt" class="centro"></h3>
      <div class="row">
        <div class="col-md-10">
          <label>Descrição</label>
          <input type="text" maxlength="50" class="form-control" id="descricao_alt">
          <input type="text" hidden id="id_alt">
        </div>
        <div class="col-md-1" style="margin-top:25px;">
          <button type="button" onclick="abrefechaform()" class="btn btn-warning">Cancelar</button>
        </div>
        <div class="col-md-1" style="margin-top:25px;">
          <button type="button" id="btn_confirma_alt" onclick="confirmaalteracao()" class="btn btn-primary">Salvar</button>
          <input type="text" value="<?php echo e(Auth('admin')); ?>" id="admin" hidden>
        </div>
      </div>       
    </div>


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
            <img src="<?php echo e(PASTA_PUBLIC); ?>/template/img/loading.gif">
          </div>
           <table class="table table-striped" id="tabela"></table>
         </div>
        </div>
      </div>
      <div class="row">
        <hr>
        <div class="col-md-12"> 
        <?php if(Auth('admin')=="S"): ?>
          <button class="btn btn-primary" onclick="cadastrar()" id="novo_reg"><span class="glyphicon glyphicon-plus"></span>  Cadastar</button>
        <?php endif; ?>
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

<script src="<?php echo e(PASTA_PUBLIC); ?>/template/plugins/jQuery/jquery.min.js"></script>
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
  $.getJSON("../funcoes/selectfuncoes/"+filtro, function(data)
  {    
    $("#tabela tr").remove();
    $('#tabela').append(
      '<tr>'+
        '<th>Descrição</th>'+  
        '<th></span></th>'+  
      '</tr>');
    $.each(data, function(funcoes,funcoes)
    {      
      html=
      '<tr>'+
          '<td>'+funcoes.descricao+'</td>'+
          '<td class="centro pull-right">';
      if((funcoes.usado=='N')&&(admin=='S'))
      {
        html+=
            '<a title="Editar" onclick="alterar('+funcoes.id+')" class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span></a>'+
            '<a title="Excluir" onclick="msgexcluir('+funcoes.id+')" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></a>';
      }
      else
      {
         html+=
            '<a disabled title="Registro em uso, por isso não pode ser alterado" class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span></a>'+
            '<a disabled title="Registro em uso, por isso não pode ser excluido" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></a>';
      }

      html+='</td>'+
        '</tr>';
      $('#tabela tr:last').after(html);
    });
  });
  $("#tabela").toggle(150);
  $("#loading-div").toggle(150);
}

function msgexcluir(id)
{  
  $('#titulo_msg1').html('Confirmação');
  $('#msg_msg1').html('Deseja excluir este registro ?');
  $('#mensagem1').modal('show');   
  $('#id').val(id);
}

function excluir()
{  
  id = $('#id').val();
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
      $('#msg_msg2').html('Registro não excluido pois está em uso.');
    $('#mensagem2').modal('show');     
  });
  $("#btn-filtro").click();
}

function alterar(id)
{
  $.ajaxSetup({ cache: false });
  $.getJSON("../funcoes/encontrafuncao/"+id, function(data)
  {    
    $.each(data, function(funcoes,funcoes)
    {      
      $('#descricao_alt').val(funcoes.descricao);
      $('#id_alt').val(funcoes.id);
    });
  });
  $('#titulo_alt').html('Alterar função');
  $('#alt_insert').toggle(150);
  $('#grid').toggle(150);
}

function cadastrar()
{    
  $('#descricao_alt').val("");
  $('#id_alt').val("");
  $('#titulo_alt').html('Cadastrar função');
  $('#alt_insert').toggle(150);
  $('#grid').toggle(150);
}

$("#descricao_alt").keyup(function(event)
{
    if(event.keyCode == 13)
    {
        $("#btn_confirma_alt").click();
    }
});

function confirmaalteracao()
{
  id =  $('#id_alt').val();
  descricao =  $('#descricao_alt').val();
  $('#alterar-modal').modal('hide'); 
  $.post("../funcoes/alterar_inserir",
  {
    id: id,
    descricao: descricao
  },
  function(resultado)
  {
    $('#titulo_msg2').html('Aviso');
    if(resultado=="ALTERADO")
      $('#msg_msg2').html('Registro alterado');
    if((resultado=="NAOALTERADO"))
      $('#msg_msg2').html('Registro não alterado pois está em uso.');
    if(resultado=="INSERIDO")
      $('#msg_msg2').html('Registro inserido');
    if((resultado=="NAOINSERIDO"))
      $('#msg_msg2').html('Registro não inserido, verifique...');
    $('#mensagem2').modal('show');  
  });
  $("#btn-filtro").click();
  abrefechaform();
}

function abrefechaform()
{
  $('#alt_insert').toggle(150);
  $('#grid').toggle(150);
}

</script>



<!-- Modal -->
<div class="modal fade" id="mensagem1" role="dialog">
  <div class="modal-dialog modal-sm">
  
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title centro">
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
        <h4 class="modal-title centro">
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



<?php $__env->stopSection(); ?>
<?php echo $__env->make('templates.principal.principal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>