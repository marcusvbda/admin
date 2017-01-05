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
            <span class="info-box-icon bg-red" style="padding-top: 20px;"><i class="ion ion-ios-gear-outline"></i></span>

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
            <span class="info-box-icon bg-yellow" style="padding-top: 20px;"><i class="ion ion-stats-bars"></i></span>

            <a style="color:black" href="{{asset('empresa')}}" title="clique para visualizar"><div class="info-box-content">
              <?php $empresas_selecionadas = Controller::exec('empresaController','qtde_empresas_selecionadas'); ?>
              <span class="info-box-text">{{$empresas_selecionadas}} selecionada @if(count($empresas_selecionadas)>1){{'s'}}@endif</span>              
              <span class="info-box-number"><small>{{auth('nome_empresa')}}</small></span>
            </div></a>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green" style="width: 100%;"><span id="timer"></span></span>

           
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>

<div class="row">
	<div class="col-md-12">
		<div class="box">
		    <div class="box-header with-border">
		      <p class="title_box"></p>
		      <div class="box-tools pull-right">
		        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"><i class="fa fa-minus"></i></button></div>
		      </div>
		    </div>
		</div>
	</div>
</div>
@stop
