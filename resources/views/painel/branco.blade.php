@extends('painel.template.painel')
@section('titulo','TItulo')
@section('topo')
<section class="content-header">
  <h1>
    Dashboard
    <small>Painel de Controle</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{asset('admin')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">TITULO</li>
  </ol>
</section>
@stop
@section('conteudo')
<div class="box box-primary">
    <div class="box-header">
        <i class="ion ion-clipboard"></i>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>      
          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>

        <h3 class="box-title">TITULO</h3>    
    </div>
  <!-- /.box-header -->
    <div class="box-body">

    </div>
</div>
@stop