@extends('templates.principal.principal')

@section('titulo','Edição de Grupo de Acesso')

@section('topo')
<h1>Grupos de Acesso
  <small>Edição</small>
</h1>
<ol class="breadcrumb">
  <li><a href="{{asset('inicio')}}"><i class="fa fa-dashboard"></i> Início</a></li>
  <li><a href="{{asset('usuarios')}}"><i class="glyphicon glyphicon-user"></i> Usuários</a></li>
  <li><a href="{{asset('usuarios/grupos_acesso')}}"><i class="glyphicon glyphicon-user"></i> Grupos de Acesso</a></li>
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
    <div class="box">
      <div class="box-header with-border">
        <p class="title_box"></p>
        <div class="box-tools pull-right"></div>

          <div class="row">
            <div class="col-md-10">
              <label>Descrição</label>
              <input class="form-control" type="text" id="descricao" value="{{$grupo_acesso->descricao}}" maxlength="50" placeholder="Descrição" name="">
            </div>
            <div class="col-md-2">
              <button class="btn btn-primary btn-sm" id="btn_salvar" style="margin-top: 25px">Salvar</button>
            </div>   
          </div>           
        </div>          
    </div> 
  </div>


  <div class="col-md-12">
    <div class="box">
      <div class="box-header with-border">
        <p class="title_box"></p>
        <div class="box-tools pull-right"></div>


        @foreach($modulos as $mod)
         <?php $con = Query("select * from ".BANCO_DE_DADOS_USUARIOS.".config_grupo_acesso where modulo_id = $mod->id and 
          grupo_acesso_id=$grupo_acesso->id")[0]; ?>
          <div class="col-md-4 card" style="border-right : solid 1px #c1c1c1">
            <form id="{{uppertrim($mod->modulo)}}">
              <div class="row conteudo">
              <h3 class="text-center">{{$mod->descricao}}</h3><br>        
                  <div class="col-md-6">
                   <label>
                        <input type="checkbox" @if($con->POST=="S") checked="checked" @endif   name="POST"> 
                        <span>Cadastrar</span>
                    </label>
                  </div>  
                  <div class="col-md-6">
                    <label>
                        <input type="checkbox" @if($con->PUT=="S") checked="checked" @endif   name="PUT"> 
                        <span>Atualizar</span>
                    </label>
                  </div>   
                  <div class="col-md-6">
                    <label>
                        <input type="checkbox" @if($con->GET=="S") checked="checked" @endif  name="GET"> 
                        <span>Visualizar</span>
                    </label>
                  </div>     
                  <div class="col-md-6">
                    <label>
                        <input type="checkbox" @if($con->DELETE=="S") checked="checked" @endif  name="DELETE"> 
                        <span>Excluir</span>
                    </label>
                  </div>                          
              </div>
            </form>
          </div>
          @endforeach



        </div>          
    </div> 
  </div>





@stop