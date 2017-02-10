<?php $__env->startSection('titulo','Dashboard'); ?>

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
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua" style="padding-top: 20px;"><i class="ion ion-ios-people-outline"></i></span>

            <a style="color:black" href="<?php echo e(asset('usuarios')); ?>" title="clique para visualizar"><div class="info-box-content">
              <span class="info-box-text">Usuários</span>
              <?php $qtde_usuarios = Controller::exec('usuariosController','qtde');  ?>
              <span class="info-box-number"><?php echo e($qtde_usuarios); ?><small> Cadastrado <?php if($qtde_usuarios>1): ?><?php echo e('s'); ?><?php endif; ?></small></span>
            </div></a>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow" style="padding-top: 20px;"><i class="ion ion-ios-gear-outline"></i></span>

            <a style="color:black" href="<?php echo e(asset('rede')); ?>" title="clique para visualizar"><div class="info-box-content">
              <span class="info-box-text">Rede</span>
               <span class="info-box-number"><small><?php echo e(Controller::exec('empresaController','getRede')); ?></small></span>
            </div></a>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
         <div class="info-box">
            <span class="info-box-icon bg-red" style="width: 100%;"><span id="data"><?php echo e(date('d/m/Y')); ?></span></span>

           
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green" style="width: 100%;"><span id="relogio"></span></span>

           
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>

<div class="row">
  <div class="col-md-12">
    <div class="box"  id="movimento_porcento_circulos">
      <div class="box-header" style="height: 10px">
            <p class="title_box">Movimento Grupos de Produto (%)</p>  
            <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse">
              <i class="fa fa-minus"></i>
            </button>                   
          </div>  
      </div>
      <div class="box-body"> 
        <!-- conteudo -->        
          <div class="row text-center" id="div_loading_grupos" style="height: 200px;" title="Carregando ...">      
            <img src="<?php echo e(asset('template/img/loading.gif')); ?>">
          </div>

          <div class="row" id="div_conteudo_grupos" style="display: none;"></div>
        
      </div>
    </div>
  </div>
</div>

<script src="<?php echo e(asset()); ?>template/bootstrap/js/circulos.js"></script>

<?php $__env->stopSection(); ?>



<?php echo $__env->make('templates.principal.principal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<script>
showTimer();
initTimer();
showGrupos();
function showTimer() 
{
  var time=new Date();
  var hour=time.getHours();
  var minute=time.getMinutes();
  var second=time.getSeconds();
  if(hour<10)   hour  ="0"+hour;
  if(minute<10) minute="0"+minute;
  var st=hour+":"+minute+":"+second;
  document.getElementById("relogio").innerHTML=st; 
}
function initTimer() 
{
  setInterval(showTimer,1000);
}


function showGrupos()
{
	$.post("<?php echo e(asset('produtos/JsonPorcentagemGrupo')); ?>" ,{},  function(dados)
	{ 	
		var cont=0;
		$.each(dados, function(dados,d)
        {      
        	circulo =  "<div class='col-md-2'>"+
					        "<div id='circulo_porcentagem_"+cont+"' class='text-center'>"+
							    "<label>"+d.grupo+"</label>"+			        	
					        "</div>"+
					    "</div>";
        	$('#div_conteudo_grupos').append(circulo);
        	$("#circulo_porcentagem_"+cont).circliful(
        	{
		        animationStep: 15,
		        foregroundBorderWidth: 5,
		        backgroundBorderWidth: 15,
		        decimals:2,
		        percent: d.porcentagem,
	    	});
	    	cont++;
        });

        $('#div_loading_grupos').toggle(150);
        $('#div_conteudo_grupos').toggle(150);
	},'json');
}
</script>