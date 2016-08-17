<?php $__env->startSection('titulo','Clientes'); ?>

<?php $__env->startSection('topo'); ?>
<h1>Clientes
  <small>Listagem</small>
</h1>
<ol class="breadcrumb">
  <li><a href="<?php echo e(asset('admin/inicio')); ?>"><i class="fa fa-dashboard"></i> Início</a></li>
  <li><a href="<?php echo e(asset('admin/clientes')); ?>"><i class="glyphicon glyphicon-user"></i> Clientes</a></li>
</ol>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('conteudo'); ?>
<div class="col-md-12">
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title"></h3>
      <div class="box-tools pull-right">
        <!-- <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"><i class="fa fa-minus"></i></button></div> -->
      </div>

   

        <div class="row">
          <form method="GET" action="<?php echo e(asset('clientes')); ?>">
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

        <div class="row">
          <div class="box-body table-responsive no-padding">  
            <div class="col-md-12">
               <table class="table table-striped" id="tabela">
               <thead>
                  <tr>
                      <th>id</th>
                      <th>Nome</th>
                      <th>Razão Social</th>
                      <th>CNPJ</th>
                  </tr>
               </thead>
               <tbody>
                  <?php foreach($clientes as $cliente): ?>
                  <tr>
                    <td><?php echo e($cliente->numero); ?></td>
                    <td><?php echo e($cliente->nome); ?></td>
                    <td><?php echo e($cliente->razaosocial); ?></td>
                    <td><?php echo e($cliente->cnpj); ?></td>
                  </tr>
                  <?php endforeach; ?>
               </tbody>
             </table>
             <?php echo e($clientes->links()); ?>

            </div>
          </div>
        </div>
      </div>

          
  </div>  
</div>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('templates.principal.principal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>