<?php $__env->startSection('titulo','PÁGINA EM BRANCO'); ?>

<?php $__env->startSection('topo'); ?>
<h1>Dashboard
  <small>Painel de controle</small>
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
  <li><a href="#">Pagina em branco</a></li> 
</ol>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('conteudo'); ?>

<div class="box col-md-12">
	<div class="box-header with-border">
	  <h3 class="box-title">

	  </h3>
	  <div class="box-tools pull-right">
	    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"><i class="fa fa-minus"></i></button></div>
	</div>
	<div class="box-body">
	  <!-- conteudo -->
			


	</div>
	<div class="box-footer">
		<!-- rodapé -->
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('templates.principal.principal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>