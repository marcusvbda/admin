@extends('templates.principal.principal')

@section('titulo','Usuários')

@section('topo')
<h1>Usuários
  <small>Consulta / Alteração</small>
</h1>
<ol class="breadcrumb">
  <li><a href="{{asset('inicio')}}"><i class="fa fa-dashboard"></i> Início</a></li>
  <li><a href="{{asset('usuarios')}}"><i class="glyphicon glyphicon-user"></i> Usuários</a></li>
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

        <form id="frm_usuario"> 
          <div class="row" >
            <div class="col-md-4">
              <input type="text" id="id" value="{{$usuario->id}}" hidden>
              <label>Nome Completo</label>
              <input class="form-control" value="{{$usuario->usuario}}" required type="text" maxlength="50" placeholder="Nome Completo" name="usuario" id="usuario" disabled>
            </div>
            <div class="col-md-4">
              <label>Email</label>
              <input class="form-control" value="{{$usuario->email}}" required type="text" maxlength="50" placeholder="Email" name="email" id="email" readonly="">
            </div>
            <div class="col-md-4">
              <label>Sexo</label>
              <select name="sexo" id="sexo" class="form-control" required disabled>
                @if($usuario->sexo=="M")
                  <option value="M" selected>Masculino</option>
                  <option value="F">Feminino</option>
                @else
                  <option value="M">Masculino</option>
                  <option value="F" selected>Feminino</option>
                @endif
              </select>
            </div>            
          </div>          

          <div class="row" >
            <div class="col-md-4">
              <label>Grupo de Acesso</label>
              <select class="form-control" name="grupo_acesso_id" disabled="">
                <?php $grupo_acesso = Controller::exec('tabelasAuxiliaresController','getTabela',['grupo_acesso']);?>                          
                @foreach($grupo_acesso as $gp)
                  <option value="{{$gp->id}}" @if($usuario->grupo_acesso_id==$gp->id) selected @endif>
                    {{$gp->descricao}}
                  </option>
                @endforeach
              </select>
            </div>        
          </div>   
          </form>


            <div class="row" id="danger_zone" style="display: none;">
              <hr>
              @if(Access("PUT","usuarios"))
                <div class="col-md-4" id="div_alt_email">
                  <!-- conteudo -->
                </div>

                <div class="col-md-4" id="div_alt_senha">
                  <!-- conteudo -->
                </div>
              @endif

              @if(Access("DELETE","usuarios"))
                <div class="col-md-4" id="div_alt_excluir">
                  <!-- conteudo -->
                </div>  
              @endif

            </div>
            <!-- danger -->
      </div>      
    </div> 

</div>

<div class="col-md-12">
  @if(Access("PUT","usuarios"))
    <button type="button" class="btn btn-oval btn-warning" id="btn_editar_info" onclick="editar()">Editar</button>
    <div id="btn_salvar_info" style="display: none;">
      <button type="button" class="btn btn-oval btn-success" onclick="salvar()">Salvar</button>
      <button type="button" class="btn btn-oval btn-danger" onclick="cancelaredicao()">Cancelar</button>
    </div>
  @endif
</div>

@stop