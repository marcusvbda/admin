<?php $__env->startSection('titulo','Grupos e Acesso'); ?>

<?php $__env->startSection('topo'); ?>
<h1>Grupos de Acesso
  <small>Listagem e cadastro</small>
</h1>
<ol class="breadcrumb">
  <li><a href="<?php echo e(asset('inicio')); ?>"><i class="fa fa-dashboard"></i> Início</a></li>
  <li><a href="<?php echo e(asset('usuarios')); ?>"><i class="glyphicon glyphicon-user"></i> Usuários</a></li>
  <li><a href="<?php echo e(asset('grupos_acesso')); ?>"><i class="glyphicon glyphicon-user"></i> Grupos de Acesso</a></li>
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

     
          <!-- <button title="Gerar Relatório" onclick="imprimir();" class="btn btn-default pull-right"><span class="glyphicon glyphicon-print"></span></button> -->

          <hr>

          <div class="row">
            <div class="box-body table-responsive no-padding">  
              <div class="col-md-12">
                 <table class="table table-striped" id="tabela">
                 <thead>
                    <tr>
                        <th>#</th>
                        <th>Descrição</th>
                        <th class="centro"></th>
                    </tr>
                 </thead>
                 <tbody>
                    <?php foreach($grupos as $grupo): ?>
                    <tr>
                      <td><?php echo e($grupo->id); ?></td>
                      <td><?php echo e($grupo->descricao); ?></td>
                      <td class="centro text-right">

                        <div class="tools text-right">           
                          <?php if(Access("GET","grupos_acesso")): ?>           
                          <a title="Visualizar / Alterar" class="btn btn-primary" href="<?php echo e(asset('usuarios/showgrupoacesso/').$grupo->id); ?>">
                            <i class="fa fa-edit"></i> Visualizar / Alterar
                          </a>
                          <?php endif; ?> 
                          <?php if(Access("DELETE","grupos_acesso")): ?>           
                          <a title="Visualizar / Alterar" class="btn btn-danger"onclick="excluir(<?php echo e($grupo->id); ?>)">
                            <i class="fa fa-trash"></i> Excluir
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

    <?php if(Access("POST","grupos_acesso")): ?>
      <div class="row">
        <div class="col-md-1">
          <a href="<?php echo e(asset('usuarios/create_grupos_acesso')); ?>" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Cadastrar</a>
        </div>
      </div>
    <?php endif; ?>
  </div>


<div id="editar" style="display: none">
  <h1>editar / visualizar</h1>
  <a onclick="step('#editar','#index')" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> voltar</a>

</div>




<?php $__env->stopSection(); ?>
<?php echo $__env->make('templates.principal.principal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<script>
dataTable('#tabela');
function excluir(id)
{
    msg_confirm('Confirmação',"Deseja mesmo excluir esta Grupo de Acesso ?",function()
    {
        send("DELETE","<?php echo e(asset('usuarios/ExcluirGrupoAcesso')); ?>",{id}, function(excluiu)
        {
            if(excluiu)
                msg_stop(":)","Grupo Acesso Excluida com sucesso !!",function()
                    {
                        location.href="<?php echo e(asset('usuarios/grupos_acesso')); ?>";
                    },'success');
            else
                return  msg("Oops","Erro ao excluir Grupo de acesso !!",'error');
        },"<?php echo e(Request::getToken()); ?>");
        
    },false);
}
</script>