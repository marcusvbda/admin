@extends('painel.template.painel')
@section('titulo','Caixas')
@section('topo')
<section class="content-header">
  <h1>
    <i class="fa fa-institution"></i>
    MultiEmpresa
    <small>Visualização e Edição</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{asset('admin')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">MultiEmpresa</li>
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
    </div>
  <!-- /.box-header -->
    <div class="box-body">

    </div>
</div>
@stop