<?php $__env->startSection('titulo','Empresa'); ?>

<?php $__env->startSection('topo'); ?>
<h1>Empresa
  <small>Listagem
  <?php if(Auth('admin_rede')=='S'): ?>
  	 e Configuração
 <?php endif; ?>
 </small>
</h1>
<ol class="breadcrumb">
  <li><a href="<?php echo e(asset('admin/inicio')); ?>"><i class="fa fa-dashboard"></i> Início</a></li>
  <li><a href="<?php echo e(asset('admin/empresa')); ?>"><i class="glyphicon glyphicon-object-align-bottom"></i> Empresa</a></li>
</ol>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('conteudo'); ?>
	<div class="col-md-12">
		<div class="box">
			<div class="box-header with-border">
			    <p class="title_box">Empresas Selecionadas : <strong><?php echo e($nome_rede); ?></strong></p>     

			    	<?php if(Auth('admin_rede')=="S"): ?>
			    	<div class="row">
			          <form method="GET" action="<?php echo e(asset('empresa')); ?>">
			            <div class="col-md-12">
			              <div class="input-group input-group-sm" >
			                  <input type="text" style="text-transform:uppercase" name="filtro" value="<?php echo e($filtro); ?>" class="form-control pull-right" id="filtro" placeholder="Filtro de busca">
			                  <div class="input-group-btn">
			                    <button id="btn-filtro" type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
			                  </div>
			              </div>
			            </div>
			          </form>
			        </div>
			        <br>
			         <?php echo e($qtde_registros); ?> 
			          <?php if($qtde_registros>1): ?>
			            Registros
			          <?php else: ?>  
			            Registro
			          <?php endif; ?>
			          (<?php echo e(number_format($tempo_consulta,5)); ?> segundos)
			        <hr>
			        <?php endif; ?>

			        <div class="row">
			          <div class="box-body table-responsive no-padding">  
			            <div class="col-md-12">
			               <table class="table table-striped" id="tabela">
			               <thead>
			                  <tr>			                  	
			                      <th></th>		
			                      <th>Série</th>			                  
			                      <th>Razão Social</th>
			                      <th>Nome Fantasia</th>
			                      <th>CNPJ</th>
			                      <th>Inscrição Estadual</th>
			                      <th>Inscrição Municipal</th>
			                  </tr>
			               </thead>
			               <tbody>
			                  <?php foreach($empresas_da_rede as $empresa): ?>	
			                  	<?php if(Auth('admin_rede')=="S"): ?>		                    
					                <?php if(isset($empresa->selecionado)): ?>
					                 	<tr style="background-color:#c4ffc4;">
					                  		<td><a href="<?php echo e(asset('empresa/Deschecar_empresa')); ?>/<?php echo e($empresa->id); ?>"><span style="color:green;" class="glyphicon glyphicon-check"></span></a></td>
					                <?php else: ?>
					                 	<tr style="background-color:#ffd1d1;">
					                  		<td><a href="<?php echo e(asset('empresa/Checar_empresa')); ?>/<?php echo e($empresa->id); ?>"><span style="color:red;" class="glyphicon glyphicon-unchecked"></span></a></td>
					                <?php endif; ?>
					            <?php else: ?>
					            	<?php if(isset($empresa->selecionado)): ?>
					                 	<tr style="background-color:#c4ffc4;">
					                  		<td><span style="color:green;" class="glyphicon glyphicon-check"></span></td>
					                <?php else: ?>
					                 	<tr style="background-color:#ffd1d1;">
					                  		<td><span style="color:red;" class="glyphicon glyphicon-unchecked"></span></td>
					                <?php endif; ?>
					            <?php endif; ?>
				                    <td><?php echo e($empresa->serie); ?></td>			                  
				                    <td><?php echo e($empresa->razao); ?></td>
				                    <td><?php echo e($empresa->nome); ?></td>
				                    <td><?php echo e($empresa->CNPJ_CPF); ?></td>
				                    <td><?php echo e($empresa->inscricao_estadual); ?></td>
				                    <td><?php echo e($empresa->inscricao_municipal); ?></td>
				                  </tr>
			                  <?php endforeach; ?>
			               </tbody>
			             </table>
			             <?php echo e($empresas_da_rede->links()); ?>

			            </div>
			          </div>
			        </div>        

	  		</div>
		</div>
	</div>	

<script src="<?php echo e(PASTA_PUBLIC); ?>/template/plugins/jQuery/jquery.min.js"></script>
<script src="<?php echo e(PASTA_PUBLIC); ?>/template/bootstrap/js/custom.js"></script>
<script type="text/javascript">

</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('templates.principal.principal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>