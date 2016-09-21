<?php $__env->startSection('titulo','Produtos'); ?>

<?php $__env->startSection('topo'); ?>
<h1>Produtos
  <small>Listagem</small>
</h1>
<ol class="breadcrumb">
  <li><a href="<?php echo e(asset('admin/inicio')); ?>"><i class="fa fa-dashboard"></i> Início</a></li>
  <li><a href="<?php echo e(asset('admin/produtos')); ?>"><i class="glyphicon glyphicon-erase"></i> Produtos</a></li>
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
          <form method="GET" action="<?php echo e(asset('produtos')); ?>">
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
                      <th>Código</th>
                      <th>Código Estendido</th>
                      <th>Nome</th>
                      <th>Descrição</th>
                      <th class="centro"><span class="glyphicon glyphicon-cog"></span></th>                      
                  </tr>
               </thead>
               <tbody>
                  <?php foreach($produtos as $produto): ?>
                  <tr>
                    <td><?php echo e($produto->codigo); ?></td>
                    <td><?php echo e($produto->codigoestendido); ?></td>
                    <td><?php echo e($produto->nomefantasia); ?></td>
                    <td><?php echo e($produto->descricao); ?></td>
                    <td class="centro">
                      <div class="tools">                      
                        <a title="Visualizar" href='<?php echo e(asset("produtos/show/$produto->sequencia")); ?>'>
                          <i class="fa fa-search" style="color:#3C8DBC;" title="Editar"></i>
                        </a>                       
                      </div>
                    </td>
                  </tr>
                  <?php endforeach; ?>
               </tbody>
             </table>
             <?php echo e($produtos->links()); ?>

            </div>
          </div>
        </div>
      </div>

          
  </div>  
</div>

<script src="<?php echo e(PASTA_PUBLIC); ?>/template/plugins/jQuery/jquery.min.js"></script>
<script src="<?php echo e(PASTA_PUBLIC); ?>/template/bootstrap/js/custom.js"></script>
<script type="text/javascript">
function imprimir()
{
  var action = "<?php echo e(asset('produtos/relatorio_simples')); ?>";
  var form = '<form action="'+action+'" method="post">' +
                '<input type="hidden" value="'+$('#filtro').val()+'" name="filtro" />' +
              '</form>';
  $('body').append(form);
  $(form).submit();  
}
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('templates.principal.principal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>