<?php $__env->startSection('titulo','Admin'); ?>

<?php $__env->startSection('topo'); ?>
<h1>Dashboard
  <small>Painel de controle</small>
</h1>
<ol class="breadcrumb">
  <li><i class="fa fa-dashboard"></i> Início</li>
</ol>
<?php $__env->stopSection(); ?>



<?php $__env->startSection('conteudo'); ?>

<div class="row">

	<div id="importacao_notificacao" style="display:none;">
		<div class="col-md-3">
			<div class="small-box bg-red">
			    <div class="inner">
				    <h3 id="importacao_qtde">0</h3>
			        <p id="importacao_texto">Arquivo aguardando importação</p>
			    </div>
			    <a id="importacao_btn_importar" class="small-box-footer">Importar <i class="fa fa-arrow-circle-right"></i></a>
			</div>
		</div>
	</div>
	<div id="importacao_loading" style="display:none;">
		<div class="col-md-3">
			<div class="small-box">
			    <div class="centro">
			        <p><img src="<?php echo e(PASTA_PUBLIC); ?>/template/img/loading.gif"></p>
			    </div>
			    <a class="small-box-footer"> <strong style="color:black;">Importando ...  </strong></a>
			</div>
		</div>
	</div>

</div>


<div class="box col-md-12">
	<div class="box-header with-border">
	  <h3 class="box-title">

	  </h3>
	  <div class="box-tools pull-right">
	    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"><i class="fa fa-minus"></i></button></div>
	</div>
	<div class="box-body">
	  <!-- conteudo -->
		



	</div>
	<div class="box-footer">
		<!-- rodapé -->
	</div>
</div>

<script src="<?php echo e(PASTA_PUBLIC); ?>/template/plugins/jQuery/jquery.min.js"></script>
<script src="<?php echo e(PASTA_PUBLIC); ?>/template/bootstrap/js/custom.js"></script>
<script type="text/javascript">
	$( document ).ready(function()
	{
		admin_rede = "<?php echo e(Auth('admin_rede')); ?>";
		if(admin_rede=="N")
	    	procura_arquivos_para_importar();
	});

	$('#importacao_btn_importar').on('click', function() 
	{
	    $('#titulo_msg1').html('<strong>Confirmação</strong>');
		$('#msg_msg1').html('<strong>Confirma importação ?</strong><br>Este processo pode demorar alguns minutos.');
		$('#btn_confirmar_mensagem1').attr("onclick","importar_arquivo()");		
		$('#mensagem1').modal('show');  
		msg_confirm('<strong>Confirmação</strong>','<strong>Confirma importação ?</strong><br>Este processo pode demorar alguns minutos.',"importar_arquivo()"); 
		$('#id').val(id);
	}); 

	function procura_arquivos_para_importar()
	{
		$.getJSON("importacao/qtde_arquivos/importar", function(qtde)
	  	{ 
	  		$('#importacao_notificacao').hide();
			$('#importacao_loading').hide();

	  			
	  		if(qtde>0)
	  		{
		  		$('#importacao_notificacao').toggle(150);
		  		$('#importacao_qtde').html(qtde);
		  		if(qtde>1)
		  			$('#importacao_texto').html("Arquivos aguardando importação");
	  		}		

	  	});
	}

	function importar_arquivo()
	{
		$('#importacao_loading').toggle(150);
		$('#importacao_notificacao').toggle(150);
		$.getJSON("importacao/importar", function(qtde_arquivos_importados)
	  	{ 
	  		if(qtde_arquivos_importados==0)
	  		{
	  			$('#titulo_msg2').html('<strong>ERRO</strong>');
			    $('#msg_msg2').html('Erro ao importar arquivo(s) !');
				$('#btn_voltar_mensagem2').attr("class","btn btn-danger");			    		    	
				$('#btn_voltar_mensagem2').html("Voltar");			    		    	
			    $('#mensagem2').modal('show'); 
			    exit();    	
	  		}
	  		$('#titulo_msg2').html('<strong>Aviso</strong>');
	  		if(qtde_arquivos_importados>1)
		    	$('#msg_msg2').html('Arquivos importados com sucesso !');
		    else
		    	$('#msg_msg2').html('Arquivo importado com sucesso !');
			$('#btn_voltar_mensagem2').attr("class","btn btn-success");			    		    	
			$('#btn_voltar_mensagem2').html("Confirmar");			    		    	
		    $('#mensagem2').modal('show'); 
	    	procura_arquivos_para_importar();	

	  	});
	}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('templates.principal.principal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>