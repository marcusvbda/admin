@extends('templates.principal.principal')

@section('titulo','Usuários')

@section('topo')
<h1>Usuários
  <small>Listagem e cadastro</small>
</h1>
<ol class="breadcrumb">
  <li><a href="{{asset('admin/inicio')}}"><i class="fa fa-dashboard"></i> Início</a></li>
  <li><a href="{{asset('admin/usuarios')}}"><i class="glyphicon glyphicon-user"></i> Usuários</a></li>
</ol>
@stop


@section('conteudo')
<div class="col-md-12">
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title"></h3>
      <div class="box-tools pull-right">
        <!-- <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"><i class="fa fa-minus"></i></button></div> -->
      </div>

   

        <div class="row">
          <form method="GET" action="{{asset('usuarios')}}">
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
                      <th>Usuário</th>
                      <th>email</th>
                      <th class="centro"><span class="glyphicon glyphicon-cog"></span></th>
                  </tr>
               </thead>
               <tbody>
                  @foreach($usuarios as $usuario)
                  <tr>
                    <td>{{$usuario->usuario}}</td>
                    <td>{{$usuario->email}}</td>
                    <td class="centro"><a href='{{asset("usuarios/show/$usuario->id")}}' class="btn btn-primary"><span class="glyphicon glyphicon-search"></span></a></td>
                  </tr>
                  @endforeach
               </tbody>
             </table>
             {{$usuarios->links()}}
            </div>
          </div>
        </div>
      </div>

          
  </div>  
</div>



@stop