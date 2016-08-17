<?php $__env->startSection('titulo','Usuários'); ?>

<?php $__env->startSection('topo'); ?>
<h1>Usuários
  <small>Consulta / Alteração</small>
</h1>
<ol class="breadcrumb">
  <li><a href="<?php echo e(asset('admin/inicio')); ?>"><i class="fa fa-dashboard"></i> Início</a></li>
  <li><a href="<?php echo e(asset('admin/usuarios')); ?>"><i class="glyphicon glyphicon-user"></i> Usuários</a></li>
  <li><a><i class="glyphicon glyphicon-search"></i> Consulta / Alteração</a></li>
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

      <form action="<?php echo e(asset('usuarios/editar')); ?>" method="POST" id="formulario">
        <div class="row" >
          <div class="col-md-6">
            <label>Usuário</label>
            <input type="number" name="id" id="id" value="<?php echo e($usuario->id); ?>" hidden>
            <input class="form-control" required type="text" maxlength="50" placeholder="Usuário" name="usuario" id="usuario" disabled value="<?php echo e($usuario->usuario); ?>">
          </div>
          <div class="col-md-6">
            <label>Email</label>
            <input class="form-control" required type="email" maxlength="200" placeholder="email" name="email" id="email" disabled value="<?php echo e($usuario->email); ?>">
          </div>          
        </div>
        <div class="row">
          <div class="col-md-1">
            <label>Administrador</label>
              <input type="text" value="<?php echo e($usuario->admin); ?>" hidden name="admin" id="admin">
              <div class="slideThree">  
                <?php if($usuario->admin=='S'): ?>
                  <input type="checkbox" disabled checked value="<?php echo e($usuario->admin); ?>" id="admin_checkbox" name="admin_checkbox"/>
                <?php else: ?>
                  <input type="checkbox" disabled value="<?php echo e($usuario->admin); ?>" id="admin_checkbox" name="admin_checkbox"/>
                <?php endif; ?>
                <label for="admin_checkbox"></label>
              </div>
          </div>
        </div>       
      </form>

      <hr>

      <div class="row">   
        <div class="col-md-3">
          <button id="btn_alterar" class="btn btn-warning"><span class="glyphicon glyphicon-pencil"></span> Alterar</button>     
        </div>  
        <div class="col-md-12 centro">    
            <button id="btn_cancelar" style="display:none" class="btn btn-danger"><span class="glyphicon glyphicon-minus"></span> Cancelar</button>
             <button id="btn_confirmar" style="display:none" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span> Confirmar</button>
        </div> 
      </div>

      <hr>

      <div class="row" style="display:none;" id="div_risco">
        <div title="Area de risco, cuidado" class="col-md-12" style="margin-top:100px;border:solid red 0.5px;padding:30px;border-radius:8px;
        background-color:#ffecea;">
            <div class="col-md-2 pull-right">
              <button class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Excluir</button>
            </div>
        </div>
         
      </div>

    </div>      
  </div>  
</div>


<script src="<?php echo e(PASTA_PUBLIC); ?>/template/plugins/jQuery/jquery.min.js"></script>
<script type="text/javascript">
$('#btn_alterar').on('click', function() 
{
  trocabotoes();
  desabilitar_inputs(false);
}); 

$('#btn_cancelar').on('click', function() 
{
  window.location.reload(true);
});

$('#btn_confirmar').on('click', function() 
{
  $('#formulario').submit();
}); 

$('#admin_checkbox').on('change', function() 
{
  if($('#admin').val()=='S')
    $('#admin').val('N');
  else
    $('#admin').val('S');
}); 


function trocabotoes()
{
  $('#btn_alterar').toggle(150);
  $('#btn_confirmar').toggle(150);
  $('#btn_cancelar').toggle(150);
  $('#div_risco').toggle(150);
}

function desabilitar_inputs(disabled)
{
  $("#usuario").prop('disabled', disabled);
  $("#email").prop('disabled', disabled);
  $("#admin_checkbox").prop('disabled', disabled);
}


</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('templates.principal.principal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>