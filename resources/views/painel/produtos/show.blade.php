@extends('painel.template.painel')
@section('titulo','Produtos')

@section('topo')
<section class="content-header">
  <h1>
    <i class="fa fa-cubes"></i> Produtos
    <small> Visualização</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{asset('admin')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active"><a href="{{asset('admin/products')}}"><i class="fa fa-cubes"></i> Produtos</li>
  </ol>
</section>
@stop


@section('conteudo')
<div class="row">
  <div class="col-md-12">
      <div class="box" style="padding-bottom:20px;">
        <div class="box-header with-border">
          <p class="title_box">Dados do Produto</p>
          <div class="box-tools pull-right">
          </div>


            <div class="row">
              <div class="col-md-2">
                <h4><strong>Código : </strong>{{str_pad($produto->codigo,6,"0",STR_PAD_LEFT)}}</h4>
              </div>              
              <div class="col-md-4">
                @if($produto->tipoproduto=="C")
                  <h4><strong>Descrição : </strong>Combustivel</h4>
                @elseif($tipoproduto=="S")
                  <h4><strong>Descrição : </strong>Serviço</h4>
                @elseif($tipoproduto=="P")
                  <h4><strong>Descrição : </strong>Produto</h4>
                @endif
              </div>
              <div class="col-md-6">
                <h4><strong>Descrição : </strong>{{$produto->descricao}}</h4>
              </div>
            </div>
            <div class="row">
              <div class="col-md-5">
                  @if($produto->ultimavenda=="")
                    <h4><strong>Ultima venda : </strong>Nunca foi vendido</h4>
                  @else
                    <h4><strong>Ultima venda : </strong>{{dt_format($produto->ultimavenda,'d/m/Y')}}</h4>                    
                  @endif
              </div>
            </div>
            <hr>

            <div class="row">
              <div class="col-md-6">
                <div class="input-group input-group-sm"> 
                    <span class="input-group-addon">Nome</span> 
                    <input type="text" class="form-control" value="{{$produto->nome}}" disabled="" required=""> 
                </div>
              </div>
              <div class="col-md-4">
                <div class="input-group input-group-sm"> 
                    <span class="input-group-addon">Código de Barras</span> 
                    <input type="text" class="form-control" value="{{$produto->codigobarras}}" disabled="" required=""> 
                </div>
              </div>
              <div class="col-md-2">
                <div class="input-group input-group-sm"> 
                    <span class="input-group-addon">Estoque</span> 
                    <input type="text" class="form-control" value="{{$produto->estoque}}" disabled="" required=""> 
                </div>
              </div>
            </div>    

            <div class="row">
              <div class="col-md-2">
                <div class="input-group input-group-sm"> 
                    <span class="input-group-addon">Un. Venda</span> 
                    <input type="text" class="form-control" value="{{$produto->unidade}}" disabled="" required=""> 
                </div>
              </div>
              <div class="col-md-2">
                <div class="input-group input-group-sm"> 
                    <span class="input-group-addon">Un. Compra</span> 
                    <input type="text" class="form-control" value="{{$produto->unidadeentrada}}" disabled="" required=""> 
                </div>
              </div>
              <div class="col-md-2">
                <div class="input-group input-group-sm"> 
                    <span class="input-group-addon">Preço</span> 
                    <input type="text" class="form-control" value="{{parametro('moeda')}} {{number_format($produto->precovenda,parametro('qtde_dec_dinheiro'))}}" disabled="" required=""> 
                </div>
              </div>
              <div class="col-md-2">
                <div class="input-group input-group-sm"> 
                    <span class="input-group-addon">Custo</span> 
                    <input type="text" class="form-control" value="{{parametro('moeda')}} {{number_format($produto->custoatual,parametro('qtde_dec_dinheiro'))}}" disabled="" required=""> 
                </div>
              </div>
              <div class="col-md-4">
                <div class="input-group input-group-sm"> 
                    <span class="input-group-addon">Lucro Básico</span> 
                    <input type="text" class="form-control" value="{{parametro('moeda')}} {{number_format(($produto->precovenda-$produto->custoatual),parametro('qtde_dec_dinheiro'))}} ({{porcentagem($produto->precovenda,$produto->custoatual)-100}} %)" disabled="" required=""> 
                </div>
              </div>
            </div>  

            <hr>

            <div class="row">
              <div class="col-md-6">
                <div class="input-group input-group-sm"> 
                    <span class="input-group-addon">Grupo de Produto</span> 
                    <input type="text" class="form-control" value="{{$produto->grupoproduto->descricao}}" disabled="" required="">
                </div>
              </div>  
              <div class="col-md-6">
                <div class="input-group input-group-sm"> 
                    <span class="input-group-addon">Tipo de Produto</span> 
                    <input type="text" class="form-control" value="{{$produto->tiposproduto->descricao}}" disabled="" required="">
                </div>
              </div>            
            </div> 

            <hr>             
                                
            <div class="row">
              <div class="col-md-2">
                <div class="input-group input-group-sm"> 
                    <span class="input-group-addon">CST Entrada</span> 
                    <input type="text" class="form-control" value="{{$produto->cst_entrada}}" disabled="" required="">
                </div>
              </div>  
              <div class="col-md-2">
                <div class="input-group input-group-sm"> 
                    <span class="input-group-addon">CST Saida</span> 
                    <input type="text" class="form-control" value="{{$produto->cst_saida}}" disabled="" required="">
                </div>
              </div>    
              <div class="col-md-2">
                <div class="input-group input-group-sm"> 
                    <span class="input-group-addon">NCM</span> 
                    <input type="text" class="form-control" value="{{$produto->ncm}}" disabled="" required="">
                </div>
              </div>   
              <div class="col-md-3">
                <div class="input-group input-group-sm"> 
                    <span class="input-group-addon">ANP</span> 
                    <input type="text" class="form-control" value="{{$produto->anp}}" disabled="" required="">
                </div>
              </div>  
              <div class="col-md-3">
                <div class="input-group input-group-sm"> 
                    <span class="input-group-addon">CEST</span> 
                    <input type="text" class="form-control" value="{{$produto->cest}}" disabled="" required="">
                </div>
              </div>           
            </div> 

        </div>      
      </div> 
  </div>
</div>

<div class="row">  
  <div class="col-md-12">
    <button id="btn_voltar" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-arrow-left"></span> Voltar</button>
  </div>
</div>


<script type="text/javascript">
$('#btn_voltar').on('click', function() 
{
  window.history.back();
});
</script>
@stop