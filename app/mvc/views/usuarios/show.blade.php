@extends('templates.principal.principal')

@section('titulo','Usuários')

@section('topo')
<h1>Usuários
  <small>Consulta / Alteração</small>
</h1>
<ol class="breadcrumb">
  <li><a href="{{asset('admin/inicio')}}"><i class="fa fa-dashboard"></i> Início</a></li>
  <li><a href="{{asset('admin/usuarios')}}"><i class="glyphicon glyphicon-user"></i> Usuários</a></li>
  <li><a><i class="glyphicon glyphicon-search"></i> Consulta / Alteração</a></li>
</ol>
@stop


@section('conteudo')

<div class="col-md-12">
    <div class="box" style="padding-bottom:20px;">
      <div class="box-header with-border">
        <p class="title_box">Dados do Usuário</p>
        <div class="box-tools pull-right">
        </div>

        
          <div class="row" >
            <div class="col-md-4">
              <input type="text" id="id" value="{{$usuario->id}}" hidden>
              <label>Nome Completo</label>
              <input class="form-control" value="{{$usuario->usuario}}" required type="text" maxlength="50" placeholder="Nome Completo" name="usuario" id="usuario" readonly>
            </div>
            <div class="col-md-4">
              <label>Sexo</label>
              <select name="sexo" id="sexo" class="form-control" required readonly>
                @if($usuario->sexo=="M")
                  <option value="M" selected>Masculino</option>
                  <option value="F">Feminino</option>
                @else
                  <option value="M">Masculino</option>
                  <option value="F" selected>Feminino</option>
                @endif
              </select>
            </div>  
            <div class="col-md-4">
              <label>Email</label>
              <input class="form-control" value="{{$usuario->email}}" required type="email" maxlength="200" placeholder="Email" name="email" id="email" readonly>
            </div>          
          </div>          

      </div>      
    </div> 

    <div class="box" style="padding-bottom:20px;">
      <div class="box-header with-border">
        <p class="title_box">Tipo de Usuário</p>

        <div class="row">
          <div class="col-md-12">
          @if($usuario->admin=="N")
            <input type="text" id="admin" value="N" hidden="">
            <input onclick="setAdmin('S')" type="radio" name="rd_admin" id="rd_admin" value="S" readonly><span style="margin-right:10px;"> Usuário Administrador</span>
            <input onclick="setAdmin('N')" type="radio" name="rd_admin" id="rd_admin" value="N" checked readonly><span> Usuário Comum</span>
          @else
            <input type="text" id="admin" value="S" hidden="">
            <input onclick="setAdmin('S')" type="radio" name="rd_admin" id="rd_admin" value="S" checked readonly><span style="margin-right:10px;"> Usuário Administrador</span>
            <input onclick="setAdmin('N')" type="radio" name="rd_admin" id="rd_admin" value="N" readonly><span> Usuário Comum</span>
          @endif
          </div>

        </div>
          
      </div>
    </div>

   
    <div class="row">
      <div id="btn_visualizacao">
        <div class="col-md-6">
          <button id="btn_alterar" class="btn btn-warning"><span class="glyphicon glyphicon-pencil"></span> Alterar</button>
        </div>
      </div>
      <div id="btn_alteracao" style="display:none;">
        <div class="col-md-6">
          <button id="btn_cancelar" class="btn btn-danger"><span class="glyphicon glyphicon-minus"></span> Cancelar</button>
          <button id="btn_confirmar" class="btn btn-success"><span class="glyphicon glyphicon-okl"></span> Confirmar</button>
        </div>
      </div>
    </div>

</div>

@stop