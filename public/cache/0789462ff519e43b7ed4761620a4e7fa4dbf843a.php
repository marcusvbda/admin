<?php $__env->startSection('titulo','Tanques'); ?>

<?php $__env->startSection('topo'); ?>
<h1>Tanques
  <small>Volumes e Capacidades</small>
</h1>
<ol class="breadcrumb">
  <li><a href="<?php echo e(asset('')); ?>"><i class="fa fa-dashboard"></i> Início</a></li>
  <li><i class="glyphicon glyphicon-tasks"></i> Tanques</li>
</ol>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('conteudo'); ?>
<div class="col-md-12">
	<div class="box">
		<!-- <div class="box-header">
	      	<p class="title_box"></p>			 
			<div class="box-tools pull-right">
			</div>
		</div> -->
		<div class="box-body">
		  <!-- conteudo -->
				<div class="row">
				<?php foreach($tanques as $tanque): ?>
				  	<div class="col-md-6">
				  		<div class="centro"><h3><b>Tanque <?php echo e($tanque->id); ?></b></h3></div>
				  		<div class="centro"><h5>Capacidade : <?php echo e($tanque->capacidade); ?> Litros</h5></div>
				  		<div class="centro"><h5><b><?php echo e($tanque->nomefantasia); ?></b></h5></div>
						<div id="chartContainer<?php echo e($tanque->sequencia); ?>" style="height: 400px; width: 100%;"></div><br>
						<hr>
						<hr>
					</div>
				<?php endforeach; ?>	
			</div>


		</div>
		<div class="box-footer">
			<!-- rodapé -->
		</div>
	</div>
</div>

<script src="<?php echo e(PASTA_PUBLIC); ?>/template/plugins/jQuery/jquery.min.js"></script>
<script src="<?php echo e(PASTA_PUBLIC); ?>/template/bootstrap/js/custom.js"></script>
<script src="<?php echo e(PASTA_PUBLIC); ?>/template/graficos/graficos.js"></script>
<script type="text/javascript">
	$( document ).ready(function()
	{
	    carrega_graficos();
	});

	function carrega_graficos()
	{
		<?php foreach($tanques as $tanque): ?>
			var tanque = new CanvasJS.Chart("chartContainer<?php echo e($tanque->sequencia); ?>",
			{
				// title:
				// {
				// 	text: "Tanque <?php echo e($tanque->id); ?> (<?php echo e($tanque->nomefantasia); ?>)"
				// },
				animationEnabled: true,
				data: 
				[
					{
						type: "doughnut",
						toolTipContent: "<strong>{y}</strong> Litros",
						showInLegend: true,
					    explodeOnClick: true,
						dataPoints: 
						[
							{y: parseFloat("<?php echo e($tanque->capacidade-$tanque->volumeatual); ?>"),legendText: "Vazio"},
							{y: parseFloat("<?php echo e($tanque->volumeatual); ?>"), indexLabel: "#percent% cheio" , legendText: "Cheio" }
						]
					}
				]
			});
			tanque.render();
		<?php endforeach; ?>
	}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('templates.principal.principal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>