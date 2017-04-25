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
          
          
          <?php 
            $saldo=0;
            $saldo_cancelamento=0;
            $qtde_cancelamentos=0;
            $qtde_cupons=0;
            $qtde_abastecimentos = 0;
            $qtde_manutencao = 0;
            if(count($caixa->manutencao)>0)
              $qtde_manutencao = $caixa->manutencao->count();
            if(count($caixa->abastecimentos)>0)
              $qtde_abastecimentos = $caixa->abastecimentos->count();
            foreach($caixa->cupons as $cupom):
              if($cupom->excluido=='N'):
                $qtde_cupons++;
                $saldo+=$cupom->valortotalcupom;                  
              elseif($cupom->excluido=='C'):
                $qtde_cancelamentos++;
                $saldo_cancelamento+=$cupom->valortotalcupom;           
              endif; 
            endforeach;
          ?>

          <p><strong>Total de Cancelamentos : </strong>{{parametro('moeda')}} {{number_format($saldo_cancelamento,parametro('qtde_dec_dinheiro'))}} </p>
          <hr>

          <p class="text-center"><strong>Saldo   : </strong>{{parametro('moeda')}} {{number_format($saldo,parametro('qtde_dec_dinheiro'))}}</p>          
        </div>
    </div>
  </div>
  <div class="col-md-8">


    <div class="col-md-12">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#abastecimentos" data-toggle="tab" aria-expanded="true">Abastecimentos ({{$qtde_abastecimentos}})</a></li>
          <li class=""><a href="#vendas" data-toggle="tab" aria-expanded="false">Vendas ({{$qtde_cupons}})</a></li>
          <li class=""><a href="#cancelamentos" data-toggle="tab" aria-expanded="false">Cancelamentos ({{$qtde_cancelamentos}})</a></li>
          <li class=""><a href="#manutencoes" data-toggle="tab" aria-expanded="false">Manutenções ({{$qtde_manutencao}})</a></li>
        </ul>
        <div class="tab-content">

          <div class="tab-pane active" id="abastecimentos">   
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

          <div class="tab-pane" id="vendas">
            
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

          <div class="tab-pane" id="cancelamentos">
              
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
                      @foreach($caixa->cupons as $cupom)
                        @if($cupom->excluido=='C')
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
                  <p><strong>Total :</strong> {{parametro('moeda')}} {{number_format($saldo_cancelamento,parametro('qtde_dec_dinheiro'))}}</p>
                  <p><strong>Qtde cancelamentos :</strong> {{$qtde_cancelamentos}}</p> 
                  </div>


                </div>
              </div>

          </div>

          <div class="tab-pane" id="manutencoes">

            <div class="row">
                <div class="col-md-12">

                  <table id="tab_manutencoes" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>                          
                          <th>Documento</th>                               
                          <th>Tipo</th>                               
                          <th>Funcionário</th>                               
                          <th>Data</th>                               
                          <th>Hora</th>                               
                          <th>Valor</th>                               
                        </tr>
                    </thead>
                    <tbody>
                    <?php $qtde=0;?>
                      @foreach($caixa->manutencao as $cupom)
                        <tr>                          
                          <td>{{str_pad($cupom->documento,6,"0",STR_PAD_LEFT)}}</td> 
                          <td>@if($cupom->tipo=="I") Inserção @elseif($cupom-tipo=="R") Retirada @endif</td> 
                          <td>{{$cupom->funcionario->nome}}</td> 
                          <td>{{dt_format($cupom->data,'d/m/Y')}}</td> 
                          <td>{{$cupom->hora}}</td>
                          <td>{{parametro('moeda')}} {{number_format($cupom->valor,parametro('qtde_dec_dinheiro'))}}</td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>              


                </div>
              </div>

          </div>


        </div>
      </div>
    </div>




  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="box box-primary ">
      <div class="box-header">
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>      
        </div>
        <h3 class="box-title"><strong>Movimentação por Grupo de Produto  %</strong></h3>    
      </div>
        <!-- /.box-header -->
      <div class="box-body">
        
          @foreach($porcentagem as $row)
            <div class="col-md-2 text-center">
              <input type="text" class="knob" value="{{$row->porcentagem}}" data-skin="tron" data-thickness="0.2" data-width="100" data-height="100" data-fgColor="{{randomColor()}}" data-readonly="true">
              <div class="knob-label">{{$row->descricao_grupo}}</div>
            </div>
          @endforeach        

      </div>
    </div>
  </div>
</div>



<script type="text/javascript">

dataTable('#tab_abastecimentos'); 
dataTable('#tab_cupons'); 
dataTable('#tab_cancelamento'); 
dataTable('#tab_manutencoes'); 
$(function () {
  /* jQueryKnob */

  $(".knob").knob({
    draw: function () {

      // "tron" case
      if (this.$.data('skin') == 'tron') {

        var a = this.angle(this.cv)  // Angle
            , sa = this.startAngle          // Previous start angle
            , sat = this.startAngle         // Start angle
            , ea                            // Previous end angle
            , eat = sat + a                 // End angle
            , r = true;

        this.g.lineWidth = this.lineWidth;

        this.o.cursor
        && (sat = eat - 0.3)
        && (eat = eat + 0.3);

        if (this.o.displayPrevious) {
          ea = this.startAngle + this.angle(this.value);
          this.o.cursor
          && (sa = ea - 0.3)
          && (ea = ea + 0.3);
          this.g.beginPath();
          this.g.strokeStyle = this.previousColor;
          this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sa, ea, false);
          this.g.stroke();
        }

        this.g.beginPath();
        this.g.strokeStyle = r ? this.o.fgColor : this.fgColor;
        this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sat, eat, false);
        this.g.stroke();

        this.g.lineWidth = 2;
        this.g.beginPath();
        this.g.strokeStyle = this.o.fgColor;
        this.g.arc(this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false);
        this.g.stroke();

        return false;
      }
    }
  });
  /* END JQUERY KNOB */

  //INITIALIZE SPARKLINE CHARTS
  $(".sparkline").each(function () {
    var $this = $(this);
    $this.sparkline('html', $this.data());
  });
});
</script>
@stop