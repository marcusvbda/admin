@extends('painel.template.painel')
@section('titulo',ucfirst($tipo))
@section('topo')
<section class="content-header">
  <h1>
    <i class="fa fa-user"></i>
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


            <form id="form"> 
                <div class="row">
                    
                    <div class="card col-md-12 conteudo">


                        <div class="tab-content">
                            <br>              
                                <div class="row">
                                    <div class="col-md-12" id="div_nome">
                                        <div class="input-group input-group-sm"> 
                                            <span class="input-group-addon">Nome</span> 
                                            <input type="text" class="form-control" name="nome" id="nome" maxlength="150"
                                            value="@if(isset($pessoa)){{$pessoa->nome}}@endif" value="{{old('$pessoa->nome')}}" required> 
                                        </div>
                                    </div>
                                    <div class="col-md-6" id="div_razao" style="display: none">
                                        <div class="input-group input-group-sm"> 
                                            <span class="input-group-addon">Razão</span> 
                                            <input type="text" class="form-control" name="razao" id="razao" maxlength="150"
                                            value="@if(isset($pessoa)){{$pessoa->razao}}@endif"> 
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <label>
                                               <input class="radio squared" name="tipo" id="tipo" type="radio" value="Fisica" onchange="mudaMascara('F')" 
                                               @if(isset($pessoa)) @if($pessoa->tipo=="F") checked="checked" @endif @else checked="checked" @endif>
                                               Fisica
                                            </label>
                                            <label>
                                               <input class="radio squared" name="tipo" id="tipo" type="radio" value="Jurídica" onchange="mudaMascara('J')" 
                                               @if(isset($pessoa)) @if($pessoa->tipo=="J") checked="checked" @endif @endif>
                                               Jurídica
                                            </label>         
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group input-group-sm"> 
                                            <span class="input-group-addon" id="LABEL_CPF_CNPJ">CPF</span> 
                                            <input type="text" class="form-control" name="CPF_CNPJ" id="CPF_CNPJ" maxlength="25"
                                            value="@if(isset($pessoa)){{$pessoa->CPF_CNPJ}}@endif"> 
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="input-group input-group-sm"> 
                                            <span class="input-group-addon">Email</span> 
                                            <input type="email" class="form-control" name="email" id="email" maxlength="250"
                                            value="@if(isset($pessoa)){{$pessoa->email}}@endif"> 
                                        </div>
                                    </div>
                                </div>
                            <br>           
                        </div>

                        <input type="submit" class="btn btn-primary btn-sm" value="Salvar">                

                            
                    </div>
                 

                </div>
            </form>


    </div>
</div>

<script type="text/javascript">
mudaMascara(@if(isset($pessoa)) '{{$pessoa->tipo}}'  @else 'F' @endif);

    
function mudaMascara(tipo=null)
{
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
    dados['classificacao']="{{$classificacao}}";

    if(!ValidarCPF_CNPJ(dados))
        return false;

    xCode.ajax("post","{{asset('admin/persons/'.$tipo.'/store')}}",dados).then(function(response)
    {
        if(response.success)
        {
            msg_stop(':)',response.msg,function()
            {
                load("{{asset('admin/persons/'.$tipo.'/show')}}"+"/"+response.codigo);
            },'success');
        }
        else
           return msg('Oops',response.msg,"error");
    });
    return false;
});

</script>
@stop