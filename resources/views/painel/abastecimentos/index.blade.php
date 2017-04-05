@extends('painel.template.painel')
@section('titulo','Abastecimentos')

@section('topo')
<section class="content-header">
  <h1>
    <i class="fa fa-road"></i> Abastecimentos
    <small> Listagem</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{asset('admin')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active"> Abastecimentos</li>
  </ol>
</section>
@stop

@section('conteudo')
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
          <!-- /.box-header -->
            <div class="box-body">
                <div class="row">

                    <form action="{{asset('admin/abastecimentos')}}" method="post">
                        <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                        <div class="col-md-2">
                            <label>Bico</label>
                            <select class="form-control" id="bico" name="bico">
                                <option value="TODOS">Todos</option>
                                @foreach($bicos as $bico)
                                    <option @if($filtro['bico']==$bico->numero) selected @endif value="{{$bico->numero}}" >Bico {{$bico->numero}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>Entre datas :</label>
                            <input type="date" name="de" id="de" class="form-control" value="{{$filtro['de']}}">
                            <input type="date" name="ate" id="ate" class="form-control" value="{{$filtro['ate']}}">
                        </div>
                        <div class="col-md-2">
                            <label>Entre horas :</label>
                            <input type="time" name="de_hora" id="de_hora" class="form-control" value="{{$filtro['de_hora']}}">
                            <input type="time" name="ate_hora" id="ate_hora" class="form-control" value="{{$filtro['ate_hora']}}" >
                        </div>
                        <div class="1">
                            <label>FIltrar</label><br>
                            <button class="btn btn-sm btn-primary"><i class="fa fa-search"></i></button>
                        </div>
                    </form>

                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <table id="tab_abastecimentos" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th style="display: none;">id</th>    
                                    <th>Bomba</th>
                                    <th>Combustivel</th>                            
                                    <th>Litros</th>                            
                                    <th>Preço</th>                            
                                    <th>Total</th>                            
                                    <th>Data</th>                            
                                    <th>Hora</th>                            
                                    <th>Registro</th>                            
                                    <th class="text-center"><span class="fa fa-gears"></span></th>
                                </tr>
                            </thead>
                            <?php   $valor_total = 0;$total_litros = 0;?>
                            @foreach($abastecimentos as $abastecimento)
                            <?php $valor_total += $abastecimento->total_dinheiro;  ?>
                            <?php $total_litros += $abastecimento->total_litros;  ?>
                            <tbody>                        
                                <tr>
                                    <td style="display: none;">{{$abastecimento->_id}}</td>  
                                    <td>{{str_pad($abastecimento->bomba_codigo,6,"0",STR_PAD_LEFT)}}</td>  
                                    <td>{{$abastecimento->bomba->tanque->produto->descricao}}</td>  
                                    <td>{{$abastecimento->total_litros}} {{$abastecimento->bomba->tanque->produto->unidade}}</td>  
                                    <td>{{parametro('moeda')}} {{number_format($abastecimento->preco,parametro('qtde_dec_dinheiro'))}}</td>
                                    <td>{{parametro('moeda')}} {{number_format($abastecimento->total_dinheiro,parametro('qtde_dec_dinheiro'))}}</td>  
                                    <td>{{dt_format($abastecimento->data),'d/m/Y'}}</td>  
                                    <td>{{$abastecimento->hora}}</td>
                                    <td>{{str_pad($abastecimento->registro,6,"0",STR_PAD_LEFT)}}</td> 
                                    <td>
                                        @if(can('abastecimentos','get'))
                                        <a type="button" class="btn btn-info btn-sm" href="{{asset('admin/abastecimentos/show/'. base64_encode($abastecimento->_id))}}">
                                            <i class="glyphicon glyphicon-eye-open"></i> Ver Cupom
                                        </a>
                                        @endif
                                    </td>  
                                </tr>
                            </tbody>
                            @endforeach
                        </table>
                        <hr>
                        <h3><strong>Resumo</strong></h3>
                        <p><strong>Total :</strong> {{parametro('moeda')}} {{number_format($valor_total,parametro('qtde_dec_dinheiro'))}}</p>
                        <p><strong>Litros :</strong> {{$total_litros}} Litros</p>
                        <?php  
                            if(count($abastecimentos)>0)
                                $valor_medio = $valor_total/count($abastecimentos);
                            else
                                $valor_medio = 0;

                        ?>
                        <p><strong>Valor Médio de Abastecimento :</strong> {{parametro('moeda')}} {{number_format($valor_medio,parametro('qtde_dec_dinheiro'))}}</p>

                        <?php  
                            if(count($abastecimentos)>0)
                                $valor_medio = $total_litros/count($abastecimentos);
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

<script type="text/javascript">
var table = dataTable('#tab_abastecimentos'); 

function mostrar(operador)
{
    var codigo_tipo = $('#tipos').val();
    var codigo_grupo = $('#grupos').val();
    send('post',"{{asset('admin/products')}}",{operador:'grupos',codigo_tipo:codigo_tipo,codigo_grupo:codigo_grupo},null);       
}

</script>
@stop