@extends('painel.template.painel')
@section('titulo','Bombas')
@section('topo')
<section class="content-header">
  <h1>
    <i class="fa fa-industry"></i>
    Bombas
    <small>Visualização</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{asset('admin')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Tanques</li>
  </ol>
</section>
@stop
@section('conteudo')
<?php 
use App\Bombas;
use App\Tanques;
?>
<div class="row">
  @foreach($bombas as $bomba)
  <div class="col-md-3">
    <div class="box box-primary collapsed-box">
        <div class="box-header">
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" title="Ver Mais"><i class="fa fa-minus"></i></button>      
              <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
            </div> 
            <?php $bicos = Bombas::where('bomba','=',$bomba->bomba)->get(); ?>

            <h3 class="box-title"><strong>Bomba {{$bomba->bomba}}</strong>  ({{count($bicos)}} @if(count($bicos)>1)Bicos @else Bico @endif)</h3>    
        </div> 

        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <p><strong></strong></p>
              @foreach($bicos as $bico)
                <p><strong>Bico : </strong>{{$bico->numero}}</p>
                <?php $tanque = Tanques::where('codigo','=',$bico->tanque_codigo)->first(); ?>
                <p><strong>Combustivel : </strong>({{$tanque->produto->codigo}}) {{$tanque->produto->descricao}}</p>
                <p><strong>Encerrante : </strong>{{$bico->encerrante}}</p>
                <hr>
              @endforeach
            </div>
          </div>
      </div>

    </div>
  </div>
  @endforeach
</div>
@stop