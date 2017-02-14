<?php $__env->startSection('titulo','Usuários'); ?>

<?php $__env->startSection('topo'); ?>
<h1>Usuários
  <small>Listagem e cadastro</small>
</h1>
<ol class="breadcrumb">
  <li><a href="<?php echo e(asset('inicio')); ?>"><i class="fa fa-dashboard"></i> Início</a></li>
  <li><a href="<?php echo e(asset('usuarios')); ?>"><i class="glyphicon glyphicon-user"></i> Usuários</a></li>
</ol>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('conteudo'); ?>
<div class="col-md-12">
  <div class="box">
    <div class="box-header with-border">
      <p class="title_box"></p>
      <div class="box-tools pull-right">
        <!-- <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"><i class="fa fa-minus"></i></button></div> -->
      </div>

   
        <!-- <button title="Gerar Relatório" onclick="imprimir();" class="btn btn-default btn-sm pull-right"><span class="glyphicon glyphicon-print"></span></button> -->

        <hr>

        <div class="row">
          <div class="box-body table-responsive no-padding">  
            <div class="col-md-12">
               <table class="table table-striped" id="tabela">
               <thead>
                  <tr>
                      <th>Usuário</th>
                      <th>email</th>
                      <th></th>
                  </tr>
               </thead>
               <tbody>
                  <?php foreach($usuarios as $usuario): ?>
                  <tr>
                    <td><?php echo e($usuario->usuario); ?></td>
                    <td><?php echo e($usuario->email); ?></td>
                    <td class="centro">

                      <div class="tools text-right">           
                        <?php if(Access("PUT","usuarios")): ?>           
                        <a title="Visualizar / Alterar" href="<?php echo e(asset('usuarios/show/').$usuario->id); ?>" class="btn btn-primary btn-sm btn-sm">
                          <i class="fa fa-edit" ></i> Visualizar / Alterar
                        </a>
                        <?php endif; ?> 
                      </div>

                    </td>
                  </tr>
                  <?php endforeach; ?>
               </tbody>
             </table>
            </div>
          </div>
        </div>        
      </div>          
  </div>  

  <?php if(Access("POST","usuarios")): ?>
    <div class="row">
      <div class="col-md-1">
        <a href="<?php echo e(asset('usuarios/novo')); ?>" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-plus"></span> Cadastrar</a>
      </div>
    </div>
  <?php endif; ?>
</div>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('templates.principal.principal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<script>


dataTable('#tabela');


function excluir(id)
{
  msg_confirm('Confirmação',"Deseja mesmo excluir ?",function()
  {   
    send("DELETE","<?php echo e(asset('usuarios/excluir')); ?>",{id}, function(excluiu)
    {
        if(excluiu)
            msg_stop(":)","Excluido com sucesso !!",function()
            {
                REFRESH();
            },'success');
        else
            return  msg("Oops","Erro ao excluir !!",'error');
    },"<?php echo e(Request::getToken()); ?>");
        
  },false);
  
}


</script>