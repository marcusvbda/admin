@extends('painel.template.painel')
@section('titulo','Produtos')

@section('topo')
<section class="content-header">
  <h1>
    <i class="fa fa-cubes"></i> Produtos
    <small> Listagem</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{asset('admin')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Produtos</li>
  </ol>
</section>
@stop

@section('conteudo')
<div class="box box-primary">
  <!-- /.box-header -->
    <div class="box-body">
        <div class="row">
           <div class="col-md-12">

                <div class="row">
                    <div class="col-md-4">
                        <label>Grupos de Produto</label>
                        <select class="form-control" onchange="mostrar('grupo')" id="grupos">                            
                            <option @if($gp_tipo=="TODOS") selected @endif value="TODOS" >TODOS</option>
                            @foreach($grupos as $gp)
                                <option @if($gp_tipo==$gp->codigo) selected @endif value="{{$gp->codigo}}" >{{$gp->descricao}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label>Tipos de Produto</label>
                        <select class="form-control" onchange="mostrar('tipo')" id="tipos">                            
                            <option @if($tp_tipo=="TODOS") selected @endif >TODOS</option>
                            @foreach($tipos as $tp)
                                <option @if($tp_tipo==$tp->codigo) selected @endif value="{{$tp->codigo}}">{{$tp->descricao}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>                   
           </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12">
                <table id="tab_pessoas" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th style="display: none;">id</th>                              
                            <th>Código</th>
                            <th>Cod. Barras</th>
                            <th>nome</th>                            
                            <th>Preço</th>                            
                            <th>Custo</th>                            
                            <th class="text-center"><span class="fa fa-gears"></span></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($produtos as $prod)
                        <tr>    
                            <td style="display: none;">{{$prod->_id}}</td>                                   
                            <td>{{str_pad($prod->codigo,6,"0",STR_PAD_LEFT)}}</td>
                            <td>{{$prod->codigobarras}}</td>
                            <td>{{$prod->nome}}</td>
                            <td>{{parametro('moeda')}} {{number_format($prod->precovenda,parametro('qtde_dec_dinheiro'))}}</td>
                            <td>{{parametro('moeda')}} {{number_format($prod->custoatual,parametro('qtde_dec_dinheiro'))}}</td>
                            <td class="text-center" >
                                @if(can('produtos','get'))
                                <a type="button" class="btn btn-info btn-sm" href="{{asset('admin/products/show/'. base64_encode($prod->_id))}}">
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

<script type="text/javascript">
var table = dataTable('#tab_pessoas'); 

function mostrar(operador)
{
    var codigo_tipo = $('#tipos').val();
    var codigo_grupo = $('#grupos').val();
    send('post',"{{asset('admin/products')}}",{operador:'grupos',codigo_tipo:codigo_tipo,codigo_grupo:codigo_grupo},null);       
}

</script>
@stop