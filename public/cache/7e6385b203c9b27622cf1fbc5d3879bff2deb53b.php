<?php $__env->startSection('titulo','Caixas'); ?>

<?php $__env->startSection('topo'); ?>
<h1>Caixas
  <small>Consulta de caixas</small>
</h1>
<ol class="breadcrumb">
  <li><a href="<?php echo e(asset('')); ?>"><i class="glyphicon glyphicon-stats"></i> Início</a></li>
  <li><i class="glyphicon glyphicon-indent-left"></i> Caixas</li>
</ol>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('conteudo'); ?>
<div class="col-md-12" id="div_selec_caixa">
	<div class="box">
		<div class="box-header">
	      	<p class="title_box">Caixas</p>			 
			<div class="box-tools pull-right">
			</div>
		</div>
		<div class="box-body">
		  <!-- conteudo -->
		  	<div class="row">
		  		<div class="col-md-12">
			  		<div class="col-md-2 text-left" id="div_periodo_inicio">
			  			<label>Periodo Inicio</label>
			  			<input type="date" class="form-control" id="data_inicio" value="<?php echo e($data_inicio); ?>">
			  		</div>
			  		<div class="col-md-2 text-left" id="div_periodo_fim">
			  			<label>Periodo Fim</label>
			  			<input type="date" class="form-control" id="data_fim" value="<?php echo e($data_fim); ?>">
			  		</div>
			  		<div class="col-md-1">
			  			<button class="btn btn-success" onclick="consultar();" style="margin-top: 26px;"> <span class="glyphicon glyphicon-search"></span></button>
			  		</div>
			  	</div>
		  	</div>
		  	<hr>
		  	<div class="row">
		  		<div class="col-md-12" style="overflow-y: scroll;max-height: 500px;">
					<table class="table table-hover" id="table_cupom">
						<thead>
						  <tr style="background-color: #F4F4F4;border-radius: 100px;">
						    <th>#</th>
						    <th>Ilha</th>
						    <th>Numero</th>
						    <th>Abertura</th>
						    <th>Fechamento</th>
						  </tr>
						</thead>
						<tbody>
							<?php foreach($caixas as $caixa): ?>
							<tr onclick="click_caixa(<?php echo e($caixa->sequencia); ?>)">
				  				<td></td>
				  				<td><?php echo e($caixa->numero_ilha); ?></td>
				  				<td><?php echo e($caixa->id); ?></td>
				  				<td><?php echo e($caixa->dataabertura); ?></td>
				  				<td><?php echo e($caixa->datafechamento); ?></td>
				  			</tr>
				  			<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
				
		</div>
	</div>
</div>


<div class="col-md-4" id="div_visualizacao_caixa" style="display: none;">
	<div class="box">
		<div class="box-header">
	      	<p class="title_box">Caixa - <span id="numero_caixa_titulo"></span></p>		
		</div>
		<div class="box-body">
		 	<div class="row">
		  		<div class="col-md-12 text-left">
					<p><strong>Número :</strong><span id="id_caixa"></span></p>
					<p><strong>Data Abertura :</strong><span id="dt_abertura"></span></p>
					<p><strong>Data Fechamento :</strong><span id="dt_fechamento"></span></p>
					<p><strong>Ilha :</strong><span id="ilha"></span></p>
					<p><strong>Responsável :</strong><span id="responsavel"></span></p>
					<p><strong>Valor Inicial :</strong><span id="vlr_inicial"></span></p>
					<p><strong>Situação :</strong><span id="situacao"></span></p>
				</div>
			</div>
			<hr>
		  	<div class="row">
		  		<div class="col-md-2 text-left">
					<a onclick="voltar_selecao();"><button class="btn btn-warning">Voltar</button></a>
				</div>
				<div class="col-md-2 text-right">
					<a id="btn_visualizar"><button class="btn btn-primary">Visualizar</button></a>
				</div>
			</div>
				
		</div>
	</div>
</div>

<script src="<?php echo e(PASTA_PUBLIC); ?>/template/plugins/jQuery/jquery.min.js"></script>
<script src="<?php echo e(PASTA_PUBLIC); ?>/template/bootstrap/js/custom.js"></script>
<script type="text/javascript">	
$("#data_inicio").keyup(function(event)
{
  	if(event.keyCode == 13)
	    $('#data_fim').focus();
});
$("#data_fim").keyup(function(event)
{
  	if(event.keyCode == 13)
	    consultar();
});
function click_caixa(sequencia)
{
	$('#div_selec_caixa').removeClass("col-md-12");
	$('#div_selec_caixa').addClass("col-md-8"); 	
	$('#div_visualizacao_caixa').hide();
	visualizar_caixa(sequencia);
}

function voltar_selecao()
{
	$('#div_selec_caixa').removeClass("col-md-8");
	$('#div_selec_caixa').addClass("col-md-12"); 
	$('#div_visualizacao_caixa').hide();	
	div_periodo('AUMENTAR');
}

function visualizar_caixa(sequencia)
{
	$.getJSON("<?php echo e(asset('caixas/caixa_especifico')); ?>"+"/"+sequencia, function(caixa)
	{ 
		$('#numero_caixa_titulo').html(caixa.numero);
		$('#id_caixa').html(caixa.numero);
		$('#dt_abertura').html(caixa.dataabertura+" - "+caixa.horaabertura);
		$('#dt_fechamento').html(caixa.datafechamento+" - "+caixa.horafechamento);
		$('#ilha').html(caixa.numero_ilha);
		$('#responsavel').html(caixa.numero_funcionario+" - "+caixa.nome_funcionario);
		$('#vlr_inicial').html("R$ "+caixa.valorinicial.toFixed(2));
		$('#situacao').html(caixa.situacao);
		$('#btn_visualizar').attr("href","<?php echo e(asset('caixas/show')); ?>"+"/"+caixa.id);	
	});
	div_periodo('DIMINUIR');
	$('#div_visualizacao_caixa').toggle(150);	
}

function div_periodo(operacao)
{
	if(operacao=="AUMENTAR")
	{
		$('#div_periodo_inicio').removeClass("col-md-5");		
		$('#div_periodo_fim').removeClass("col-md-5");

		$('#div_periodo_inicio').addClass("col-md-2");
		$('#div_periodo_fim').addClass("col-md-2"); 
	}
	else
	{
		$('#div_periodo_inicio').removeClass("col-md-2");		
		$('#div_periodo_fim').removeClass("col-md-2");

		$('#div_periodo_inicio').addClass("col-md-5");
		$('#div_periodo_fim').addClass("col-md-5");
	}
}

function consultar()
{
	var data_inicio = $('#data_inicio').val();
	var data_fim = $('#data_fim').val();
	var action ="<?php echo e(asset('caixas/index')); ?>";
	var form = $('<form action="'+action+'" method="post">' +
                '<input type="hidden" value="'+data_fim+'" name="data_fim" />' +
                '<input type="hidden" value="'+data_inicio+'" name="data_inicio" />' +
              '</form>');
              $('body').append(form);
              $(form).submit();  
}
</script>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('templates.principal.principal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>