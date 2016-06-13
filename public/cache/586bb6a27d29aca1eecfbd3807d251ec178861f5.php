<?php $__env->startSection('titulo','Login'); ?>

<?php $__env->startSection('topo'); ?>
<h1>
  Nome da página
  <small>Subtitulo</small>
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="#">Pagina em branco</a></li>
</ol>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('conteudo'); ?>
<p class="login-box-msg">Após este cadastro solicite ao administrador a liberação do mesmo</p>

    <form action="<?php echo e(asset('usuarios/cadastrar')); ?>" onsubmit="return validar()" method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="nome" placeholder="Nome Completo">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="email" class="form-control" name="email" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="senha" placeholder="Senha">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="repita" placeholder="Repita a senha">
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
      </div>
      <div class="row">   
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Cadastrar</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('sublink'); ?>
<a href="<?php echo e(asset('usuarios/login')); ?>">Voltar ao login</a>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('templates.principal.login', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>