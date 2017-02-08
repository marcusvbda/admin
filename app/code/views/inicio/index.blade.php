@extends('templates.principal.principal')

@section('titulo','Dashboard')

@section('topo')
<h1>Dashboard
  <small>Painel de controle</small>
</h1>
<ol class="breadcrumb">
  <li><i class="fa fa-dashboard"></i> Início</li>
</ol>
@stop



@section('conteudo')
<div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua" style="padding-top: 20px;"><i class="ion ion-ios-people-outline"></i></span>

            <a style="color:black" href="{{asset('usuarios')}}" title="clique para visualizar"><div class="info-box-content">
              <span class="info-box-text">Usuários</span>
              <?php $qtde_usuarios = Controller::exec('usuariosController','qtde');  ?>
              <span class="info-box-number">{{$qtde_usuarios}}<small> Cadastrado @if($qtde_usuarios>1){{'s'}}@endif</small></span>
            </div></a>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow" style="padding-top: 20px;"><i class="ion ion-ios-gear-outline"></i></span>

            <a style="color:black" href="{{asset('rede')}}" title="clique para visualizar"><div class="info-box-content">
              <span class="info-box-text">Rede</span>
               <span class="info-box-number"><small>{{Controller::exec('empresaController','getRede')}}</small></span>
            </div></a>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
         <div class="info-box">
            <span class="info-box-icon bg-red" style="width: 100%;"><span id="data">{{date('d/m/Y')}}</span></span>

           
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green" style="width: 100%;"><span id="relogio"></span></span>

           
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>

<div class="row">
  <div class="col-md-12">
    <div class="box"  id="movimento_porcento_circulos">
      <div class="box-header" style="height: 10px">
            <p class="title_box">Movimento Grupos de Produto (%)</p>  
            <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse">
              <i class="fa fa-minus"></i>
            </button>                   
          </div>  
      </div>
      <div class="box-body"> 
        <!-- conteudo -->        
          <div class="row text-center" id="div_loading_grupos" style="height: 200px;" title="Carregando ...">      
            <img src="{{asset('template/img/loading.gif')}}">
          </div>

          <div class="row" id="div_conteudo_grupos" style="display: none;"></div>
        
      </div>
    </div>
  </div>
</div>

<script src="{{asset()}}template/bootstrap/js/circulos.js"></script>

@stop


