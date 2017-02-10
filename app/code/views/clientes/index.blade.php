@extends('templates.principal.principal')

@section('titulo','Clientes')

@section('topo')
<h1>Clientes
  <small>Listagem</small>
</h1>
<ol class="breadcrumb">
  <li><a href="{{asset('inicio')}}"><i class="fa fa-dashboard"></i> Início</a></li>
  <li><a href="{{asset('clientes')}}"><i class="glyphicon glyphicon-user"></i> Clientes</a></li>
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
               <table class="table table-striped" id="tabela" cellspacing="0px">
               <thead>
                  <tr>
                      <th>Número</th>
                      <th>Razão Social</th>
                      <th>CNPJ</th>
                      <th class="centro no-sort"></th>                      
                  </tr>
               </thead>
               <tbody>
                  @foreach($clientes as $cliente)
                  <tr>
                    <td>{{$cliente->numero}}</td>
                    <td>{{$cliente->razaosocial}}</td>
                    <td>{{$cliente->cnpj}}</td>
                    <td class="centro text-right">
                      <div class="tools">                      
                        <a title="Visualizar" href='{{asset("clientes/show/$cliente->sequencia")}}' class="btn btn-primary btn-sm">
                          <i class="fa fa-search" title="Visualizar"></i> Visualizar
                        </a>                       
                      </div>
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
</div>


@stop