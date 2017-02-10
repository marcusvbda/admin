@extends('templates.principal.principal')

@section('titulo','Grupos e Acesso')

@section('topo')
<h1>Grupos de Acesso
  <small>Listagem e cadastro</small>
</h1>
<ol class="breadcrumb">
  <li><a href="{{asset('inicio')}}"><i class="fa fa-dashboard"></i> Início</a></li>
  <li><a href="{{asset('usuarios')}}"><i class="glyphicon glyphicon-user"></i> Usuários</a></li>
  <li><a href="{{asset('grupos_acesso')}}"><i class="glyphicon glyphicon-user"></i> Grupos de Acesso</a></li>
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

     
          <!-- <button title="Gerar Relatório" onclick="imprimir();" class="btn btn-default btn-sm pull-right"><span class="glyphicon glyphicon-print"></span></button> -->

          <hr>

          <div class="row">
            <div class="box-body table-responsive no-padding">  
              <div class="col-md-12">
                 <table class="table table-striped" id="tabela">
                 <thead>
                    <tr>
                        <th>#</th>
                        <th>Descrição</th>
                        <th class="centro"></th>
                    </tr>
                 </thead>
                 <tbody>
                    @foreach($grupos as $grupo)
                    <tr>
                      <td>{{$grupo->id}}</td>
                      <td>{{$grupo->descricao}}</td>
                      <td class="centro text-right">

                        <div class="tools text-right">           
                          @if(Access("GET","grupos_acesso"))           
                          <a title="Visualizar / Alterar" class="btn btn-primary btn-sm" href="{{asset('usuarios/showgrupoacesso/').$grupo->id}}">
                            <i class="fa fa-edit"></i> Visualizar / Alterar
                          </a>
                          @endif 
                          @if(Access("DELETE","grupos_acesso"))           
                          <a title="Visualizar / Alterar" class="btn btn-danger btn-sm"onclick="excluir({{$grupo->id}})">
                            <i class="fa fa-trash"></i> Excluir
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

    @if(Access("POST","grupos_acesso"))
      <div class="row">
        <div class="col-md-1">
          <a href="{{asset('usuarios/create_grupos_acesso')}}" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-plus"></span> Cadastrar</a>
        </div>
      </div>
    @endif
  </div>


<div id="editar" style="display: none">
  <h1>editar / visualizar</h1>
  <a onclick="step('#editar','#index')" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-plus"></span> voltar</a>

</div>




@stop