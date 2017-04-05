@extends('painel.template.painel')
@section('titulo','Caixas')
@section('topo')
<section class="content-header">
  <h1>
    <i class="fa fa-money"></i>
    Caixa
    <small>{{str_pad($caixa->numero,6,"0",STR_PAD_LEFT)}}</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{asset('admin')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="{{asset('admin/caixas')}}"><i class="fa fa-money"></i> Caixas</a></li>
    <li class="active">Caixa {{str_pad($caixa->numero,6,"0",STR_PAD_LEFT)}}</li>
  </ol>
</section>
@stop
@section('conteudo')
<div class="row">
  <div class="col-md-4">
    <div class="box box-primary ">
        <div class="box-header">
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>      
            </div>

            <h3 class="box-title"><strong>Resumo</strong></h3>    
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <p><strong>Número     : </strong>{{str_pad($caixa->numero,6,"0",STR_PAD_LEFT)}}</p>
          <p><strong>Abertura   : </strong>{{dt_format($caixa->data_abertura,'d/m/Y')}} {{$caixa->hora_abertura}}</p>
          <p><strong>Situação   : </strong>{{$caixa->situacao}}</p>
          <p><strong>Fechamento : </strong>{{dt_format($caixa->data_fechamento,'d/m/Y')}} {{$caixa->hora_fechamento}}</p>
          <p><strong>Responsável : </strong>{{$caixa->funcionario}}</p>
          <p><strong>Valor Inicial : </strong>{{parametro('moeda')}} {{number_format($caixa->valor_inicial,parametro('qtde_dec_dinheiro'))}}</p>
          <hr>
          <?php $saldo=0;?>
          @foreach($caixa->cupons as $cupom)
            @if($cupom->excluido=='N')
              <?php $saldo+=$cupom->valortotalcupom;?>
            @endif
          @endforeach
          <p class="text-center"><strong>Saldo   : </strong>{{parametro('moeda')}} {{$saldo}}</p>          
        </div>
    </div>
  </div>
  <div class="col-md-8">

    <div class="col-md-12">
      <div class="box box-primary collapsed-box">
          <div class="box-header">
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" title="Explandir"><i class="fa fa-plus"></i></button>      
              </div>

              <h3 class="box-title"><strong>Abastecimentos</strong></h3>    
          </div>
          <!-- /.box-header -->
          <div class="box-body">
              <div class="row">
                <div class="col-md-12">

                  <table id="tab_abastecimentos" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>                          
                          <th>Bomba</th>
                          <th>Combustivel</th>                            
                          <th>Litros</th>                             
                          <th>Total</th>                            
                          <th>Data</th>                            
                          <th>Hora</th>                                
                        </tr>
                    </thead>
                    <tbody>
                      <?php   $valor_total = 0;$total_litros = 0;?>
                      @foreach($caixa->abastecimentos as $abastecimento)
                      <?php $valor_total += $abastecimento->total_dinheiro;  ?>
                      <?php $total_litros += $abastecimento->total_litros;  ?>
                        <tr>                          
                          <td>{{str_pad($abastecimento->bomba_codigo,6,"0",STR_PAD_LEFT)}}</td> 
                          <td>{{$abastecimento->bomba->tanque->produto->descricao}}</td>                          
                          <td>{{$abastecimento->total_litros}} {{$abastecimento->bomba->tanque->produto->unidade}}</td>                   
                          <td>{{parametro('moeda')}} {{number_format($abastecimento->preco,parametro('qtde_dec_dinheiro'))}}</td>
                          <td>{{dt_format($abastecimento->data),'d/m/Y'}}</td>                           
                          <td>{{$abastecimento->hora}}</td>                           
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                  <hr>
                  <div class="pull-right" style="text-align: right;">
                    <p><strong>Total :</strong> {{parametro('moeda')}} {{number_format($valor_total,parametro('qtde_dec_dinheiro'))}}</p>
                    <p><strong>Litros :</strong> {{$total_litros}} Litros</p>
                    <?php  
                      if(count($caixa->abastecimentos)>0)
                          $valor_medio = $valor_total/count($caixa->abastecimentos);
                      else
                          $valor_medio = 0;
                    ?>
                    <p><strong>Valor Médio de Abastecimento :</strong> {{parametro('moeda')}} {{number_format($valor_medio,parametro('qtde_dec_dinheiro'))}}</p>
                    <?php  
                      if(count($caixa->abastecimentos)>0)
                          $valor_medio = $total_litros/count($caixa->abastecimentos);
                      else
                          $valor_medio = 0;
                    ?>
                    <p><strong>Litragem Média de Abastecimento :</strong> {{$valor_medio}} Litros</p>
                  </div>
                </div>
              </div>
          </div>
      </div>
    </div>


     <div class="col-md-12">
      <div class="box box-primary collapsed-box">
          <div class="box-header">
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" title="Explandir"><i class="fa fa-plus"></i></button>      
              </div>

              <h3 class="box-title"><strong>Cupons</strong></h3>    
          </div>
          <!-- /.box-header -->
          <div class="box-body">
              <div class="row">
                <div class="col-md-12">


                    <table id="tab_cupons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>                          
                          <th>Número</th>                               
                          <th>Data</th>                               
                          <th>Hora</th>                               
                          <th>Valor</th>                               
                        </tr>
                    </thead>
                    <tbody>
                    <?php $qtde=0;?>
                      @foreach($caixa->cupons as $cupom)
                        @if($cupom->excluido=='N')
                          <?php $qtde++;?>
                          <tr>                          
                            <td>{{str_pad($cupom->numeronota,6,"0",STR_PAD_LEFT)}}</td> 
                            <td>{{dt_format($cupom->datanegociacao,'d/m/Y')}}</td> 
                            <td>{{$cupom->hora}}</td>
                            <td>{{parametro('moeda')}} {{number_format($cupom->valortotalcupom,parametro('qtde_dec_dinheiro'))}}</td>
                          </tr>
                        @endif
                      @endforeach
                    </tbody>
                  </table>
                  <hr>
                  <div class="pull-right" style="text-align: right;">
                  <p><strong>Total :</strong> {{parametro('moeda')}} {{number_format($saldo,parametro('qtde_dec_dinheiro'))}}</p>
                    <?php  
                      if($qtde>0)
                          $valor_medio = $saldo/$qtde;
                      else
                          $valor_medio = 0;
                    ?>
                    <p><strong>Valor Médio de cupons :</strong> {{parametro('moeda')}} {{number_format($valor_medio,parametro('qtde_dec_dinheiro'))}}</p>
                    
                  </div>


                </div>
              </div>
          </div>
      </div>
    </div>

    <div class="col-md-12">
      <div class="box box-primary collapsed-box">
          <div class="box-header">
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" title="Explandir"><i class="fa fa-plus"></i></button>      
              </div>

              <h3 class="box-title"><strong>Cancelamentos</strong></h3>    
          </div>
          <!-- /.box-header -->
          <div class="box-body">
              <div class="row">
                <div class="col-md-12">


                    <table id="tab_cancelamento" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>                          
                          <th>Número</th>                               
                          <th>Data</th>                               
                          <th>Hora</th>                               
                          <th>Valor</th>                               
                        </tr>
                    </thead>
                    <tbody>
                    <?php   $valor_total = 0;$qtde=0;?>
                      @foreach($caixa->cupons as $cupom)
                        @if($cupom->excluido=='C')
                        <?php $qtde++;?>
                        <?php $valor_total+=$cupom->valortotalcupom;?>
                          <tr>                          
                            <td>{{str_pad($cupom->numeronota,6,"0",STR_PAD_LEFT)}}</td> 
                            <td>{{dt_format($cupom->datanegociacao,'d/m/Y')}}</td> 
                            <td>{{$cupom->hora}}</td>
                            <td>{{parametro('moeda')}} {{number_format($cupom->valortotalcupom,parametro('qtde_dec_dinheiro'))}}</td>
                          </tr>
                        @endif
                      @endforeach
                    </tbody>
                  </table>
                  <hr>
                  <div class="pull-right" style="text-align: right;">
                  <p><strong>Total :</strong> {{parametro('moeda')}} {{number_format($valor_total,parametro('qtde_dec_dinheiro'))}}</p>
                  <p><strong>Qtde cancelamentos :</strong> {{$qtde}}</p>
                    
                  </div>


                </div>
              </div>
          </div>
      </div>
    </div>

    <div class="col-md-12">
      <div class="box box-primary collapsed-box">
          <div class="box-header">
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"  title="Explandir"><i class="fa fa-plus"></i></button>      
              </div>

              <h3 class="box-title"><strong>Manutenções</strong></h3>    
          </div>
          <!-- /.box-header -->
          <div class="box-body">
              <div class="row">
                <div class="col-md-12">




                </div>
              </div>
          </div>
      </div>
    </div>



  </div>
</div>



<script type="text/javascript">
dataTable('#tab_abastecimentos'); 
dataTable('#tab_cupons'); 
dataTable('#tab_cancelamento'); 
</script>
@stop