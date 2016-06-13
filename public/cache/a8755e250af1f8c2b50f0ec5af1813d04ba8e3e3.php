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
<p class="login-box-msg">Entre para iniciar sua sessão</p>

    <form action="../../index2.html" method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="usuario" placeholder="Usuário">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="senha"  placeholder="Senha">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">        
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Entrar</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('templates.principal.login', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>