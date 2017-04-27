@extends('painel.template.painel')
@section('titulo','Abastecimentos')

@section('topo')
<section class="content-header">
  <h1>
    <i class="fa fa-road"></i> Abastecimentos
    <small> Listagem</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{asset('admin')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active"> Abastecimentos</li>
  </ol>
</section>
@stop

@section('conteudo')
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
          <!-- /.box-header -->
            <div class="box-body">
                <div class="row">

                    <form action="{{asset('admin/abastecimentos/printreport')}}" method="post">
                        <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                        <div class="col-md-2">
                            <label>Bico</label>
                            <select class="form-control" id="bico" name="bico">
                                <option value="TODOS">Todos</option>
                                @foreach($bicos as $bico)
                                    <option @if($filtro['bico']==$bico->numero) selected @endif value="{{$bico->numero}}" >Bico {{$bico->numero}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>Entre datas :</label>
                            <input type="date" name="de" id="de" class="form-control" value="{{$filtro['de']}}">
                            <input type="date" name="ate" id="ate" class="form-control" value="{{$filtro['ate']}}">
                        </div>
                        <div class="col-md-2">
                            <label>Entre horas :</label>
                            <input type="time" name="de_hora" id="de_hora" class="form-control" value="{{$filtro['de_hora']}}">
                            <input type="time" name="ate_hora" id="ate_hora" class="form-control" value="{{$filtro['ate_hora']}}" >
                        </div>
                        <div style="padding-top: 25px;">                            
                            <button class="btn btn-sm btn-success"><i class="glyphicon glyphicon-print"></i> Relatório</button>
                        </div>
                    </form>
            </div>
        </div>
    </div>
</div>

@stop