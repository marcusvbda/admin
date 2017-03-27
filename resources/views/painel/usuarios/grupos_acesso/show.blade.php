@extends('painel.template.painel')
@section('titulo','Grupo de Acesso')
@section('topo')
<section class="content-header">
  <h1>
     <i class="fa fa-unlock"></i>  Grupo de Acesso
    <small>Edição e Visualização</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{asset('admin')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="{{asset('admin/users/groups')}}"><i class="fa fa-unlock"></i> Grupos de Acesso</a></li>
    <li class="active">Perfil</li>
  </ol>
</section>
@stop



@section('conteudo')
<div class="row">
    <div class="col-md-8" id="div_treeview">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Informações</h3>    
            </div>
            <div class="box-body" style="height:500px;">
                <form id="form_info">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="input-group input-group-sm"> 
                                <span class="input-group-addon">Nome do Grupo</span> 
                                <input type="text" class="form-control" name="descricao" required id="descricao" 
                                value="{{$grupo->descricao}}" disabled maxlength="150"> 
                                <input type="text" hidden="" name="id" disabled value="{{$grupo->id}}">
                            </div>
                        </div>
                    </div>
                    <input type="submit" style="display: none" id="btn_submit_form_info">
                </form>  
                <hr>
                <h4><i class="fa fa-users"></i> Usuários utilizando</h4>
                <div class="col-md-12" style="overflow-y: auto;">
                    @foreach($usuarios as $usuario)
                        <p style="text-align: center;"><i class="fa fa-user"></i> 
                        <strong>{{$usuario->email}} </strong>, {{$usuario->nome}} {{$usuario->sobrenome}}</p>
                    @endforeach
                </div>     
            </div>
        </div>
        @if(can('grupos_acesso','put'))
        <button type="button" class="btn btn-primary btn-sm" id="btn_editar" onclick="editar()">Editar</button>
        <div id="btn_salvar" style="display: none;">
            <button type="button" class="btn  btn-success btn-sm" onclick="salvar()">Salvar</button>
            <button type="button" class="btn btn-danger btn-sm" onclick="cancelar()">Cancelar</button>
        </div>
        @endif
    </div>


    <div class="col-md-4" id="div_treeview">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Modulos e suas Permissões</h3>    
            </div>
            <div class="box-body"  style="height:500px;overflow-y: auto;">        
                <form onsubmit="return false;" id="form_permissoes">
                    @foreach($modulos as $modulo) 
                    <p>
                        <a class="btn btn-default btn-sm" data-toggle="collapse" data-target="#collapse_permissao_{{$modulo->id}}">
                            {{$modulo->descricao}}
                        </a>
                
                        <div id="collapse_permissao_{{$modulo->id}}" class="collapse">
                            @foreach($modulo->permissoes as $permissao) 
                                <p>
                                    <?php 
                                        $result = select("select * from grupo_acesso_permissoes where permissao_id=".$permissao->id." and grupo_acesso_id=".$grupo->id);
                                    ?>
                                      <label>
                                      <input type="checkbox" name="{{$permissao->id}}"  class="flat-green" @if($result[0]->valor=="S")  checked @endif disabled>
                                        {{$permissao->descricao}}
                                    </label>
                                </p>
                            @endforeach
                        </div>    
                    </p>           
                    @endforeach
                </form>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
function teste ()
{
    var permissoes = $('#form_permissoes').FormData();
    console.log(permissoes);
}

function editar()
{
    msg_confirm("Confirmação","Editar Informações deste profile ?",function()
    {
        liberar();
    });
}
function liberar()
{
    $("#btn_editar").hide();
    $("#btn_salvar").hide();
    $("#btn_salvar").toggle(150);
    $("#form_info :input").prop('disabled', false);
    $("#form_permissoes :input").prop('disabled', false);
}

function salvar()
{
    $('#form_info #btn_submit_form_info').click();
    return false;
}


$('#form_info').submit(function(form) 
{    
    msg_confirm("Confirmação","Deseja alterar o cadastro deste grupo de acesso ?",function()
    {
        var info        = $('#form_info').FormData();
        var permissoes  = $('#form_permissoes').FormData();
        xCode.ajax('put',"{{asset('admin/users/groups')}}",{info,permissoes }).then(function(response)
        {
            if(response.success)
            {
                msg_stop(':)',response.msg,function()
                {
                   load("{{asset('admin/users/groups/show')}}"+"/"+response.id);
                },'success');
            }
            else
                return msg('Oops',response.msg,"error");
        }); 
    });
    return false;
});

</script>
@stop