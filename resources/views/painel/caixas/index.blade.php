@extends('painel.template.painel')
@section('titulo','Caixas')

@section('topo')
<section class="content-header">
  <h1>
    <i class="fa fa-money"></i> Caixas
    <small> Listagem</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{asset('admin')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active"> Caixas</li>
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

                    <form  method="post">
                        <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />                        
                        <div class="col-md-3">
                            <label>Abertura datas :</label>
                            <input type="date" name="de_abertura" id="de_abertura" class="form-control" value="{{$filtro['de_abertura']}}">
                            <input type="date" name="ate_abertura" id="ate_abertura" class="form-control" value="{{$filtro['ate_abertura']}}">
                        </div>
                        <div class="col-md-2">
                            <label>Abertura horas :</label>
                            <input type="time" name="de_hora_abertura" id="de_hora_abertura" class="form-control" value="{{$filtro['de_hora_abertura']}}">
                            <input type="time" name="ate_hora_abertura" id="ate_hora_abertura" class="form-control" value="{{$filtro['ate_hora_abertura']}}" >
                        </div>
                        <div class="col-md-3">
                            <label>Abertura datas :</label>
                            <input type="date" name="de_fechamento" id="de_fechamento" class="form-control" value="{{$filtro['de_fechamento']}}">
                            <input type="date" name="ate_fechamento" id="ate_fechamento" class="form-control" value="{{$filtro['ate_fechamento']}}">
                        </div>
                        <div class="col-md-2">
                            <label>Abertura horas :</label>
                            <input type="time" name="de_hora_fechamento" id="de_hora_fechamento" class="form-control" value="{{$filtro['de_hora_fechamento']}}">
                            <input type="time" name="ate_hora_fechamento" id="ate_hora_fechamento" class="form-control" value="{{$filtro['ate_hora_fechamento']}}" >
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
                        <table id="tab_caixas" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th style="display: none;">id</th>            
                                    <th>Número</th>
                                    <th>Responsável</th>                            
                                    <th>Situação</th>                            
                                    <th>Valor Inicial</th>                            
                                    <th>Abertura</th>                            
                                    <th>Fechamento</th>                            
                                    <th class="text-center"><span class="fa fa-gears"></span></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($caixas as $caixa)
                                <tr>
                                    <td style="display: none;">{{$caixa->_id}}</td>
                                    <td>{{str_pad($caixa->numero,6,"0",STR_PAD_LEFT)}}</td>
                                    <td>{{$caixa->funcionario}}</td>
                                    <td>{{$caixa->situacao}}</td>
                                    <td>{{parametro('moeda')}} {{number_format($caixa->valor_inicial,parametro('qtde_dec_dinheiro'))}}</td>  
                                    <td>{{dt_format($caixa->data_abertura)}} {{$caixa->hora_abertura}}</td>
                                    <td>{{dt_format($caixa->data_fechamento)}} {{$caixa->hora_fechamento}}</td>
                                    <td class="text-center" >
                                        @if(can('caixas','get'))
                                        <a type="button" class="btn btn-info btn-sm" href="{{asset('admin/caixas/show/'. base64_encode($caixa->_id))}}">
                                            <i class="glyphicon glyphicon-eye-open"></i> Ver
                                        </a>
                                        @endif
                                    </td>
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

<script type="text/javascript">
var table = dataTable('#tab_caixas'); 


</script>
@stop