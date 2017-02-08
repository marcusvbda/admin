@extends('templates.principal.principal')

@section('titulo','Usuários')

@section('topo')
<h1>Usuários
  <small>Novo usuário</small>
</h1>
<ol class="breadcrumb">
  <li><a href="{{asset('inicio')}}"><i class="fa fa-dashboard"></i> Início</a></li>
  <li><a href="{{asset('usuarios')}}"><i class="glyphicon glyphicon-user"></i> Usuários</a></li>
  <li><a><i class="glyphicon glyphicon-plus"></i> Novo usuário</a></li>
</ol>
@stop


@section('conteudo')
<style type="text/css">
  .error
  {
    border-color: red;
  }
</style>

<div class="col-md-12">
  <!-- <form action="{{asset('usuarios/store')}}" method="POST" id="formulario"> -->
    <div class="box" style="padding-bottom:20px;">
      <div class="box-header with-border">
        <p class="title_box">Dados do Usuário</p>
        <div class="box-tools pull-right">
        </div>

      
        <form id="frmusuario">
          <div class="row" >
            <div class="col-md-4">
              <label>Nome Completo</label>
              <input class="form-control" type="text" maxlength="50" placeholder="Nome Completo" name="usuario" id="usuario">
            </div>
            <div class="col-md-4">
              <label>Sexo</label>
              <select name="sexo" id="sexo" class="form-control">
                <option value="M" selected>Masculino</option>
                <option value="F">Feminino</option>
              </select>
            </div>  
            <div class="col-md-4">
              <label>Email</label>
              <input class="form-control" type="email" maxlength="200" placeholder="Email" name="email" id="email">
            </div>          
          </div>
          <div class="row" >
            <div class="col-md-4">
              <label>Grupo de Acesso</label>
              <select class="form-control" name="grupo_acesso_id">
                <?php $grupo_acesso = Controller::exec('tabelasAuxiliaresController','getTabela',[BANCO_DE_DADOS_USUARIOS.'.grupo_acesso']);?>
                <option value=""></option>                            
                @foreach($grupo_acesso as $gp)
                  <option value="{{$gp->id}}">
                    {{$gp->descricao}}
                  </option>
                @endforeach
              </select>
            </div>
            <div class="col-md-4">
              <label>Senha</label>
              <input class="form-control" type="password" maxlength="20" placeholder="Senha" name="senha" id="senha">
            </div>
            <div class="col-md-4">
              <label>Confirme a Senha</label>
              <input class="form-control" type="password" maxlength="20" placeholder="Confirme a Senha" id="confirme_senha">
            </div>          
          </div>      
        </form>
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