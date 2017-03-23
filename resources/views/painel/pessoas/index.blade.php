@extends('painel.template.painel')
@section('titulo',ucfirst($tipo))

@section('topo')
<section class="content-header">
  <h1>
    <i class="fa fa-users"></i> {{ucfirst($tipo)}}
    <small> Listagem e Ações</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{asset('painel')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">{{ucfirst($tipo)}}</li>
  </ol>
</section>
@stop

@section('conteudo')
<div class="box box-primary">
  <!-- /.box-header -->
    <div class="box-body">
        <div class="row">
           <div class="col-md-12">
               <div class="pull-left">
                   <div> 
                       <label>
                          <button class="btn @if($ativo=='A') btn-primary @else btn-default @endif  btn-sm" 
                          onclick="mostrar('A')">Ativos</button>                           
                       </label> 
                       <label>
                           <button class="btn @if($ativo=='I') btn-primary @else btn-default @endif  btn-sm"
                            onclick="mostrar('I')">Inativos</button> 
                       </label> 
                       <label>
                           <button class="btn @if($ativo=='T') btn-primary @else btn-default @endif  btn-sm" 
                           onclick="mostrar('T')">Todos</button> 
                       </label> 
                   </div>
               </div>
               <div class="pull-right">
                   @if(can('usuarios','post'))
                   <a type="button" class="btn btn-primary btn-sm" href="{{asset('admin/persons')}}/{{$tipo}}/create"><i class="fa fa-plus-circle"></i> {{_('Novo')}}</a>
                   @endif
               </div>
           </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12">
                <table id="tab_pessoas" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th style="display: none">id</th>
                            <th></th>                              
                            <th>Nome</th>
                            <th>Razão</th>
                            <th>Tipo Pessoa</th>
                            <th>CPF/CNPJ</th>
                            <th class="text-center"><span class="fa fa-gears"></span></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($pessoas as $pessoa)
                        <tr>    
                            <td style="display: none">{{$pessoa->id}}</td>                                                          
                            <td class="text-center">
                                @if($pessoa->bloqueado===uppertrim('S')) 
                                    <span class="fa fa-lock" title="Bloqueado"></span>
                                @else
                                    <span class="fa fa-unlock" title="Bloqueado"></span>
                                @endif</td>             
                            <td>{{$pessoa->nome}}</td>
                            <td>{{$pessoa->razao}}</td>
                            <td>@if($pessoa->tipo=='F') Fisica @else Jurídica @endif</td>
                            <td>{{$pessoa->CPF_CNPJ}}</td>
                            <td class="text-center" >
                                @if(can('pessoas','get'))
                                <a type="button" class="btn btn-info btn-sm" href="{{asset('admin/persons/'.$tipo.'/show/'. base64_encode($pessoa->id))}}">
                                    <i class="glyphicon glyphicon-eye-open"></i> Ver
                                </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <hr>
                <div class="row">    
                    <div class="col-md-12">  
                        <div class="pull-left">   
                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Ações
                                </button>
                                <ul class="dropdown-menu">
                                    @if(can('pessoas','put'))
                                    <li class="col-md-12">
                                        <a  class="btn btn-info btn-sm" onclick="inativar()">
                                           <span class="glyphicon glyphicon-lock"></span> Inativar / Ativar
                                        </a>    
                                      </li>
                                      <li class="col-md-12">
                                        <a  class="btn btn-warning btn-sm" onclick="bloquear()">
                                           <span class="glyphicon glyphicon-lock"></span> Bloquear / Desbloquear
                                        </a>   
                                    </li>
                                    @endif
                                    @if(can('pessoas','delete'))
                                    <br>
                                    <hr>
                                    <br>
                                    <li class="col-md-12">
                                      <a  class="btn btn-danger btn-sm" onclick="excluir()">
                                         <span class="fa fa-trash"></span> Excluir
                                     </a>         
                                    </li>
                                    @endif
                                </ul>
                            </div>                    
                        </div>
                    </div>
                </div>

            </div>
        </div>



    </div>
</div>

<script type="text/javascript">
var table = dataTable('#tab_pessoas'); 

function getSelecionados()
{
    var dados = table.rows('.selected').data();
    var selecionados = [];
    for (var i=0; i < dados.length ;i++)
    {
       selecionados[i] = dados[i][0];
    }
    return selecionados;
}

function excluir()
{
    var selecionados = getSelecionados();
    if(selecionados.length<=0)
        return msg('Oops','Nenhum item selecionado para ação','error');
    msg_confirm('Confirmação',"Deseja mesmo excluir a(s) pessoas(s) selecionado(s) ?",function()
    {   
        xCode.ajax("delete","{{asset('admin/persons/'.$tipo.'/destroy')}}",{selecionados}).then(function(response)
        {
            if(response.success)         
                msg_stop(":)",response.msg,function()
                {
                    reload();
                });
            else
                return msg("Oops",response.msg,"error"); 
        });    
    });    
}

function bloquear()
{
    var selecionados = getSelecionados();
    if(selecionados.length<=0)
        return msg('Oops','Nenhum item selecionado para ação','error');
    msg_confirm('Confirmação',"Deseja mesmo bloquear a(s) pessoas(s) selecionado(s) ?",function()
    {   
        xCode.ajax("put","{{asset('admin/persons/'.$tipo.'/bloquear')}}",{selecionados}).then(function(response)
        {
            if(response.success)         
                msg_stop(":)",response.msg,function()
                {
                    reload();
                });
            else
                return msg("Oops",response.msg,"error"); 
        });    
    });    
}

function inativar()
{
    var selecionados = getSelecionados();
    if(selecionados.length<=0)
        return msg('Oops','Nenhum item selecionado para ação','error');
    msg_confirm('Confirmação',"Deseja mesmo excluir a(s) pessoas(s) selecionado(s) ?",function()
    {   
        xCode.ajax("put","{{asset('admin/persons/'.$tipo.'/ativar')}}",{selecionados}).then(function(response)
        {
            if(response.success)         
                msg_stop(":)",response.msg,function()
                {
                    reload();
                });
            else
                return msg("Oops",response.msg,"error"); 
        });    
    });    
}

function mostrar(mostrar)
{
    send('post',"{{asset('admin/persons/'.$tipo)}}",{mostrar},null);
}
</script>
@stop