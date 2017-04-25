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
        <div class="row">
          <div class="col-md-12">
            <table class="table table-condensed table-striped">
              <thead>
                <tr>
                  <th style="display: none">id</th>
                  <th></th>
                  <th>Nome</th>
                  <th>Razão</th>
                </tr>
              </thead>
              <tbody>
                @foreach($empresas as $empresa)
                    @if($empresa->selecionado==uppertrim('S'))
                    <tr style="background-color: #afffdb" onclick="selecionar({{$empresa->id}},'N')">
                      <td><span class="glyphicon glyphicon-check"></span></td>
                    @else
                    <tr style="background-color: #ffd8d8" onclick="selecionar({{$empresa->id}},'S')">
                      <td><span class="glyphicon glyphicon-unchecked"></span></td>
                    @endif
                    <td style="display: none">{{$empresa->id}}</td>
                    <td>{{$empresa->nome}}</td>
                    <td>{{$empresa->razao}}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
    </div>
</div>


<script type="text/javascript">
function selecionar(id,valor)
{
  @if(can('multiempresa','put'))  
    xCode.ajax("put","{{asset('admin/config/selecionarempresa')}}",{id,valor}).then(function(response)
    {
        if(response.success)
          reload();
    });
  @endif
}
</script>
@stop