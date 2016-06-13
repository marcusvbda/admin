@extends('templates.principal.login')

@section('titulo','Cadastro')

@section('topo')
<h1>
  Nome da página
  <small>Subtitulo</small>
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="#">Pagina em branco</a></li>
</ol>
@stop


@section('conteudo')
<p class="login-box-msg">Após este cadastro solicite ao administrador a liberação do mesmo</p>

    <form action="{{asset('usuarios/cadastrar')}}" onsubmit="return validar()" method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="nome" placeholder="Nome Completo">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="email" class="form-control" name="email" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="senha" placeholder="Senha">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="repita" placeholder="Repita a senha">
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
      </div>
      <div class="row">   
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Cadastrar</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
@stop

@section('sublink')
<a href="{{asset('usuarios/login')}}">Voltar ao login</a>
@stop