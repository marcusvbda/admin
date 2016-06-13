<?php $__env->startSection('titulo','Funções'); ?>

<?php $__env->startSection('topo'); ?>
<h1>Funções de funcionários
  <small>Tabela auxiliar</small>
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Início</a></li>
  <li class="glyphicon glyphicon-road">Funções</li> 
</ol>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('conteudo'); ?>
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
  var filtro = document.getElementById("filtro").value;
  $.ajaxSetup({ cache: false });
  $.getJSON("../funcoes/selectfuncoes/"+filtro, function(data)
  {
    $("#tabela tr").remove();
    $('#tabela').append('<tr> <th>Código</th>  <th>Descrição</th>  </tr>');
    $.each(data, function(funcoes,funcoes)
    {      
      $('#tabela tr:last').after('<tr> <td>'+funcoes.id+'</td>   <td>'+funcoes.descricao+'</td>  </tr>');
    });
  });
}



</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('templates.principal.principal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>