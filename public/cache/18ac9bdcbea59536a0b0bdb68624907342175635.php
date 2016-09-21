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
      <p class="title_box"></p>
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
        <br>
         <?php echo e($qtde_registros); ?> 
          <?php if($qtde_registros>1): ?>
            Registros
          <?php else: ?>  
            Registro
          <?php endif; ?>
          (<?php echo e(number_format($tempo_consulta,5)); ?> segundos)
            <button title="Gerar Relatório" onclick="imprimir();" class="btn btn-default pull-right"><span class="glyphicon glyphicon-print"></span></button>

        <hr>

        <div class="row">
          <div class="box-body table-responsive no-padding">  
            <div class="col-md-12">
               <table class="table table-striped" id="tabela">
               <thead>
                  <tr>
                      <th>Usuário</th>
                      <th>email</th>
                      <th class="centro"><span class="glyphicon glyphicon-cog"></span></th>
                  </tr>
               </thead>
               <tbody>
                  <?php foreach($usuarios as $usuario): ?>
                  <tr>
                    <td><?php echo e($usuario->usuario); ?></td>
                    <td><?php echo e($usuario->email); ?></td>
                    <td class="centro">

                      <div class="tools">                      
                        <a title="Visualizar / Alterar" href='<?php echo e(asset("usuarios/show/$usuario->id")); ?>'>
                          <i class="fa fa-edit" style="color:#3C8DBC;" title="Editar"></i>
                        </a>
                        <a title="Excluir" onclick="excluir('<?php echo e($usuario->id); ?>')">
                          <i class="fa fa-trash-o" style="color:#DD4B39;" title="Editar"></i>
                        </a>  
                      </div>

                    </td>
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

  <div class="row">
    <div class="col-md-1">
      <a href="<?php echo e(asset('usuarios/novo')); ?>" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Cadastrar</a>
    </div>
  </div>
</div>


<script src="<?php echo e(PASTA_PUBLIC); ?>/template/plugins/jQuery/jquery.min.js"></script>
<script src="<?php echo e(PASTA_PUBLIC); ?>/template/bootstrap/js/custom.js"></script>
<script type="text/javascript">
function excluir(id)
{
  msg_confirm('<strong>Confirmação</strong>','Deseja excluir este usuário','excluir_registro('+id+')');
}

function excluir_registro(id)
{
  action ="<?php echo e(asset('usuarios/destroy')); ?>";
  var form = $('<form action="'+action+'" method="post">' +
                '<input type="hidden" value="'+id+'" name="id_usuario" />' +
              '</form>');
  $('body').append(form);
  $(form).submit();  
}

function imprimir()
{
  var filtro = $('#filtro').val();
  var action = "<?php echo e(asset('usuarios/relatorio_simples')); ?>";
  var form = '<form action="'+action+'" method="post">' +
                '<input type="hidden" value="'+filtro+'" name="filtro" />' +
              '</form>';
  $('body').append(form);
  $(form).submit();  
}
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('templates.principal.principal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>