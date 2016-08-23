@extends('templates.principal.principal')

@section('titulo','Clientes')

@section('topo')
<h1>Clientes
  <small>Listagem</small>
</h1>
<ol class="breadcrumb">
  <li><a href="{{asset('admin/inicio')}}"><i class="fa fa-dashboard"></i> Início</a></li>
  <li><a href="{{asset('admin/clientes')}}"><i class="glyphicon glyphicon-user"></i> Clientes</a></li>
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
          <form method="GET" action="{{asset('clientes')}}">
            <div class="col-md-12">
              <div class="input-group input-group-sm" >
                  <input type="text" style="text-transform:uppercase" name="filtro" value="{{$filtro}}" class="form-control pull-right" id="filtro" placeholder="Filtro de busca">
                  <div class="input-group-btn">
                    <button id="btn-filtro" type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
              </div>
            </div>
          </form>
        </div>
        <br>
         {{$qtde_registros}} 
          @if($qtde_registros>1)
            Registros
          @else  
            Registro
          @endif
          ({{number_format($tempo_consulta,5)}} segundos)
        <hr>

        <div class="row">
          <div class="box-body table-responsive no-padding">  
            <div class="col-md-12">
               <table class="table table-striped" id="tabela">
               <thead>
                  <tr>
                      <th>id</th>
                      <th>Nome</th>
                      <th>Razão Social</th>
                      <th>CNPJ</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach($clientes as $cliente)
                  <tr>
                    <td>{{$cliente->numero}}</td>
                    <td>{{$cliente->nome}}</td>
                    <td>{{$cliente->razaosocial}}</td>
                    <td>{{$cliente->cnpj}}</td>
                  </tr>
                  @endforeach
               </tbody>
             </table>
             {{$clientes->links()}}
            </div>
          </div>
        </div>
      </div>

          
  </div>  
</div>



@stop