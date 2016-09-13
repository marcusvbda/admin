<?php $__env->startSection('titulo','Produtos'); ?>

<?php $__env->startSection('topo'); ?>
<h1>Produtos
  <small>Consulta</small>
</h1>
<ol class="breadcrumb">
  <li><a href="<?php echo e(asset('admin/inicio')); ?>"><i class="fa fa-dashboard"></i> Início</a></li>
  <li><a href="<?php echo e(asset('admin/produtos')); ?>"><i class="glyphicon glyphicon-erase"></i> Produtos</a></li>
  <li><a><i class="glyphicon glyphicon-search"></i> Consulta</a></li>
</ol>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('conteudo'); ?>

<div class="col-md-12">
    <div class="box" style="padding-bottom:20px;">
      <div class="box-header with-border">
        <p class="title_box">Dados do Produto</p>
        <div class="box-tools pull-right">
        </div>


          <div class="row">
            <div class="col-md-2">
              <h4><strong>Código : </strong><?php echo e($produto->codigo); ?></h4>
            </div>
            <div class="col-md-10">
              <h4><strong>Descrição : </strong><?php echo e($produto->descricao); ?></h4>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-md-12">
              <ul class="nav nav-pills">
                <li class="active"><a data-toggle="pill" href="#gerais">Gerais</a></li>
                <li><a data-toggle="pill" href="#codigos">Códigos</a></li>
                <li><a data-toggle="pill" href="#tributacao">Tributação</a></li>
                <li><a data-toggle="pill" href="#resumo">Resumo</a></li>
              </ul>            
              <div class="tab-content">
                <div id="gerais" class="tab-pane fade in active">
                <br>

                  <div class="row">
                    <div class="col-md-9">
                      <label>Nome Fantasia</label>
                      <input type="text" readonly class="form-control" value="<?php echo e($produto->nomefantasia); ?>">
                    </div>  
                    <div class="col-md-3">
                      <label>Tipo</label>
                      <?php if($produto->tipoproduto=="C"): ?>
                          <input type="text" readonly class="form-control" value="Combustivel">
                      <?php elseif($produto->tipoproduto=="P"): ?>
                        <input type="text" readonly class="form-control" value="Produto">
                      <?php elseif($produto->tipoproduto=="S"): ?>
                        <input type="text" readonly class="form-control" value="Serviço">
                      <?php endif; ?>                     
                    </div>                 
                  </div>
                  <div class="row">
                    <div class="col-md-2">
                      <label>Unidade Venda</label>
                      <input type="text" readonly class="form-control" value="<?php echo e($produto->unidade); ?>">
                    </div> 
                    <div class="col-md-2">
                      <label>Unidade Compra</label>
                      <input type="text" readonly class="form-control" value="<?php echo e($produto->unidadeentrada); ?>">
                    </div> 
                    <div class="col-md-2">
                      <label>Itens Embalagem</label>
                      <input type="text" readonly class="form-control" value="<?php echo e($produto->unidadeconversao); ?>">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <label>Tipo Produto</label>
                      <input type="text" readonly class="form-control" value="<?php echo e($produto->desc_tipoproduto); ?>">
                    </div> 
                    <div class="col-md-6">
                      <label>Grupo Produto</label>
                      <input type="text" readonly class="form-control" value="<?php echo e($produto->desc_grupoproduto); ?>">
                    </div> 
                  </div>
                  <div class="row">
                    <div class="col-md-2">
                      <label>Alteração Grupo</label>
                      <?php if($produto->unidadeconversao=='S'): ?>
                        <input type="text" readonly class="form-control" value="SIM" >
                      <?php else: ?>
                        <input type="text" readonly class="form-control" value="NÃO" >                        
                      <?php endif; ?>
                    </div> 
                    <div class="col-md-2">
                      <label>Comissionado</label>
                      <?php if($produto->comissionado=='S'): ?>
                        <input type="text" readonly class="form-control" value="SIM">
                      <?php else: ?>
                        <input type="text" readonly class="form-control" value="NÃO">                        
                      <?php endif; ?>
                    </div> 
                  </div>
                  <div class="row">
                    <div class="col-md-3">
                      <label>Venda Frente de Caixa</label>                   
                        <?php if($produto->vendafrentedecaixa=='S'): ?>
                          <input type="text" readonly class="form-control" value="SIM" >
                        <?php else: ?>
                          <input type="text" readonly class="form-control" value="NÃO" >                        
                        <?php endif; ?> 
                    </div> 
                    <div class="col-md-2">
                      <label>Arredondamento</label>
                       <!--  -->
                        <?php if($produto->arredondamentotruncamento=='T'): ?>
                          <input type="text" readonly class="form-control" value="Truncado" >
                        <?php else: ?>
                          <input type="text" readonly class="form-control" value="Arredondamento" >                        
                        <?php endif; ?> 
                    </div> 
                  </div>
                  <div class="row">
                    <div class="col-md-3">
                      <label>Bloquear Estoque Zerado</label>    
                        <?php if($produto->bloquearvendaestoquezerado=='S'): ?>
                          <input type="text" readonly class="form-control" value="SIM" >
                        <?php else: ?>
                          <input type="text" readonly class="form-control" value="NÃO" >                        
                        <?php endif; ?>               
                    </div> 
                    <div class="col-md-2">
                    <!--  -->
                      <label>Produção</label>
                        <?php if($produto->arredondamentotruncamento=='P'): ?>
                          <input type="text" readonly class="form-control" value="PRÓPRIA" >
                        <?php else: ?>
                          <input type="text" readonly class="form-control" value="TERCEIRO" >                        
                        <?php endif; ?>   
                    </div> 
                  </div>
                  <div class="row">
                    <div class="col-md-3">
                      <label>Estoque Mínimo</label>
                      <input type="number" step="any"  class="form-control" readonly value="<?php echo e($produto->estoqueregulador); ?>">
                    </div>
                  </div>

                </div>
                <div id="codigos" class="tab-pane fade">
                <br>
                  

                  <div class="row">
                    <div class="col-md-3">
                      <label>Cód.Estendido</label>
                      <input type="text" class="form-control" readonly="" value="<?php echo e($produto->codigoestendido); ?>">
                    </div>
                    <div class="col-md-3">
                      <label>Cód.Barras</label>
                      <input type="text" class="form-control" readonly="" value="<?php echo e($produto->codigobarras); ?>">
                    </div>
                    <div class="col-md-3">
                      <label>Cód.Fabricante</label>
                      <input type="text" class="form-control" readonly="" value="<?php echo e($produto->codigofabricante); ?>">
                    </div>
                    <div class="col-md-3">
                      <label>Cód.NCM</label>
                      <input type="text" class="form-control" readonly="" value="<?php echo e($produto->codigo_nbmsh); ?>">
                    </div>
                  </div>              
                  
                  <div class="row">                    
                    <div class="col-md-3">
                      <label>Cód.ANP</label>
                      <input type="text" class="form-control" readonly="" value="<?php echo e($produto->codigoanp); ?>">
                    </div>
                    <div class="col-md-3">
                      <label>Cód.Ticket</label>
                      <input type="text" class="form-control" readonly="" value="<?php echo e($produto->codigoticket); ?>">
                    </div>
                    <div class="col-md-3">
                      <label>Cód.Tp.Serviço</label>
                      <input type="text" class="form-control" readonly="" value="<?php echo e($produto->codigotiposervico); ?>">
                    </div>
                    <div class="col-md-3">
                      <label>Cód.Nat.Receita</label>
                      <input type="text" class="form-control" readonly="" value="<?php echo e($produto->codigonaturezareceita); ?>">
                    </div>
                  </div>            
                 
                                 

                  <div class="row">
                    <div class="col-md-3">
                      <label>Cód.SAP</label>
                      <input type="text" class="form-control" readonly="" value="<?php echo e($produto->codigo_sap); ?>">
                    </div>
                    <div class="col-md-3">
                      <label>Cód.CEST</label>
                      <input type="text" class="form-control" readonly="" value="<?php echo e($produto->codigo_cest); ?>">
                    </div>
                  </div>
                </div>



                <div id="tributacao" class="tab-pane fade">
                <br>
                  <div class="row">
                    <div class="col-md-2">
                      <label>CST Saida</label>
                      <input type="text" class="form-control" readonly value="<?php echo e($produto->codigo_st); ?>">
                    </div>
                    <div class="col-md-10">
                      <label>Descrição</label>
                      <input type="text" class="form-control" readonly value="<?php echo e($produto->desc_cstsaida); ?>">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-2">
                      <label>CST Entrada</label>
                      <input type="text" class="form-control" readonly value="<?php echo e($produto->codigo_stentrada); ?>">
                    </div>
                    <div class="col-md-10">
                      <label>Descrição</label>
                      <input type="text" class="form-control" readonly value="<?php echo e($produto->desc_cst_entrada); ?>">
                    </div>
                  </div>

                  <div class="col-md-12" style="border:1px solid #D2D6DE;margin-top:30px;margin-bottom:30px;padding-top:30px;padding-bottom:30px;">
                    <div class="col-md-4">
                      <label>Calcula PIS</label>
                      <?php if($produto->calculapis=="S"): ?>
                        <input type="text" class="form-control" readonly value="SIM">
                      <?php else: ?>
                        <input type="text" class="form-control" readonly value="NÃO">
                      <?php endif; ?> 
                    </div>
                    <div class="col-md-4">
                      <label>CST PIS</label>
                      <input type="text" class="form-control" readonly  value="<?php echo e($produto->cstpis); ?>">
                    </div>
                    <div class="col-md-4">
                      <label>CST PIS Entrada</label>
                      <input type="text" class="form-control" readonly  value="<?php echo e($produto->cstpisentrada); ?>">
                    </div>
                    <div class="col-md-4">
                      <label>Aliquota PIS</label>
                      <input type="text" class="form-control" readonly value="<?php echo e($produto->aliquotapis); ?>">
                    </div>

                    <div class="col-md-4">
                      <label>Calcula COFINS</label>
                      <?php if($produto->calculacofins=="S"): ?>
                        <input type="text" class="form-control" readonly value="SIM">
                      <?php else: ?>
                        <input type="text" class="form-control" readonly value="NÃO">
                      <?php endif; ?> 
                    </div>
                    <div class="col-md-4">
                      <label>CST COFINS</label>
                      <input type="text" class="form-control" readonly  value="<?php echo e($produto->cstcofins); ?>">
                    </div>
                    <div class="col-md-4">
                      <label>CST COFINS Entrada</label>
                      <input type="text" class="form-control" readonly  value="<?php echo e($produto->cstcofinsentrada); ?>">
                    </div>
                    <div class="col-md-4">
                      <label>Aliquota COFINS</label>
                      <input type="text" class="form-control" readonly  value="<?php echo e($produto->aliquotacofins); ?>">
                    </div>

                    <div class="col-md-4">
                      <label>Aliquota ICMS</label>
                      <input type="text" class="form-control" readonly value="<?php echo e($produto->aliquotaicms); ?>">
                    </div>
                    <div class="col-md-4">
                      <label>Aliquota ISS</label>
                      <input type="text" class="form-control" readonly value="<?php echo e($produto->aliquotaiss); ?>">
                    </div>
                    <div class="col-md-4">
                      <label>Aliquota ICMS Reduzida</label>
                      <input type="text" class="form-control" readonly  value="<?php echo e($produto->aliquotaicmsreduzida); ?>">
                    </div>
                    <div class="col-md-4">
                      <label>Aliquota MVA ST</label>
                      <input type="text" class="form-control" readonly  value="<?php echo e($produto->mvast); ?>">
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-3">
                    <label>Aliquota IPI</label>
                      <input type="text" class="form-control" readonly value="<?php echo e($produto->aliquotaipi); ?>">
                    </div>
                    <div class="col-md-3">
                    <label>ICMS Outros UF</label>
                      <input type="text" class="form-control" readonly value="<?php echo e($produto->icmsoutros); ?>">
                    </div>
                  </div>




                </div>


                <div id="resumo" class="tab-pane fade">
                <br>

                  <div class="row">
                    <div class="col-md-4">
                        <label>Data Cadastro</label>
                        <input type="text" class="form-control" readonly value="<?php echo e(data_formatada($produto->datacadastro)); ?>">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                        <label>Estoque Atual</label>
                        <input type="text" class="form-control" readonly value="<?php echo e($produto->estoque); ?>">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                        <label>Última Venda</label>
                        <input type="text" class="form-control" readonly value="<?php echo e(data_formatada($produto->ultimavenda)); ?>">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                        <label>Útilma Compra</label>
                        <input type="text" class="form-control" readonly value="<?php echo e(data_formatada($produto->ultimacompra)); ?>">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                        <label>Último Custo</label>
                        <input type="text" class="form-control" readonly value="<?php echo e(format_reais($produto->ultimocusto)); ?>">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                        <label>Custo Atual</label>
                        <input type="text" class="form-control" readonly value="<?php echo e(format_reais($produto->custoatual)); ?>">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                        <label>Data Custo Atual</label>
                        <input type="text" class="form-control" readonly value="<?php echo e(data_formatada($produto->datacustoatual)); ?>">
                    </div>
                  </div>


                </div>
             </div>
            </div>

         </div>
                              
          

      </div>      
    </div> 
</div>

<div class="col-md-12">   
    <div class="row">
      <div id="btn_visualizacao">
        <div class="col-md-6">
          <button id="btn_voltar" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-left"></span> Voltar</button>
        </div>
      </div>     
    </div>
</div>




<script src="<?php echo e(PASTA_PUBLIC); ?>/template/plugins/jQuery/jquery.min.js"></script>
<script src="<?php echo e(PASTA_PUBLIC); ?>/template/bootstrap/js/custom.js"></script>
<script type="text/javascript">
$('#btn_voltar').on('click', function() 
{
  window.history.back();
});
</script>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('templates.principal.principal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>