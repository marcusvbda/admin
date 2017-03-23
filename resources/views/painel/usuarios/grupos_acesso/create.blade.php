@extends('painel.template.painel')
@section('titulo','Grupo de Acesso')
@section('topo')
<section class="content-header">
  <h1>
    <i class="fa fa-unlock"></i>  Grupos de Acesso
    <small>Cadastro</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{asset('admin')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="{{asset('admin/groups')}}"><i class="fa fa-unlock"></i> Grupos de Acesso</a></li>
  </ol>
</section>
@stop



@section('conteudo')

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
                            maxlength="150"> 
                        </div>
                    </div>
                </div>
                <input type="submit" style="display: none" id="btn_submit_form_info">
            </form>               
        </div>
    </div>
    <button type="button" class="btn  btn-success btn-sm" onclick="salvar()">Salvar</button>
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
                                <label>
                                  <input type="checkbox" name="{{$permissao->id}}"  class="flat-green" checked>
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

<script type="text/javascript">
function salvar()
{
    $('#form_info #btn_submit_form_info').click();
    return false;
}


$('#form_info').submit(function(form) 
{    
    msg_confirm("Confirmação","Deseja cadastrar este grupo de acesso ?",function()
    {
        var info        = $('#form_info').FormData();
        var permissoes  = $('#form_permissoes').FormData();
        xCode.ajax('post',"{{asset('admin/users/groups')}}",{info,permissoes }).then(function(response)
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