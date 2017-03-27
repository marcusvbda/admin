@extends('painel.template.painel')
@section('titulo','Produtos')

@section('topo')
<section class="content-header">
  <h1>
    <i class="fa fa-cubes"></i> Produtos
    <small> Listagem e Ações</small>
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
                

                <div class="pull-right">
                   @if(can('produtos','post'))
                   <a type="button" class="btn btn-primary btn-sm" href="{{asset('admin/products/create')}}" style="display: none"><i class="fa fa-plus-circle" ></i> Novo</a>
                   @endif
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
                <hr>
                <div class="row" style="display: none;">    
                    <div class="col-md-12">  
                        <div class="pull-left">   
                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Ações
                                </button>
                                <ul class="dropdown-menu">
                                    @if(can('produtos','put'))
                                    <li class="col-md-12">
                                        <a  class="btn btn-warning btn-sm" onclick="bloquear()">
                                           <span class="glyphicon glyphicon-lock"></span> Bloquear / Desbloquear
                                        </a>   
                                    </li>
                                    @endif
                                    @if(can('produtos','delete'))
                                    <br>
                                    <hr>
                                    <br>
                                    <li class="col-md-12">
                                      <a  class="btn btn-danger btn-sm" onclick="excluir()" disbled>
                                         <span class="fa fa-trash"></span> Excluir
                                     </a>         
                                    </li>
                                    @endif
                                </ul>
                            </div>                    
                        </div>
                    </div>
                </div>

            </div>
        </div>



    </div>
</div>

<script type="text/javascript">
var table = dataTable('#tab_pessoas'); 

function getSelecionados()
{
    var dados = table.rows('.selected').data();
    var selecionados = [];
    for (var i=0; i < dados.length ;i++)
    {
       selecionados[i] = dados[i][0];
    }
    return selecionados;
}

function excluir()
{
    var selecionados = getSelecionados();
    if(selecionados.length<=0)
        return msg('Oops','Nenhum item selecionado para ação','error');
    msg_confirm('Confirmação',"Deseja mesmo excluir os produtos selecionado(s) ?",function()
    {   
        xCode.ajax("delete","{{asset('admin/products/destroy')}}",{selecionados}).then(function(response)
        {
            if(response.success)         
                msg_stop(":)",response.msg,function()
                {
                    reload();
                });
            else
                return msg("Oops",response.msg,"error"); 
        });    
    });    
}

function bloquear()
{
    var selecionados = getSelecionados();
    if(selecionados.length<=0)
        return msg('Oops','Nenhum item selecionado para ação','error');
    msg_confirm('Confirmação',"Deseja mesmo bloquear os produtos selecionado(s) ?",function()
    {   
        xCode.ajax("put","{{asset('admin/products/bloquear')}}",{selecionados}).then(function(response)
        {
            if(response.success)         
                msg_stop(":)",response.msg,function()
                {
                    reload();
                });
            else
                return msg("Oops",response.msg,"error"); 
        });    
    });    
}

function mostrar(operador)
{
    var codigo_tipo = $('#tipos').val();
    var codigo_grupo = $('#grupos').val();
    send('post',"{{asset('admin/products')}}",{operador:'grupos',codigo_tipo:codigo_tipo,codigo_grupo:codigo_grupo},null);       
}

</script>
@stop