<?php $__env->startSection('titulo','PÁGINA EM BRANCO'); ?>

<?php $__env->startSection('topo'); ?>
<h1>Visualização 
  <small>de Caixa <strong>N° <?php echo e($caixa->id); ?></strong></small>
</h1>
<ol class="breadcrumb">
  <li><a href="<?php echo e(asset('')); ?>"><i class="glyphicon glyphicon-stats"></i> Início</a></li>
  <li><a href="<?php echo e(asset('caixas')); ?>"><i class="glyphicon glyphicon-indent-left"></i> Caixas</a></li>
  <li><i class="glyphicon glyphicon-indent-left"></i> Caixa - <?php echo e($caixa->id); ?></li>
</ol>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('conteudo'); ?>
<div class="col-md-12">
	<div class="box">
		<div class="box-header" style="height: 10px">
	      	<p class="title_box">Resumo</p>		
		</div>
		<div class="box-body"> 
		  <!-- conteudo -->
				
				<div class="row">
					<div class="col-md-2">
						<label>N° Caixa</label>
						<input type="text" class="form-control" value="<?php echo e($caixa->numero); ?>" readonly>
					</div>
					<div class="col-md-4">
						<label>Ilha</label>
						<input type="text" class="form-control" value="<?php echo e($caixa->numero_ilha); ?> - <?php echo e($caixa->nome_ilha); ?>" readonly>
					</div>	
					<div class="col-md-6">
						<label>Funcionário</label>
						<input type="text" class="form-control" value="<?php echo e($caixa->numero_funcionario); ?> - <?php echo e($caixa->nome_funcionario); ?>" readonly>
					</div>				
				</div>

				<div class="row">
					<div class="col-md-3">
						<label>Abertura</label>
						<input type="text" class="form-control" value="<?php echo e(dia_semana($caixa->dataabertura)); ?> , <?php echo e($caixa->dataabertura_formatada); ?> , <?php echo e($caixa->horaabertura); ?>" readonly>
					</div>
					<div class="col-md-3">
						<label>Fechamento</label>
						<input type="text" class="form-control" value="<?php echo e(dia_semana($caixa->dataabertura)); ?> , <?php echo e($caixa->datafechamento_formatada); ?>, <?php echo e($caixa->horafechamento); ?>" readonly>
					</div>
					<div class="col-md-3">
						<label>Permanencia</label>
						<input type="text" class="form-control" value="<?php echo e($dias_permanencia); ?> Dia(s), <?php echo e($horas_permanencia); ?> Hora(s)" readonly>
					</div>
					<div class="col-md-3">
						<label>Situação</label>
							<input type="text" class="form-control" value="<?php echo e($caixa->situacao); ?>" readonly>
					</div>
				</div>
				<hr>

		</div>
	</div>
</div>

<div class="col-md-6">
	<div class="box">
		<div class="box-header" style="height: 10px">
	      	<p class="title_box">Movimento</p>		
		</div>
		<div class="box-body"> 
		  <!-- conteudo -->
		  	<div class="row">
		  		<div class="col-md-3 text-center">
		  			<label>Cigarros</label>
					<div id="circulo_porcentagem_cervejas" style="padding-left: 12px;padding-right: 12px;" data-percent="1"></div>
				</div>
				<div class="col-md-3 text-center">
		  			<label>Cervejas</label>
					<div id="circulo_porcentagem_cigarros" style="padding-left: 12px;padding-right: 12px;" data-percent="6"></div>
				</div>
				<div class="col-md-3 text-center">
		  			<label>Lubrificantes</label>
					<div id="circulo_porcentagem_lubrificantes" style="padding-left: 12px;padding-right: 12px;" data-percent="15"></div>
				</div>
				<div class="col-md-3 text-center">
		  			<label>Combustiveis</label>
					<div id="circulo_porcentagem_combustiveis" style="padding-left: 12px;padding-right: 12px;" data-percent="78"></div>
				</div>
			</div>

					

			<hr>				
		</div>
	</div>
</div>


<script src="<?php echo e(PASTA_PUBLIC); ?>/template/plugins/jQuery/jquery.min.js"></script>
<script src="<?php echo e(PASTA_PUBLIC); ?>/template/bootstrap/js/custom.js"></script>
<script src="<?php echo e(PASTA_PUBLIC); ?>/template/bootstrap/js/percent_circle.js"></script>
<script type="text/javascript">		
$('#circulo_porcentagem_cervejas').percentcircle();
$('#circulo_porcentagem_cigarros').percentcircle();
$('#circulo_porcentagem_lubrificantes').percentcircle();
$('#circulo_porcentagem_combustiveis').percentcircle();
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('templates.principal.principal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>