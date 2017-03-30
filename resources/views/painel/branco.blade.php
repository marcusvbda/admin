@extends('painel.template.painel')
@section('titulo','Caixas')
@section('topo')
<section class="content-header">
  <h1>
    <i class="fa fa-money"></i>
    Caixas
    <small>Visualização</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{asset('admin')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Caixas</li>
  </ol>
</section>
@stop
@section('conteudo')
<div class="box box-primary">
    <div class="box-header">
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>      
          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>

        <h3 class="box-title">Caixas</h3>    
    </div>
  <!-- /.box-header -->
    <div class="box-body">

    </div>
</div>
@stop