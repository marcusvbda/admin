<?php $__env->startSection('titulo','Visualização Caixa'); ?>

<?php $__env->startSection('topo'); ?>
<h1>Visualização 
  <small>de Caixa <strong>N° <?php echo e(str_pad($caixa->numero, 6, "0", STR_PAD_LEFT)); ?></strong></small>
</h1>
<ol class="breadcrumb">
  <li><a href="<?php echo e(asset('')); ?>"><i class="glyphicon glyphicon-stats"></i> Início</a></li>
  <li><a href="<?php echo e(asset('caixas')); ?>"><i class="glyphicon glyphicon-indent-left"></i> Caixas</a></li>
  <li><i class="glyphicon glyphicon-indent-left"></i> Caixa - <?php echo e(str_pad($caixa->numero, 6, "0", STR_PAD_LEFT)); ?></li>
</ol>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('conteudo'); ?>
<div class="row">
	<div class="col-md-12">
		<div class="box">
			<div class="box-header" style="height: 10px">
		      	<p class="title_box">Resumo</p>	
		      	<div class="box-tools pull-right">
			    	<button type="button" class="btn btn-box-tool" data-widget="collapse">
			    		<i class="fa fa-minus"></i>
			    	</button>		                
			    </div>	
			</div>
			<div class="box-body"> 
			  <!-- conteudo -->
					
					<div class="row">
						<div class="col-md-2">
							<label>N° Caixa</label>
							<input type="text" class="form-control" value="<?php echo e(str_pad($caixa->numero, 6, "0", STR_PAD_LEFT)); ?>" readonly>
						</div>
						<div class="col-md-4">
							<label>Ilha</label>
							<input type="text" class="form-control" value="<?php echo e($caixa->numero_ilha); ?> - <?php echo e($caixa->nome_ilha); ?>" readonly>
						</div>	
						<div class="col-md-6">
							<label>Funcionário</label>
							<input type="text" class="form-control" value="<?php echo e($caixa->numero_funcionario); ?> - <?php echo e($caixa->nome_funcionario); ?>" readonly>
						</div>				
					</div>

					<div class="row">
						<div class="col-md-3">
							<label>Abertura</label>
							<input type="text" class="form-control" value="<?php echo e(dia_semana($caixa->dataabertura)); ?> , <?php echo e($caixa->dataabertura_formatada); ?> , <?php echo e($caixa->horaabertura); ?>" readonly>
						</div>
						<div class="col-md-3">
							<label>Fechamento</label>
							<input type="text" class="form-control" value="<?php echo e(dia_semana($caixa->dataabertura)); ?> , <?php echo e($caixa->datafechamento_formatada); ?>, <?php echo e($caixa->horafechamento); ?>" readonly>
						</div>
						<div class="col-md-3">
							<label>Permanencia</label>
							<input type="text" class="form-control" value="<?php echo e($dias_permanencia); ?> Dia(s), <?php echo e($horas_permanencia); ?> Hora(s)" readonly>
						</div>
						<div class="col-md-3">
							<label>Situação</label>
								<input type="text" class="form-control" value="<?php echo e($caixa->situacao); ?>" readonly>
						</div>
					</div>
					<hr>

			</div>
		</div>
	</div>
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
			  	<div class="col-md-12" style="padding: 10px;">

			  		<?php foreach($porcentagem_grupo as $grupo_porcentagem): ?>	
						<div class="col-md-2">
					        <div id="circulo_porcentagem_<?php echo e($grupo_porcentagem->grupo); ?>" class="text-center">
							    <label style="margin-bottom: -30"><?php echo e($grupo_porcentagem->grupo); ?></label>				        	
					        </div>
						</div>
					<?php endforeach; ?>
									
				</div>					

				<hr>				
			</div>
		</div>
	</div>
</div>

<?php if($tem_combustiveis): ?>
	<div class="row">
		<div class="col-md-12">
			<div class="box"  id="movimento_porcento_circulos">
				<div class="box-header" style="height: 10px">
			      	<p class="title_box">Movimento Combustíveis (%)</p>		
			      	<div class="box-tools pull-right">
			            <button type="button" class="btn btn-box-tool" data-widget="collapse">
			            	<i class="fa fa-minus"></i>
			            </button>		                
			        </div>
				</div>
				<div class="box-body"> 
				  <!-- conteudo -->
				  	<div class="col-md-12" style="padding: 10px;">

				  		<?php foreach($ag_combustiveis as $ag): ?>	
				  			<div class="col-md-2">
							    <div id="circulo_porcentagem_comb_<?php echo e($ag->NUMERO_PRODUTO); ?>" class="text-center">
							    	<label style="margin-bottom: -30"><?php echo e($ag->DESCRICAO_PRODUTO); ?></label>
							    </div>
							</div>
						<?php endforeach; ?>
										
					</div>					

					<hr>				
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>

<div class="row" id="movimento_table_agrupado_grupos">
	<div class="col-md-12" >
		<div class="box" >
			<div class="box-header" style="height: 10px">
		      	<p class="title_box">Movimento Agrupado</p>		
		      	<div class="box-tools pull-right">
			    	<button type="button" class="btn btn-box-tool" data-widget="collapse">
			    		<i class="fa fa-minus"></i>
			    	</button>		                
			    </div>
			</div>
			<div class="box-body" > 
			  <!-- conteudo -->
				

				<div class="col-md-8">
					<div class="box">
						<div class="box-header" style="height: 10px;">
					      	<p class="title_box" style="background-color: darkgray;color:white">... Por Produto</p>		
					      	<div class="box-tools pull-right">
					            <button type="button" class="btn btn-box-tool" data-widget="collapse">
					            	<i class="fa fa-minus"></i>
					            </button>		                
					        </div>
						</div>
						<div class="box-body" > 

							<div class="table-responsive" >
								 <table class="table table-hover" style="font-size: 14px">
								    <thead>
									    <tr style="background-color: #F4F4F4;border-radius: 100px;">
									      <th>Produto</th>
									      <th>Grupo</th>						      
									      <th>Qtde</th>
									      <th>Valor</th>
									      <th>%</th>
									    </tr>
								    </thead>
								   <tbody>
								   		<?php foreach($agrupado as $ag): ?>
								   		<tr>
								   			<td><?php echo e($ag->DESCRICAO_PRODUTO); ?></td>
								   			<td><?php echo e($ag->DESCRICAO); ?></td>					   			
								   			<td><?php echo e($ag->QUANTIDADE); ?></td>
								   			<td><?php echo e(format_dinheiro('R$',$ag->VALORNEGOCIACAO)); ?></td>
								   			<td><?php echo e(number_format((($ag->VALORNEGOCIACAO*100)/$vlr_total), 2, ',', ' ')); ?> %</td>
								   		</tr>
								   		<?php endforeach; ?>
								   </tbody>
								 </table>
								 <hr>
							</div>							

						</div>
					</div>
				</div>


				<div class="col-md-4" >
					<div class="box" >
						<div class="box-header" style="height: 10px">
					      	<p class="title_box" style="background-color: darkgray;color:white">... Por Grupo de Produto</p>
					      	<div class="box-tools pull-right">
					            <button type="button" class="btn btn-box-tool" data-widget="collapse">
					            	<i class="fa fa-minus"></i>
					            </button>		                
					        </div>
					      	<div class="box-tools pull-right">
				            <button type="button" class="btn btn-box-tool" data-widget="collapse">
				            	<i class="fa fa-minus"></i>
				            </button>		                
			        </div>		
						</div>
						<div class="box-body" > 
						  <!-- conteudo -->
							<div class="table-responsive" >
								 <table class="table table-hover" style="font-size: 14px">
								    <thead>
									    <tr style="background-color: #F4F4F4;border-radius: 100px;">
									      <th>Grupo</th>						      
									      <th>Qtde</th>
									      <th>Valor</th>
									      <th>%</th>
									    </tr>
								    </thead>
								   <tbody>
								   		<?php foreach($porcentagem_grupo as $ag): ?>
								   		<tr>
								   			<td><?php echo e($ag->grupo); ?></td>					   			
								   			<td><?php echo e($ag->QUANTIDADE); ?></td>
								   			<td><?php echo e(format_dinheiro('R$',$ag->VALORNEGOCIACAO)); ?></td>
								   			<td><?php echo e(number_format((($ag->VALORNEGOCIACAO*100)/$vlr_total), 2, ',', ' ')); ?> %</td>
								   		</tr>
								   		<?php endforeach; ?>
								   </tbody>
								 </table>
								 <hr>
							</div>
						</div>
					</div>


					<div class="box" style="bottom: 0">
						<div class="box-header" style="height: 10px">
					      	<p class="title_box" style="background-color: darkgray;color:white">Valores</p>
					      	<div class="box-tools pull-right">
					            <button type="button" class="btn btn-box-tool" data-widget="collapse">
					            	<i class="fa fa-minus"></i>
					            </button>		                
					        </div>		
						</div>
						<div class="box-body"  style="background-color:whitesmoke "> 
						  <!-- conteudo -->

							<div class="row text-center"><strong>Créditos</strong></div>
							<div class="row">
								<div class="col-md-6 text-left">Total Vendas :</div>
								<div class="col-md-6 text-right" ><?php echo e(format_dinheiro('R$',$vlr_total)); ?></div>
							</div>
							<div class="row">
								<div class="col-md-6 text-left">Total Inserções :</div>
								<div class="col-md-6 text-right"><?php echo e(format_dinheiro('R$',$vlr_manutencoes['I'])); ?>

								</div>
							</div>
							<div class="row">
								<div class="col-md-6 text-left">Total Créditos :</div>
								<div class="col-md-6 text-right"><?php echo e(format_dinheiro('R$',$vlr_manutencoes['I']+$vlr_total)); ?>

								</div>
							</div>
							<div class="row text-center"><strong>Débitos</strong></div>							
							<div class="row">
								<div class="col-md-6 text-left">Total Retiradas :</div>
								<div class="col-md-6 text-right"><?php echo e(format_dinheiro('R$',$vlr_manutencoes['R'])); ?>

								</div>
							</div>
							<div class="row">
								<div class="col-md-6 text-left">Total a Prazo :</div>
								<div class="col-md-6 text-right"><?php echo e(format_dinheiro('R$',$total_prazo)); ?></div>
							</div>
							<div class="row">
								<div class="col-md-6 text-left">Total a Pagto Antecipado :</div>
								<div class="col-md-6 text-right"><?php echo e(format_dinheiro('R$',0)); ?>

								</div>
							</div>

							<hr>
							<!-- revisar -->
							<div class="row">
								<div class="col-md-6 text-left"><strong>Sub Total</strong> :</div>
								<div class="col-md-6 text-right">
									<strong><?php echo e(format_dinheiro
											('R$', 
												$caixa->VALOR_INICIAL + $vlr_total-$vlr_manutencoes['R'] + $vlr_manutencoes['I'] - $total_prazo 
											)); ?></strong>
								</div>
							</div>
							<!-- revisar -->

						</div>
					</div>

				</div>





			</div>
		</div>
	</div>
</div>



<div class="row">
		<div class="col-md-6">
			<div class="box">
				<div class="box-header" style="height: 10px;">
			      	<p class="title_box">Manutenções de Caixa</p>		
			      	<div class="box-tools pull-right">
			            <button type="button" class="btn btn-box-tool" data-widget="collapse">
			            	<i class="fa fa-minus"></i>
			            </button>		                
			        </div>
				</div>
				<div class="box-body" > 

					<div class="table-responsive" >
						 <table class="table table-hover" style="font-size: 14px">
						    <thead>
							    <tr style="background-color: #F4F4F4;border-radius: 100px;">
							      <th>Documento</th>
							      <th>Descrição</th>
							      <th>Data</th>						      
							      <th>Hora</th>
							      <th>Usuário</th>
							      <th>Tipo</th>
							      <th>Valor</th>
							    </tr>
						    </thead>
						   <tbody>
						   		<?php foreach($manutencoes as $mn): ?>
						   		<?php if($mn->tipo=="R"): ?>
						   			<tr style="background-color: mistyrose">
						   		<?php else: ?>
						   			<tr style="background-color: #c0ffc0">
						   		<?php endif; ?>

						   			<td><?php echo e($mn->documento); ?></td>
						   			<td><?php echo e($mn->descricao); ?></td>
						   			<td><?php echo e($mn->data_formatada); ?></td>
						   			<td><?php echo e($mn->hora); ?></td>
						   			<td><?php echo e($mn->usuariolancamento); ?></td>
						   			<?php if($mn->tipo=="R"): ?>
						   				<td>Retirada</td>
						   			<?php else: ?>
						   				<td>Inserção</td>
						   			<?php endif; ?>
						   			<td><?php echo e(format_dinheiro('R$',$mn->valor)); ?></td>
						   		</tr>
						   		<?php endforeach; ?>
						   </tbody>
						 </table>
						 <hr>
					</div>							

				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="box">
				<div class="box-header" style="height: 10px;">
			      	<p class="title_box">Cancelamentos</p>
			      	<div class="box-tools pull-right">
			            <button type="button" class="btn btn-box-tool" data-widget="collapse">
			            	<i class="fa fa-minus"></i>
			            </button>		                
			        </div>		
				</div>
				<div class="box-body" > 

					<div class="table-responsive" >
						 <table class="table table-hover" style="font-size: 14px">
						    <thead>
							    <tr style="background-color: #F4F4F4;border-radius: 100px;">
							      <th>Cupom</th>
							      <th>Data</th>						      
							      <th>Hora</th>
							      <th>Usuário</th>
							      <th>Valor</th>
							    </tr>
						    </thead>
						   <tbody>
						   		<?php foreach($cancelamentos as $canc): ?>
						   		<tr title="Duplo clique para ver o cupom" ondblclick="verCupom(<?php echo e($canc->numeronota); ?>);">
						   			<td><?php echo e(str_pad($canc->numeronota, 6, "0", STR_PAD_LEFT)); ?></td>
						   			<td><?php echo e($canc->data_formatada); ?></td>
						   			<td><?php echo e($canc->hora); ?></td>
						   			<td><?php echo e($canc->usuariocancelamento); ?></td>
						   			<td><?php echo e(format_dinheiro('R$',$canc->valor)); ?></td>
						   		</tr>
						   		<?php endforeach; ?>
						   </tbody>
						 </table>
						 <hr>
					</div>							

				</div>
			</div>
		</div>
</div>



<div class="row">
		<div class="col-md-12" style="height: 400px;overflow-y: auto">
			<div class="box">
				<div class="box-header" style="height: 10px;">
			      	<p class="title_box">Cupons</p>	
				    <div class="box-tools pull-right">
			            <button type="button" class="btn btn-box-tool" data-widget="collapse">
			            	<i class="fa fa-minus"></i>
			            </button>		                
			        </div>
				</div>
				<div class="box-body" > 

					<div class="table-responsive" >
						 <table class="table table-hover" style="font-size: 14px">
						    <thead>
							    <tr style="background-color: #F4F4F4;border-radius: 100px;">
							      <th>ECF / S@T</th>
							      <th>Cupom</th>
							      <th>Data</th>						      
							      <th>Hora</th>
							      <th>Cód. Cliente</th>
							      <th>Nome Cliente</th>
							      <th>Valor</th>
							      <th>Tipo Venda</th>
							    </tr>
						    </thead>
						   <tbody>
						   		<?php foreach($cupons as $c): ?>
						   		<tr title="Duplo clique para ver o cupom" ondblclick="verCupom(<?php echo e($c->numeronota); ?>);">
						   			<td><?php echo e(str_pad($c->ecf, 6, "0", STR_PAD_LEFT)); ?></td>
						   			<td><?php echo e(str_pad($c->numeronota, 6, "0", STR_PAD_LEFT)); ?></td>						   			
						   			<td><?php echo e($c->data_formatada); ?></td>
						   			<td><?php echo e($c->hora); ?></td>
						   			<td><?php echo e(str_pad($c->numero_cliente, 6, "0", STR_PAD_LEFT)); ?></td>
						   			<?php if($c->numero_cliente=='999999'): ?>
						   				<td>COMSUMIDOR</td>
						   			<?php else: ?>
						   				<td><?php echo e($c->nome_cliente); ?></td>
						   			<?php endif; ?>
						   			<td><?php echo e(format_dinheiro('R$',$c->valortotalcupom)); ?></td>
						   			<?php if($c->recebido=='S'): ?>
						   				<td>À Vista</td>
						   			<?php else: ?>
						   				<td>A Prazo</td>
						   			<?php endif; ?>
						   		</tr>
						   		<?php endforeach; ?>
						   </tbody>
						 </table>
						 <hr>
					</div>							

				</div>
			</div>
		</div>
</div>

<script src="<?php echo e(PASTA_PUBLIC); ?>/template/plugins/jQuery/jquery.min.js"></script>
<script src="<?php echo e(PASTA_PUBLIC); ?>/template/bootstrap/js/custom.js"></script>
<script src="<?php echo e(PASTA_PUBLIC); ?>/template/bootstrap/js/circulos.js"></script>
<script type="text/javascript">		
<?php foreach($porcentagem_grupo as $grupo_porcentagem): ?>
        $("#circulo_porcentagem_<?php echo e($grupo_porcentagem->grupo); ?>").circliful({
        animationStep: 15,
        foregroundBorderWidth: 5,
        backgroundBorderWidth: 15,
        decimals:2,
        // text: "<?php echo e($grupo_porcentagem->grupo); ?>",
        percent: <?php echo e($grupo_porcentagem->porcentagem); ?>,
    });
<?php endforeach; ?>

<?php if($tem_combustiveis): ?>
	<?php foreach($ag_combustiveis as $ag): ?>
	        $("#circulo_porcentagem_comb_<?php echo e($ag->NUMERO_PRODUTO); ?>").circliful({
	        animationStep: 15,
	        foregroundBorderWidth: 5,
	        backgroundBorderWidth: 15,
	        decimals:2,
	        // text: "<?php echo e($ag->DESCRICAO_PRODUTO); ?>",
	        percent: <?php echo e($ag->porcentagem); ?>,
	    });
	<?php endforeach; ?>
<?php endif; ?>


function verCupom(cupom)
{
	alert("ver cupom numero "+cupom);
}

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('templates.principal.principal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>