@extends('painel.template.painel')
@section('titulo',ucfirst($tipo))
@section('topo')
<section class="content-header">
  <h1>
    <i class="fa fa-unlock"></i>
    {{ucfirst($tipo)}}
    <small>Cadastro</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{asset('admin')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{asset('admin/persons/')}}/{{$tipo}}"><i class="fa fa-user"></i> {{ucfirst($tipo)}}</a></li>
    <li class="active">Cadastro de {{ucfirst($tipo)}}</li>
  </ol>
</section>
@stop

@section('conteudo')
<div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title">Cadastro de {{ucfirst($tipo)}}</h3>    
    </div>
  <!-- /.box-header -->
    <div class="box-body">

            <div class="card col-md-12 conteudo">    
                <div class="pull-right">
                    <button class="btn btn-primary btn-sm" onclick="clonar()"><span class="glyphicon glyphicon-link"></span> Clonar</buttom>
                </div>
                <ul class="nav nav-pills">
                <li class="nav-item"> <a href="" class="nav-link active" data-target="#info-pills" aria-controls="info-pills" data-toggle="tab" role="tab">Informações</a> </li>
                <li class="nav-item"> <a href="" class="nav-link" data-target="#contatos-pills" aria-controls="config-pills" data-toggle="tab" role="tab">Contatos</a> </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="info-pills">
                    <br>
                      
                        <form id="form">
                            <div class="row">
                                <div class="col-md-12" id="div_nome">
                                    <div class="input-group input-group-sm"> 
                                        <span class="input-group-addon">Nome</span> 
                                        <input type="text" class="form-control" name="nome" id="nome" value="{{$pessoa->nome}}" disabled maxlength="150"> 
                                    </div>
                                </div>
                                <div class="col-md-6" id="div_razao" style="display: none">
                                    <div class="input-group input-group-sm"> 
                                        <span class="input-group-addon">Razão</span> 
                                        <input type="text" class="form-control" name="razao" id="razao" value="{{$pessoa->razao}}" disabled maxlength="150"> 
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label>
                                           <input class="radio squared" name="tipo" id="tipo" @if($pessoa->tipo=="F") checked="checked" @endif type="radio" value="Fisica" onchange="mudaMascara('F')" disabled>
                                           Fisica
                                        </label><label>
                                           <input class="radio squared" name="tipo" id="tipo" type="radio" value="Jurídica" onchange="mudaMascara('J')" disabled @if($pessoa->tipo=="J") checked="checked" @endif>
                                           Jurídica
                                        </label>         
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group input-group-sm"> 
                                        <span class="input-group-addon" id="LABEL_CPF_CNPJ">CPF</span> 
                                        <input type="text" class="form-control" name="CPF_CNPJ" id="CPF_CNPJ"  disabled maxlength="25"> 
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group input-group-sm"> 
                                        <span class="input-group-addon">Email</span> 
                                        <input type="text" class="form-control" name="email" id="email" value="{{$pessoa->email}}" disabled maxlength="250"> 
                                    </div>
                                </div>
                            </div>
                            <input type="submit" class="submit" style="display:none;">                                

                        </form>

                        <hr>
                        <div class="row">
                            <div class="col-md-4">
                                <button type="button" class="btn  btn-primary btn-sm" id="btn_editar" onclick="editar()">Editar</button>
                                <div id="btn_salvar" style="display: none;">
                                    <button type="button" class="btn btn-success btn-sm" id="btn_salvar">Salvar</button>
                                    <button type="button" class="btn btn-danger btn-sm" onclick="cancelar()">Cancelar</button>
                                </div>
                            </div>
                        </div>

                    </div>
                    <br>
                    <div class="tab-pane fade" id="contatos-pills">                   
                        @include('painel.pessoas.contatos',['contatos'=>$contatos,'pessoa_id'=>$pessoa->id])
                    </div>
                </div>       

                    
            </div>
         

        </div>
    </div>
</div>



<script type="text/javascript">
mudaMascara("{{$pessoa->tipo}}");
$('#CPF_CNPJ').val('{{trim($pessoa->CPF_CNPJ)}}');
function mudaMascara(tipo=null)
{
    if(tipo==null)
    {
        tipo = $('#form').FormData()['tipo'];
        tipo = tipo.substring(0, 1);
    }

    if(tipo==="J")
    {
        $('#LABEL_CPF_CNPJ').html('CNPJ');
        $("#CPF_CNPJ").mask("99.999.999/9999-99");
        personalizarCamposTipo(tipo);
    }
    else 
    {
        $('#LABEL_CPF_CNPJ').html('CPF');          
        $("#CPF_CNPJ").mask("999.999.999-99");      
        personalizarCamposTipo(tipo); 
    }
}

function personalizarCamposTipo(tipo)
{
    $("#div_nome").removeClass();
    $("#div_razao").removeClass();
    if(tipo=="J")
    {
        $("#div_razao").show();
        $("#div_nome").addClass("col-md-6");
        $("#div_razao").addClass("col-md-6");
    }
    else
    {
        $("#div_razao").hide();
        $("#div_nome").addClass("col-md-12");
    }         
}

function editar()
{
    msg_confirm("Editar","Deseja editar ?",function()
    {   
        $('#btn_editar').toggle(150);
        $('#btn_salvar').toggle(150);
        $("#form :input").prop('disabled', false); 
    });        
}

function cancelar()
{
    msg_confirm("Cancelar","As alterações serão perdidas ?",function()
    {
        reload();
    });
}   

function ValidarCPF_CNPJ(dados)
{
    var tipo = dados['tipo'].substring(0, 1);
    $("#CPF_CNPJ").removeClass("error");

    if(tipo==="F")
    {
        if(dados['CPF_CNPJ'].trim()!="")
        {
            if(!validarCPF(dados['CPF_CNPJ']))
            {
                msg("Oops","CPF Inválido !!","error");
                return false;
            }
        }
    }
    else
    {
        if(dados['CPF_CNPJ'].trim()!="")
        {
            if(!validarCNPJ(dados['CPF_CNPJ']))
            {
                msg("Oops","CNPJ Inválido !!","error");
                return false;
            }
        }
    }
    return true;
}

$('#form').submit(function(form) 
{
    dados = $('#form').FormData();
    dados['id']={{$pessoa->id}};

    if(!ValidarCPF_CNPJ(dados))
        return false;

    xCode.ajax("put","{{asset('admin/persons/'.$tipo.'/edit')}}",dados).then(function(response)
    {
        if(response.success)
        {
            msg_stop(':)',response.msg,function()
            {
                reload();
            },'success');
        }
        else
           return msg('Oops',response.msg,"error");
    });
    return false;
});

$('#btn_salvar').click(function()
{
    $('#form .submit').click();
    return false;
});


function clonar()
{
    msg_confirm("Confirmação","Deseja clonar este cadastro ?",function()
    {
        send("post","{{asset('admin/persons/'.$tipo.'/clone')}}",{id:"{{$pessoa->id}}"});
    });
}
</script>
@stop