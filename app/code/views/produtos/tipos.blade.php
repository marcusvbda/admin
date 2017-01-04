@extends('templates.principal.principal')

@section('titulo','Tipos Produtos')

@section('topo')
<h1>Produtos
  <small>Tipos</small>
</h1>
<ol class="breadcrumb">
  <li><a href="{{asset('admin/inicio')}}"><i class="fa fa-dashboard"></i> Início</a></li>
  <li><a href="{{asset('admin/produtos/tipos')}}"><i class="glyphicon glyphicon-erase"></i> Tipos Produtos</a></li>
</ol>
@stop


@section('conteudo')
<div class="col-md-12">
  <div class="box">
    <div class="box-header with-border">
        <p class="title_box"></p>  
      <div class="box-tools pull-right">
        <!-- <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"><i class="fa fa-minus"></i></button></div> -->
      </div>

   
       <div class="row">
          <div class="box-body table-responsive no-padding">  
            <div class="col-md-12">
               <table class="table table-striped" id="tabela">
               <thead>
                  <tr>
                      <th>Número</th>
                      <th>Descrição</th>
                      <th class="centro">Entradas</th>
                      <th class="centro">Saidas</th>                 
                  </tr>
               </thead>
               <tbody>
                  @foreach($tipos as $tipo)
                  <tr>
                    <td>{{$tipo->numero}}</td>
                    <td>{{$tipo->descricao}}</td>
                    <td class="centro">
                      @if($tipo->entradas=='S')
                        <span class="glyphicon glyphicon-ok" style="color:green;"></span>
                      @else
                        <span class="glyphicon glyphicon-remove" style="color:red;"></span>
                      @endif
                    </td>
                    <td class="centro">
                      @if($tipo->saidas=='S')
                        <span class="glyphicon glyphicon-ok" style="color:green;"></span>
                      @else
                        <span class="glyphicon glyphicon-remove" style="color:red;"></span>
                      @endif
                    </td>
                  </tr>
                  @endforeach
               </tbody>
             </table>
            </div>
          </div>
        </div>
      </div>

          
  </div>  
</div>
@stop