@extends('painel.template.painel')
@section('titulo','Usuários')
@section('topo')
<section class="content-header">
  <h1>
    <i class="fa fa-users"></i>  Usuários
    <small>Listagem e ações</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{asset('admin')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Usuários</li>
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
                          <button class="btn @if($ativo=="A") btn-primary @else btn-default @endif  btn-sm" 
                          onclick="mostrar('A')">Ativos</button>                           
                       </label> 
                       <label>
                           <button class="btn @if($ativo=="I") btn-primary @else btn-default @endif  btn-sm"
                            onclick="mostrar('I')">Inativos</button> 
                       </label> 
                       <label>
                           <button class="btn @if($ativo=="T") btn-primary @else btn-default @endif  btn-sm" 
                           onclick="mostrar('T')">Todos</button> 
                       </label> 
                   </div>
               </div>
               <div class="pull-right">
                   @if(can('usuarios','post'))
                   <a type="button" class="btn btn-primary btn-sm" href="{{asset('admin/users/create')}}"><i class="fa fa-plus-circle"></i> Novo</a>
                   @endif
               </div>
           </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12">
                <table id="tab_usuarios" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th style="display: none;">id</th>
                            <th>Nome</th>
                            <th>Email</th>
                            <th class="text-center"><span class="fa fa-gears"></span></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($usuarios as $us)
                        <tr>
                            <td style="display: none;">{{$us->id}}</td>
                            <td>{{$us->nome}} {{$us->sobrenome}}</td>
                            <td>{{$us->email}}</td>                                
                            <td class="text-center" >
                                @if(can('usuarios','get'))
                                <a type="button" class="btn btn-info btn-sm" href="{{asset('admin/users/show/'.base64_encode($us->id))}}">
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
                                    @if(can('usuarios','put'))
                                    <li class="col-md-12">
                                      <a  class="btn btn-info btn-sm" onclick="inativar()">
                                         <span class="glyphicon glyphicon-lock"></span> Inativar / Ativar
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
  <!-- /.box-body -->
</div>

<script type="text/javascript">
var table = dataTable('#tab_usuarios');    
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


function mostrar(mostrar)
{
    send('post',"{{asset('admin/users')}}",{mostrar},null);
}

function inativar()
{
    var selecionados = getSelecionados();
    if(selecionados.length<=0)
        return msg('Oops','Nenhum item selecionado para ação','error');
    msg_confirm('Confirmação',"Deseja mesmo inativar este usuário ?",function()
    {   
        xCode.ajax("put","{{asset('admin/users/ativar')}}",{selecionados}).then(function(response)
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
</script>
@stop