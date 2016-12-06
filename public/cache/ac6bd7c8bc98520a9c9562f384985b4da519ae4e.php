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
								 <table class="table table-hover" style="font-size: 14px" id="por_produto">
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
								 <table class="table table-hover" style="font-size: 14px" id="por_grupo">
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
	<div class="col-md-12">
		<div class="box">
			<div class="box-header" style="height: 10px;">
		      	<p class="title_box">Vendas</p>
		      	<div class="box-tools pull-right">
		            <button type="button" class="btn btn-box-tool" data-widget="collapse">
		            	<i class="fa fa-minus"></i>
		            </button>		                
		        </div>		
			</div>
			<div class="box-body" > 
			<br>
				<div class="row">
					<div class="col-md-12">

							<ul class="nav nav-tabs">
							  <li class="active"><a data-toggle="tab" href="#cupons">Cupons</a></li>
							  <li><a data-toggle="tab" href="#cancelamentos">Cancelamentos</a></li>
							  <li><a data-toggle="tab" href="#manutencoes">Manutenção de Caixa</a></li>
							  <li><a data-toggle="tab" href="#abastecimentos">Abastecimentos</a></li>
							</ul>

							<div class="tab-content">
							  <div id="cupons" class="tab-pane fade in active">

							    <br>
							  		<table class="table table-hover" style="font-size: 14px" id="tb_cupons">
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
									   			<?php if(cupons!='C'): ?>
											   		<tr title="Duplo clique para ver o cupom" ondblclick="verDocumento(<?php echo e($c->numeronota); ?>);">
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
											   	<?php endif; ?>
									   		<?php endforeach; ?>
									   </tbody>
									</table>
									<hr>

							  </div>
							  <div id="cancelamentos" class="tab-pane fade">
							  	<br>
									 <table class="table table-hover" style="font-size: 14px" id="tb_cancelamentos">
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
									   		<?php foreach($cupons as $canc): ?>
									   			<?php if($canc->excluido=="C"): ?>
											   		<tr title="Duplo clique para ver o cupom" ondblclick="verDocumento(<?php echo e($canc->numeronota); ?>);">
											   			<td><?php echo e(str_pad($canc->numeronota, 6, "0", STR_PAD_LEFT)); ?></td>
											   			<td><?php echo e($canc->data_formatada); ?></td>
											   			<td><?php echo e($canc->hora); ?></td>
											   			<td><?php echo e($canc->usuariocancelamento); ?></td>
											   			<td><?php echo e(format_dinheiro('R$',$canc->valortotalcupom)); ?></td>
											   		</tr>
											   	<?php endif; ?>
									   		<?php endforeach; ?>
									   </tbody>
									 </table>
									<hr>		


							  </div>
							  <div id="manutencoes" class="tab-pane fade">
							    <br>			
							  	 <table class="table table-hover" style="font-size: 14px" id="tb_manutencao">
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

							  <div id="abastecimentos" class="tab-pane fade">
							    <br>			
							  	 <table class="table table-hover" style="font-size: 14px" id="tb_abastecidas">
								    <thead>
									    <tr style="background-color: #F4F4F4;border-radius: 100px;">
									      <th>Registro</th>
									      <th>Cupom</th>
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
								   			<td><?php echo e(ArrayUtils::Search($cupons, 'id', $ab->id_dadosfaturamento)->numeronota); ?></td>
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

							</div>

					</div>
				</div>
						

			</div>
		</div>
	</div>
</div>









  <div class="modal fade"  id="Modal_Documento" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
        	<h4 class="text-center"><strong><span id="documento_titulo"></span></strong></h4>
        </div>
        <div class="modal-body">
           

          	<ul class="nav nav-tabs" id="myTab" role="tablist">
			  <li class="nav-item active">
			    <a class="nav-link active" data-toggle="tab" href="#cupom" role="tab" aria-controls="cupons">Cupom</a>
			  </li>
			  <li class="nav-item">
			    <a class="nav-link" data-toggle="tab" href="#itens" role="tab" aria-controls="itens">Itens</a>
			  </li>
			 <!--  <li class="nav-item">
			    <a class="nav-link" data-toggle="tab" href="#formaspagtos" role="tab" aria-controls="formaspagtos">Formas Pagtos</a>
			  </li> -->
			</ul>

			<div class="tab-content">
			  <div class="tab-pane active" id="cupom" role="tabpanel">

			  			<br>
			  	       	<div class="row">
          					<div class="col-md-8">
			          			<label>Nome Cliente:</label>
			          			<input type="text" id="Nome_Cliente" class="form-control" disabled>
			          		</div>
			          		<div class="col-md-4">
			          			<label>CPF/CNPJ:</label>
			          			<input type="text" id="cnpj" class="form-control" disabled>
			          		</div>
			          	</div>

			          	<div class="row">
			          		<div class="col-md-12">
			          			<label>Condição de Pagto:</label>
			          			<input type="text" id="Cond_pagto" class="form-control" disabled>
			          		</div>
			          	</div>

			          	<div class="row">
			          		<div class="col-md-3">
			          			<label>Data Negociação:</label>
			          			<input type="text" id="Data_Negociacao" class="form-control" disabled>
			          		</div>
			          		<div class="col-md-3">
			          			<label>Emissão:</label>
			          			<input type="text" id="Emissao" class="form-control" disabled>
			          		</div>
			          		<div class="col-md-3">
			          			<label>Data Vencimento:</label>
			          			<input type="text" id="Data_Vencimento" class="form-control" disabled>
			          		</div>
			          		<div class="col-md-3">
			          			<label>Hora:</label>
			          			<input type="text" id="Hora" class="form-control" disabled>
			          		</div>
			          	</div>

			          	<div class="row">
			          		<div class="col-md-3">
			          			<label>Número ECF/S@T:</label>
			          			<input type="text" id="ECF" class="form-control" disabled>
			          		</div>
			          		<div class="col-md-3">
			          			<label>Cupom:</label>
			          			<input type="text" id="Cupom" class="form-control" disabled>
			          		</div>
			          		<div class="col-md-3">
			          			<label>Tipo Nota:</label>
			          			<input type="text" id="Tipo" class="form-control" disabled>
			          		</div>
			          		<div class="col-md-3">
			          			<label>Funcionário:</label>
			          			<input type="text" id="Funcionario" class="form-control" disabled>
			          		</div>
			          	</div>

			          	<div class="row">
			          		<div class="col-md-3">
			          			<label>Motorista</label>
			          			<input type="text" id="Motorista" class="form-control" disabled>
			          		</div>
			          		<div class="col-md-3">
			          			<label>KM:</label>
			          			<input type="text" id="km" class="form-control" disabled>
			          		</div>
			          		<div class="col-md-3">
			          			<label>Placa:</label>
			          			<input type="text" id="Placa" class="form-control" disabled>
			          		</div>
			          		
			          	</div>

			  </div>
			  <div class="tab-pane" id="itens" role="tabpanel" style="height: 315px;overflow-y: auto">
			  		<div class="table-responsive" >
						 <table class="table table-hover" style="font-size: 14px">
						    <thead>
							    <tr style="background-color: #F4F4F4;border-radius: 100px;">
							      <th>Produto</th>
							      <th>Bico</th>
							      <th>P.Unitário</th>						      
							      <th>Qtde</th>
							      <th>Valor</th>
							    </tr>
						    </thead>
						   <tbody id="itens_table_itens_cupom">
						   	
						   </tbody>
						 </table>
						 <hr>
					</div>	
				</div>
			<!--   <div class="tab-pane" id="formaspagtos" role="tabpanel">...</div> -->
			</div>


        </div>
        <br>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
        </div>
      </div>
      
    </div>
  </div>
<script src="<?php echo e(PASTA_PUBLIC); ?>/template/bootstrap/js/circulos.js"></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('templates.principal.principal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<script>
dataTable('#por_produto');
dataTable('#por_grupo');
dataTable('#tb_cupons');
dataTable('#tb_cancelamentos');
dataTable('#tb_manutencao');
dataTable('#tb_abastecidas');


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


function verDocumento(documento)
{
	$.post("<?php echo e(asset('caixas/Documento')); ?>", {documento:documento}, function(resposta) 
	{				
	    $('#documento_titulo').html('Lançamentos de Venda');
	    
	    $('#itens_table_itens_cupom').html(null);
	    $.each(resposta.cupom, function(resp,r)
	      {      
	      	if(r.numero_cliente=='999999')
	    		$('#Nome_Cliente').val('999999 - Consumidor');	     
	    	else    	
	    		$('#Nome_Cliente').val(r.numero_cliente+" - "+r.nome_cliente);	     

	    	$('#Cond_pagto').val(r.numero_condpgto+" - "+r.nome_condpgto);   	
	    	$('#Data_Negociacao').val(r.datanegociacao_formatada);   	
	    	$('#Emissao').val(r.dataemissao_formatada);   	
	    	$('#Data_Vencimento').val(r.datavencimento_formatada);   	
	    	$('#Hora').val(r.hora);   	
	    	$('#ECF').val(r.ecf);   	
	    	$('#cnpj').val(r.cnpjcpfcliente);   	
	    	$('#Cupom').val(r.numeronota);   	
	    	$('#Funcionario').val(r.numero_funcionario+" - "+r.funcionario);   	
	    	$('#Motorista').val(r.motorista);   	
	    	$('#Placa').val(r.placa);   	
	    	$('#km').val(r.km);   	
	    	if(r.situacao=="I")
	    		$('#Tipo').val('Inserida');
	    	else   	
	    		$('#Tipo').val('Normal');

	    	$('#itens_table_itens_cupom').append("<tr>"+
									    			"<td>"+r.numero_produto+" - "+r.nome_produto+"</td>"+
									    			"<td>"+r.id_bomba+"</td>"+
									    			"<td>R$ "+r.precounitario+"</td>"+
									    			"<td>"+r.totallitros+"</td>"+
									    			"<td>R$ "+r.totaldinheiro.toFixed(2)+"</td>"+
									    		"</tr>");

	      });

	}, 'json')
	.done(function() {
	    $('#Modal_Documento').modal('show');
	});
}

</script>