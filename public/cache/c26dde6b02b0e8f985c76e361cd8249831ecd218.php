<?php $__env->startSection('titulo','Configurações'); ?>

<?php $__env->startSection('topo'); ?>
<h1>Configurações
  <small>Parâmetros de sistema</small>
</h1>
<ol class="breadcrumb">
  <li><a href="<?php echo e(asset('')); ?>"><i class="fa fa-dashboard"></i> Início</a></li>
  <li><i class="glyphicon glyphicon-wrench"></i> Configurações / Parâmetros</li>
</ol>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('conteudo'); ?>
<input type="text" id="cliques" value="0" hidden>

<div class="col-md-12">
	<div class="box">
		<div class="box-header" style="height: 30px;padding-bottom: 0px;">
      		<p class="title_box">Configurações de acesso</p>
		  <div class="box-tools pull-right">
		  </div>
		</div>
		<div class="box-body">
		  <!-- conteudo -->
				<div class="row">
					<?php foreach($parametros as $parametro): ?>
						<?php if($parametro->classificacao=="ACESSO"): ?>
							<div class="col-md-2">							
								<?php if($parametro->tipo=="CHECKBOX"): ?>
									<?php if($parametro->valor=="S"): ?>
									<label>
										<input onchange="clique()" type="checkbox" checked id="<?php echo e($parametro->id); ?>" name="<?php echo e($parametro->id); ?>">
											<?php echo e($parametro->titulo); ?><br>
										<small style="font-weight:lighter;"><?php echo e($parametro->descricao); ?></small>
									</label>
									<?php else: ?>
									<label>
										<input onchange="clique()" type="checkbox"  id="<?php echo e($parametro->id); ?>" name="<?php echo e($parametro->id); ?>">
											<?php echo e($parametro->titulo); ?><br>
										<small style="font-weight:lighter;"><?php echo e($parametro->descricao); ?></small>
									</label>
									<?php endif; ?>
								<?php elseif($parametro->tipo=="TEXTO"): ?>
									<label><?php echo e($parametro->titulo); ?></label>
									<input onchange="clique()" type="text" id="<?php echo e($parametro->id); ?>" value="<?php echo e($parametro->valor); ?>" name="<?php echo e($parametro->id); ?>"><br>
									<small><?php echo e($parametro->descricao); ?></small>
								<?php elseif($parametro->tipo=="NUMERO"): ?>
									<label><?php echo e($parametro->titulo); ?></label>									
									<input onkeyup="clique()" onchange="clique()" type="number" id="<?php echo e($parametro->id); ?>" value="<?php echo e($parametro->valor); ?>" name="<?php echo e($parametro->id); ?>"><br>
									<small><?php echo e($parametro->descricao); ?></small>
								<?php endif; ?>							
							</div>	
						<?php endif; ?>
					<?php endforeach; ?>			
				</div>
		</div>
	</div>
</div>

<div class="col-md-12">
	<div class="box">
		<div class="box-header" style="height: 30px;padding-bottom: 0px;">
      		<p class="title_box">Configurações de Relatórios</p>
		  <div class="box-tools pull-right">
		  </div>
		</div>
		<div class="box-body">
		  <!-- conteudo -->
				<div class="row">
					<?php foreach($parametros as $parametro): ?>
						<?php if($parametro->classificacao=="RELATORIOS"): ?>
							<div class="col-md-2">							
								<?php if($parametro->tipo=="CHECKBOX"): ?>
									<?php if($parametro->valor=="S"): ?>
									<label>
										<input onchange="clique()" type="checkbox" checked id="<?php echo e($parametro->id); ?>" name="<?php echo e($parametro->id); ?>">
											<?php echo e($parametro->titulo); ?><br>
										<small style="font-weight:lighter;"><?php echo e($parametro->descricao); ?></small>
									</label>
									<?php else: ?>
									<label>
										<input onchange="clique()" type="checkbox"  id="<?php echo e($parametro->id); ?>" name="<?php echo e($parametro->id); ?>">
											<?php echo e($parametro->titulo); ?><br>
										<small style="font-weight:lighter;"><?php echo e($parametro->descricao); ?></small>
									</label>
									<?php endif; ?>
								<?php elseif($parametro->tipo=="TEXTO"): ?>
									<label><?php echo e($parametro->titulo); ?></label>
									<input onchange="clique()" type="text" id="<?php echo e($parametro->id); ?>" value="<?php echo e($parametro->valor); ?>" name="<?php echo e($parametro->id); ?>"><br>
									<small><?php echo e($parametro->descricao); ?></small>
								<?php elseif($parametro->tipo=="NUMERO"): ?>
									<label><?php echo e($parametro->titulo); ?></label>									
									<input onkeyup="clique()" onchange="clique()" type="number" id="<?php echo e($parametro->id); ?>" value="<?php echo e($parametro->valor); ?>" name="<?php echo e($parametro->id); ?>"><br>
									<small><?php echo e($parametro->descricao); ?></small>
								<?php endif; ?>							
							</div>	
						<?php endif; ?>
					<?php endforeach; ?>			
				</div>
		</div>
	</div>
</div>

<div class="col-md-12">
	<button class="btn btn-primary" id="btn_salvar" style="display:none;"><span class="glyphicon glyphicon-ok"></span> Salvar Alterações</button>
</div>



<script src="<?php echo e(PASTA_PUBLIC); ?>/template/plugins/jQuery/jquery.min.js"></script>
<script src="<?php echo e(PASTA_PUBLIC); ?>/template/bootstrap/js/custom.js"></script>
<script type="text/javascript">
// jQuery( document ).ready(function( $ ) 
// {
	
// });

function clique()
{	
	var cliques = parseInt($('#cliques').val());
	if(cliques==0)
	{
		$('#cliques').val(cliques+1);
		$('#btn_salvar').toggle(150);
	}
}

$('#btn_salvar').on('click', function() 
{
	msg_confirm('<strong>Confirmação</strong>','Deseja salvar as alterações?',"salvar()"); 

}); 

function salvar()
{
	var admin_rede = "<?php echo e(Auth('admin_rede')); ?>";
	var action = "<?php echo e(asset('configuracoes/salvar')); ?>";
	var form = '<form action="'+action+'" method="post">';

	$.getJSON("<?php echo e(asset('configuracoes/Buscaparametros')); ?>", function(data) 
	{
		$.each(data, function(dados,d)
        {      
        	tipo = $('#'+d.id).attr('type');
         	if(tipo=="checkbox")
         	{
         		if( $('#'+d.id).prop("checked") == true)         			
         			form += '<input type="text" value="S" name="'+d.id+'" />';
         		else
         			form += '<input type="text" value="N" name="'+d.id+'" />';
         	}
         	else if((tipo=="number")||(tipo=="text"))
         	{
         			valor = $('#'+d.id).val();
         			form += '<input type="text" value="'+valor+'" name="'+d.id+'" />';
         	}
        });
    form += "</form>";
  	$('body').append(form);
  	$(form).submit(); 
	});	
}

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('templates.principal.principal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>