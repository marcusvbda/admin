<?php $__env->startSection('conteudo'); ?>
  <form action="teste" method="POST">
  	<input type="text"  name="teste" >
  	<input type="submit" name="">
  </form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('templates.principal.principal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>