@extends('templates.principal.principal')

@section('titulo','Usuários')

@section('topo')
<h1>Usuários
  <small>Listagem e cadastro</small>
</h1>
<ol class="breadcrumb">
  <li><a href="{{asset('inicio')}}"><i class="fa fa-dashboard"></i> Início</a></li>
  <li><a href="{{asset('usuarios')}}"><i class="glyphicon glyphicon-user"></i> Usuários</a></li>
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

   
        <!-- <button title="Gerar Relatório" onclick="imprimir();" class="btn btn-default pull-right"><span class="glyphicon glyphicon-print"></span></button> -->

        <hr>

        <div class="row">
          <div class="box-body table-responsive no-padding">  
            <div class="col-md-12">
               <table class="table table-striped" id="tabela">
               <thead>
                  <tr>
                      <th>Usuário</th>
                      <th>email</th>
                      <th></th>
                  </tr>
               </thead>
               <tbody>
                  @foreach($usuarios as $usuario)
                  <tr>
                    <td>{{$usuario->usuario}}</td>
                    <td>{{$usuario->email}}</td>
                    <td class="centro">

                      <div class="tools text-right">           
                        @if(Access("PUT","usuarios"))           
                        <a title="Visualizar / Alterar" href="{{asset('usuarios/show/').$usuario->id}}" class="btn btn-primary">
                          <i class="fa fa-edit" ></i> Visualizar / Alterar
                        </a>
                        @endif 
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

  @if(Access("POST","usuarios"))
    <div class="row">
      <div class="col-md-1">
        <a href="{{asset('usuarios/novo')}}" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Cadastrar</a>
      </div>
    </div>
  @endif
</div>



@stop