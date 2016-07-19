<?php $__env->startSection('titulo','Relatórios customizado'); ?>

<?php $__env->startSection('topo'); ?>
<h1>Relatórios
  <small>Customizados</small>
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Início</a></li>
  <li><a><i class="glyphicon glyphicon-equalizer"></i> Relatórios customizados</a></li>
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
	      
	    </div>


	    <div id="form_relatorio" style="display:none;">
	    	<hr>
	    	<div class="row">
		    	<div class="col-md-12">
		    		<form id="formulario_parametros" action="Gerarelatoriocustomizado" method="POST"> 
		    			<input type="text" id="id_relatorio_selecionado" hidden name="id_relatorio_selecionado">	
		    		</form>		    	
		    	</div>
		    </div>
		    <hr>
	    	<div class="row">
		    	<div class="col-md-12">
		    		<div class="pull-left">
		    			<button class="btn btn-warning" onclick="cancelar()">Cancelar</button>
		    		</div>
		    		<div class="pull-right">
		    			<button class="btn btn-primary" onclick="imprimir()">Gerar relatório</button>
		    		</div>
		    	</div>
		    </div>
	    </div>








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
  $.getJSON("selectrelatorioscustomizados/"+filtro, function(data)
  {    
    $("#tabela tr").remove();
    $('#tabela').append(
      '<tr>'+
        '<th>Nome</th>'+ 
        '<th>Descrição</th>'+ 
        '<th></th>' +
      '</tr>');
    $.each(data, function(index,r)
    {      
      html=
      '<tr>'+
          '<td>'+r.nome+'</td>'+
          '<td>'+r.descricao+'</td>'+
          '<td><a title="imprimir relatório" onclick="form_relatorio('+r.id+')"><i class="glyphicon glyphicon-print"></i></a></td>'+
        '</tr>';
      $('#tabela tr:last').after(html);
    });
  });
  $("#tabela").toggle(150);
  $("#loading-div").toggle(150);
}


function form_relatorio(id)
{
	$("#tabela").toggle(150);
	$("#form_relatorio").toggle(150);
	$('#id_relatorio_selecionado').val(id);
	$.getJSON("Formulariorelatoriocustomizado/"+id, function(data)
	{  
		$.each(data, function(forms,form)
    	{ 
    		// alert(form.teste);
    		$('#formulario_parametros').append
    		(
	    		'<div class="'+form.classe+'">'+
		    		'<label>'+form.label+'</label>'+
		    		'<input class="form-control" maxlength='+form.maximo+
		    		' type="'+form.tipo+'" id="'+form.nome+'" name="'+form.nome+'">'+
		    	'</div>'
    		);
    	});
	});	
}

function cancelar()
{
	$("#form_relatorio").toggle(150);	
	$("#tabela").toggle(150);
}
function imprimir()
{
	$("#formulario_parametros").submit();
}

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('templates.principal.principal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>