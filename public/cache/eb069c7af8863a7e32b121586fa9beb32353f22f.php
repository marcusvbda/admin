<?php $__env->startSection('titulo','Abastecimentos'); ?>

<?php $__env->startSection('topo'); ?>
<h1>Abastecimentos
  <small>Listagem</small>
</h1>
<ol class="breadcrumb">
  <li><a href="<?php echo e(asset('admin/inicio')); ?>"><i class="fa fa-dashboard"></i> Início</a></li>
  <li><a href="<?php echo e(asset('admin/abastecimentos')); ?>"><i class="glyphicon glyphicon-erase"></i> Abastecimentos</a></li>
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
          <div class="col-md-12">
            <div class="col-md-2">
              <label>Bomba</label>
              <select class="form-control" id="bomba">
                <option selected value="0">Todas</option>
                <?php foreach($bombas as $bomb): ?>
                  <option value="<?php echo e($bomb->bomba); ?>">BOMBA <?php echo e($bomb->bomba); ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="col-md-2">
              <label>Bico</label>
              <select class="form-control" id="bico">
                <option selected value="0">Todos</option>
                <?php foreach($bicos as $bic): ?>
                  <option value="<?php echo e($bic->numero); ?>">BICO <?php echo e($bic->numero); ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="col-md-4">
              <label>Combustível</label>
              <select class="form-control" id="combustivel">
                <option selected value="0">Todos</option>
                <?php foreach($combustiveis as $comb): ?>
                  <option value="<?php echo e($comb->id); ?>"><?php echo e($comb->descricao); ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="col-md-2">
              <label>De :</label>
              <input type="date" class="form-control">
            </div>
             <div class="col-md-2">
              <label>Até :</label>
              <input type="date" class="form-control">
            </div>
          </div>
        </div> 


        <div class="row">
          <?php if(isset($abastecimentos)): ?>
            <div class="col-md-12">
                    <br>      
                     <table class="table table-hover" style="font-size: 14px" id="tabela">
                      <thead>
                        <tr style="background-color: #F4F4F4;border-radius: 100px;">
                          <th>Registro</th>
                          <th>Bomba</th>
                          <th>Combustível</th>                
                          <th>Preço</th>
                          <th>Total (Litros)</th>
                          <th>Total (R$)</th>
                          <th>Data</th>
                          <th>Hora</th>
                        </tr>
                      </thead>
                     <tbody>
                        <?php foreach($abastecimentos as $ab): ?>
                        <tr>
                          <td><?php echo e($ab->registro); ?></td>
                          <td><?php echo e($ab->id_bomba); ?></td>
                          <td><?php echo e($ab->combustivel); ?></td>
                          <td><?php echo e($ab->precounitario); ?></td>
                          <td><?php echo e($ab->totallitros); ?></td>   
                          <td><?php echo e(format_dinheiro('R$',$ab->totaldinheiro)); ?></td>       
                          <td><?php echo e($ab->data_formatada); ?></td>        
                          <td><?php echo e($ab->horaabastecimento); ?></td>       
                        </tr>
                        <?php endforeach; ?>
                     </tbody>
                   </table>
                  <hr> 
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
          
  </div>  
</div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('templates.principal.principal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<script>
dataTable('#tabela');

$( "#bomba" ).change(function() 
{
	var bomba = $('#bomba').val();

  	$.post("<?php echo e(asset('abastecimentos/procurabicos')); ?>" ,{bomba:bomba},  function(dados)
	{ 	
        $('#bicos option').remove();
        $('#bicos').append("<option value='0' selected>Todos</option>");        
		$.each(dados, function(dados,d)
        {      
        	$('#bicos').append("<option value='"+d.numero+"'>Bico "+d.numero+"</option>");
        });
	},'json');

	$.post("<?php echo e(asset('abastecimentos/procuracombustivel')); ?>" ,{bomba:bomba},  function(dados)
	{ 	
        $('#combustivel option').remove();    
        if(bomba==0)
        		$('#combustivel').append("<option value='0' selected>Todos</option>");     
		$.each(dados, function(dados,d)
        {       
			$('#combustivel').append("<option value='"+d.codigo+"'>"+d.descricao+"</option>");
        });
	},'json');
});

$( "#bico" ).change(function() 
{
	var bico = $('#bico').val();
  	$.post("<?php echo e(asset('abastecimentos/procurabomba')); ?>" ,{bico:bico},  function(dados)
	{ 	
        $('#bomba option').remove();
        $('#bomba').append("<option value='0' selected>Todas</option>");        
		$.each(dados, function(dados,d)
        {      
        	$('#bomba').append("<option value='"+d.numero+"'>Bomba "+d.numero+"</option>");
        });
	},'json');

});
</script>