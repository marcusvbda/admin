<?php $__env->startSection('titulo','PÁGINA EM BRANCO'); ?>

<?php $__env->startSection('topo'); ?>
<!-- <h1>Dashboard
  <small>Subtitulo</small>
</h1> -->
<!-- <ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Início</a></li>
  <li><a href="#">Pagina em branco</a></li> 
</ol> -->
<?php $__env->stopSection(); ?>


<?php $__env->startSection('conteudo'); ?>
<table class="table table-striped" id="tabela">"<tr><th>Nome</th><th>Email</th><th>Sexo</th><th>Administrador</th></tr><tr><td>Vinicius Bassalobre de Assis</td><td>marcusv.bda@icloud.com</td><td>M</td><td>S</td></tr><tr><td>teste</td><td>teste@teste.com</td><td>M</td><td>N</td></tr></table>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('templates.principal.relatorios', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>