@extends('templates.principal.principal')

@section('titulo','Produtos')

@section('topo')
<h1>Produtos
  <small>Listagem</small>
</h1>
<ol class="breadcrumb">
  <li><a href="{{asset('admin/inicio')}}"><i class="fa fa-dashboard"></i> Início</a></li>
  <li><a href="{{asset('admin/produtos')}}"><i class="glyphicon glyphicon-erase"></i> Produtos</a></li>
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
                      <th>Código</th>
                      <th>Código Estendido</th>
                      <th>Nome</th>
                      <th>Descrição</th>
                      <th class="centro"><span class="glyphicon glyphicon-cog"></span></th>                      
                  </tr>
               </thead>
               <tbody>
                  @foreach($produtos as $produto)
                  <tr>
                    <td>{{$produto->codigo}}</td>
                    <td>{{$produto->codigoestendido}}</td>
                    <td>{{$produto->nomefantasia}}</td>
                    <td>{{$produto->descricao}}</td>
                    <td class="centro">
                      <div class="tools">                      
                        <a title="Visualizar" href='{{asset("produtos/show/$produto->sequencia")}}'>
                          <i class="fa fa-search" style="color:#3C8DBC;" title="Visualizar"></i>
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