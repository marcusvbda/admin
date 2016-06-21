<?php $__env->startSection('titulo','Admin'); ?>

<?php $__env->startSection('topo'); ?>
<h1>Dashboard
  <small>Painel de controle</small>
</h1>
<ol class="breadcrumb">
  <li><i class="fa fa-dashboard"></i> Dashboard</li>
</ol>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('conteudo'); ?>

<div class="row">
	<div class="col-md-3">
		<div class="small-box bg-yellow">
		    <div class="inner">
			    <h3><?php echo e($qtde_usuarios_cadastrados); ?></h3>
		        <p>Usuários cadastrados</p>
		    </div>
		    <div class="icon">
		        <i class="ion ion-person-add" style="margin-top: 20px;"></i>
		    </div>
		    <a href="<?php echo e(asset('usuarios')); ?>" class="small-box-footer">Veja mais <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>
</div>


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