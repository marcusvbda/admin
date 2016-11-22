@extends('templates.principal.principal')

@section('titulo','Usuários')

@section('topo')
<h1>Usuários
  <small>Novo usuário</small>
</h1>
<ol class="breadcrumb">
  <li><a href="{{asset('admin/inicio')}}"><i class="fa fa-dashboard"></i> Início</a></li>
  <li><a href="{{asset('admin/usuarios')}}"><i class="glyphicon glyphicon-user"></i> Usuários</a></li>
  <li><a><i class="glyphicon glyphicon-plus"></i> Novo usuário</a></li>
</ol>
@stop


@section('conteudo')

<div class="col-md-12">
  <!-- <form action="{{asset('usuarios/store')}}" method="POST" id="formulario"> -->
    <div class="box" style="padding-bottom:20px;">
      <div class="box-header with-border">
        <p class="title_box">Dados do Usuário</p>
        <div class="box-tools pull-right">
        </div>

      
          <div class="row" >
            <div class="col-md-4">
              <label>Nome Completo</label>
              <input class="form-control" required type="text" maxlength="50" placeholder="Nome Completo" name="usuario" id="usuario">
            </div>
            <div class="col-md-4">
              <label>Sexo</label>
              <select name="sexo" id="sexo" class="form-control" required>
                <option value="M" selected>Masculino</option>
                <option value="F">Feminino</option>
              </select>
            </div>  
            <div class="col-md-4">
              <label>Email</label>
              <input class="form-control" required type="email" maxlength="200" placeholder="Email" name="email" id="email">
            </div>          
          </div>
          <div class="row" >
            <div class="col-md-6">
              <label>Senha</label>
              <input class="form-control" required type="password" maxlength="20" placeholder="Senha" name="senha" id="senha">
            </div>
            <div class="col-md-6">
              <label>Confirme a Senha</label>
              <input class="form-control" required type="password" maxlength="20" placeholder="Confirme a Senha" name="confirme_senha" id="confirme_senha">
            </div>          
          </div>      

      </div>      
    </div> 
</div>

<div class="col-md-12" id="div_tipo">
  <div class="box" style="padding-bottom:20px;">
      <div class="box-header with-border">
        <p class="title_box">Tipo de Usuário</p>

        <div class="row">
          <div class="col-md-12">
            <input type="text" id="admin" value="N" hidden="">
            <input onclick="setAdmin('S')" type="radio" name="rd_admin" id="rd_admin" value="S"><span style="margin-right:10px;"> Usuário Administrador</span>
            <input onclick="setAdmin('N')" type="radio" name="rd_admin" id="rd_admin" value="N" checked><span> Usuário Comum</span>
          </div>

        </div>
          
      </div>
    </div>   
</div>

 

<div class="col-md-12">
  <div class="row">
    <div class="col-md-6">
      <button id="btn_confirmar" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span> Cadastrar</button>
    </div>
  </div>
</div>
@stop