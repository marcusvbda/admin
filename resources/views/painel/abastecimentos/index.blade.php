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
<div class="box box-primary">
  <!-- /.box-header -->
    <div class="box-body">
        <div class="row">
           <div class="col-md-12">

<!-- filtros -->

           </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12">
                <table id="tab_abastecimentos" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th style="display: none;">id</th>                              
                            <th>Registro</th>
                            <th>Bomba</th>
                            <th>Combustivel</th>                            
                            <th>Total</th>                            
                            <th>Preço</th>                            
                            <th>Total</th>                            
                            <th>Data</th>                            
                            <th>Hora</th>                            
                            <th class="text-center"><span class="fa fa-gears"></span></th>
                        </tr>
                    </thead>
                    @foreach($abastecimentos as $abastecimento)
                        <tr>
                            <td style="display: none;">{{$abastecimento->_id}}</td>  
                            <td>{{str_pad($abastecimento->registro,6,"0",STR_PAD_LEFT)}}</td>  
                            <td>{{str_pad($abastecimento->bomba_codigo,6,"0",STR_PAD_LEFT)}}</td>  
                            <td>{{$abastecimento->bomba->tanque->produto->descricao}}</td>  
                            <td>{{$abastecimento->total_litros}} {{$abastecimento->bomba->tanque->produto->unidade}}</td>  
                            <td>{{parametro('moeda')}} {{number_format($abastecimento->preco,parametro('qtde_dec_dinheiro'))}}</td>
                            <td>{{parametro('moeda')}} {{number_format($abastecimento->total_dinheiro,parametro('qtde_dec_dinheiro'))}}</td>  
                            <td>{{dt_format($abastecimento->data),'d/m/Y'}}</td>  
                            <td>{{$abastecimento->hora}}</td>
                            <td>
                                @if(can('abastecimentos','get'))
                                <a type="button" class="btn btn-info btn-sm" href="{{asset('admin/abastecimentos/show/'. base64_encode($abastecimento->_id))}}">
                                    <i class="glyphicon glyphicon-eye-open"></i> Ver
                                </a>
                                @endif
                            </td>  
                        </tr>
                    @endforeach
                    <tbody>
                   
                    </tbody>
                </table>

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