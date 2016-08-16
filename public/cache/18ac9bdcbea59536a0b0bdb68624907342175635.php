<?php $__env->startSection('titulo','Usuários'); ?>

<?php $__env->startSection('topo'); ?>
<h1>Usuários
  <small>Listagem e cadastro</small>
</h1>
<ol class="breadcrumb">
  <li><a href="<?php echo e(asset('admin/inicio')); ?>"><i class="fa fa-dashboard"></i> Início</a></li>
  <li><a href="<?php echo e(asset('admin/usuarios')); ?>"><i class="glyphicon glyphicon-user"></i> Usuários</a></li>
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
          <form method="GET" action="<?php echo e(asset('usuarios')); ?>">
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

        <hr>

        <div class="row">
          <div class="box-body table-responsive no-padding">  
            <div class="col-md-12">
               <table class="table table-striped" id="tabela">
               <thead>
                  <tr>
                      <th>id</th>
                      <th>Usuário</th>
                      <th>email</th>
                  </tr>
               </thead>
               <tbody>
                  <?php foreach($usuarios as $usuario): ?>
                  <tr>
                    <td><?php echo e($usuario->id); ?></td>
                    <td><?php echo e($usuario->usuario); ?></td>
                    <td><?php echo e($usuario->email); ?></td>
                  </tr>
                  <?php endforeach; ?>
               </tbody>
             </table>
             <?php echo e($usuarios->links()); ?>

            </div>
          </div>
        </div>
      </div>

          
  </div>  
</div>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('templates.principal.principal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>