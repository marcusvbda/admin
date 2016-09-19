<?php $__env->startSection('titulo','PÁGINA EM BRANCO'); ?>

<?php $__env->startSection('topo'); ?>
<h1>TITULO
  <small>SUBTITULO</small>
</h1>
<ol class="breadcrumb">
  <li><a href="<?php echo e(asset('')); ?>"><i class="fa fa-dashboard"></i> Início</a></li>
  <li><i class="fa fa-dashboard"></i> PAGINA ATUAL</li>
</ol>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('conteudo'); ?>
<div class="col-md-12">
	<div class="box">
		<div class="box-header">
	      	<p class="title_box"></p>			 
			<div class="box-tools pull-right">
			</div>
		</div>
		<div class="box-body">
		  <!-- conteudo -->
				
				


		</div>
		<div class="box-footer">
			<!-- rodapé -->
		</div>
	</div>
</div>
<script src="<?php echo e(PASTA_PUBLIC); ?>/template/dist/demo.js"></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('templates.principal.principal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>