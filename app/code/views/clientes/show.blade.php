@extends('templates.principal.principal')

@section('titulo','Usuários')

@section('topo')
<h1>Clientes
  <small>Consulta</small>
</h1>
<ol class="breadcrumb">
  <li><a href="{{asset('inicio')}}"><i class="fa fa-dashboard"></i> Início</a></li>
  <li><a href="{{asset('clientes')}}"><i class="glyphicon glyphicon-user"></i> Clientes</a></li>
  <li><a><i class="glyphicon glyphicon-search"></i> Consulta</a></li>
</ol>
@stop


@section('conteudo')

<div class="col-md-12">
    <div class="box" style="padding-bottom:20px;">
      <div class="box-header with-border">
        <p class="title_box">Dados do Clientes</p>
        <div class="box-tools pull-right">
        </div>

        
          <div class="row" >
            <div class="col-md-2">
              <label>Número</label>
              <input class="form-control" value="{{$cliente->numero}}" readonly>
            </div>
            <div class="col-md-5">
              <label>Razão Social</label>
              <input class="form-control" value="{{$cliente->razaosocial}}" readonly>
            </div>
            <div class="col-md-5">
              <label>Nome Fantasia</label>
              <input class="form-control" value="{{$cliente->nome}}" readonly>
            </div>           
          </div>

          <div class="row" >
            <div class="col-md-4">
              <label>Inscrição Estadual</label>
              <input class="form-control" value="{{$cliente->inscricaoestadual}}" readonly>
            </div>
            <div class="col-md-4">
              <label>Inscrição Municipal</label>
              <input class="form-control" value="{{$cliente->inscricaomunicipal}}" readonly>
            </div>   
            <div class="col-md-4">
            @if($cliente->tipopessoa=="J")
              <label>CNPJ</label>
            @else
              <label>CPF</label>
            @endif
              <input class="form-control" value="{{$cliente->cnpj}}" readonly>
            </div>               
          </div>

          <div class="row" >
            <div class="col-md-6">
              <label>Email</label>
              <input class="form-control" value="{{$cliente->email}}" readonly>
            </div>
            <div class="col-md-3">
              <label>Contato Primário</label>
              <input class="form-control" value="{{$cliente->contato}}" readonly>
            </div>  
            <div class="col-md-3">
              <label>Contato Secundário</label>
              <input class="form-control" value="{{$cliente->contato2}}" readonly>
            </div>     
          </div>

          <div class="row" >
            <div class="col-md-12">
              <label>Site</label>
              <input class="form-control Centro"  value="{{$cliente->site}}" readonly>
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




<script src="{{PASTA_PUBLIC}}/template/plugins/jQuery/jquery.min.js"></script>
<script src="{{PASTA_PUBLIC}}/template/bootstrap/js/custom.js"></script>
<script type="text/javascript">
$('#btn_voltar').on('click', function() 
{
  window.history.back();
});
</script>



@stop