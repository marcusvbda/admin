@extends('painel.template.painel')
@section('titulo','Grupos de Acesso')
@section('topo')
<section class="content-header">
  <h1>
    <i class="fa fa-unlock"></i>  Grupos de Acesso
    <small>Listagem e ações</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{asset('admin')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="{{asset('admin/groups')}}"><i class="fa fa-unlock"></i> Grupos de Acesso</a></li>
  </ol>
</section>
@stop
@section('conteudo')
<div class="box box-primary">

  <!-- /.box-header -->
    <div class="box-body">
        <div class="row">
           <div class="col-md-12">
               <div class="pull-right">
                   @if(can('grupos_acesso','post'))
                   <a type="button" class="btn btn-primary btn-sm" href="{{asset('admin/users/groupscreate')}}"><i class="fa fa-plus-circle"></i> novo</a>
                   @endif
               </div>
               <hr>
           </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table id="tab_grupos" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th style="display: none;"></th>
                        <th>Grupo</th>
                        <th class="text-center"><span class="fa fa-gears"></span></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($grupos as $gp)
                    <tr>
                        <td style="display: none;"> {{$gp->id}}</td>
                        <td>{{$gp->descricao}}</td>
                        <td style="text-align: center;">
                            @if(can('grupos_acesso','get'))
                            <button class="btn btn-info btn-sm" onclick="ver('{{base64_encode($gp->id)}}')">
                                <i class="glyphicon glyphicon-eye-open"></i> Ver
                            </button>
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
                                @if(can('grupos_acesso','delete'))
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
  <!-- /.box-body -->
</div>

<script type="text/javascript">
var table = dataTable('#tab_grupos');  

function ver(id)
{
    load("{{asset('admin/users/groups/show')}}"+"/"+id);
}


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
        return msg('Oops',"Nenhum item selecionado para ação",'error');
    msg_confirm('Confirmação',"Deseja mesmo excluir o(s) grupo(s) selecionado(s) ?",function()
    {   
        xCode.ajax("delete","{{asset('admin/users/groupdestroy')}}",{selecionados}).then(function(response)
        {
            if(response.success)         
                msg_stop(":)",response.msg,function()
                {
                    reload();
                });
            else
            {
                return msg("Oops",response.msg,"error"); 
            }
        });    
    });    
}
</script>
@stop