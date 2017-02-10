@extends('templates.principal.principal')

@section('titulo','Arquivos de importação')

@section('topo')
<h1>Arquivos
  <small>de importação</small>
</h1>
<ol class="breadcrumb">
  <li><a href="{{asset('inicio')}}"><i class="fa fa-dashboard"></i> Início</a></li>
  <li><a href="{{asset('importacao')}}"><i class="glyphicon glyphicon-circle-arrow-down"></i> Arquivos de importação</a></li>
</ol>
@stop


@section('conteudo')

<div class="col-md-2">
  <div class="box">
    <div class="box-header with-border">
        <p class="title_box">Pastas</p>  
        <div class="col-md-12 text-center">
          <a href="{{asset('importacao/importar')}}"><button  class="btn btn-success">Importar</button></a>
        </div>
        <div class="col-md-12 text-center">
          <a href="{{asset('importacao/importados')}}"><button class="btn btn-warning btn-sm">Importados</button></a>
        </div>
        <div class="col-md-12 text-center">
          <a href="{{asset('importacao/erro')}}"><button class="btn btn-danger btn-sm">Erro</button></a>
        </div>
    </div>
  </div>
</div>


<div class="col-md-10">
  <div class="box">
    <div class="box-header with-border">
        <p class="title_box">Arquivos</p>  
      <div class="box-tools pull-right">
        <!-- <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"><i class="fa fa-minus"></i></button></div> -->
      </div>

        <div class="row">
          <div class="box-body table-responsive no-padding">  
            <div class="col-md-12">
               <table class="table table-striped" id="tabela">
               <thead>
                  <tr>
                      <th>Nome</th>
                      <th>Data de Geração</th>                   
                      <th>Pasta</th>  
                      <th class="centro"><span class="glyphicon glyphicon-cog"></span></th>                    
                  </tr>
               </thead>
               <tbody>
                  @foreach($arquivos as $arq)
                  <tr>
                    <td>{{$arq->arquivo}}</td>
                    <td>{{$arq->data_geracao}}</td>       
                    <td>{{$arq->pasta}}</td>
                     <td class="centro">
                      <div class="tools">                   
                        @if($arq->pasta=='IMPORTAR')                         
                        <a title="Mover Arquivo" title="Importar Arquivo" onclick="importar_arquivo('{{$arq->arquivo}}')">
                          <i class="glyphicon glyphicon-share-alt " style="color:#1FA65A;"></i>
                        </a>
                        @endif
                        <a title="Excluir" onclick="excluir('{{$arq->arquivo}}','{{$arq->pasta}}')">
                          <i class="fa fa-trash-o" style="color:#DD4B39;"></i>
                        </a>  
                      </div>
                    </td>
                  </tr>
                  @endforeach
               </tbody>
             </table>
            </div>
          </div>
        </div>
      </div>

          
  </div>  
</div>

<script src="{{PASTA_PUBLIC}}/template/plugins/jQuery/jquery.min.js"></script>
<script src="{{PASTA_PUBLIC}}/template/bootstrap/js/custom.js"></script>
<script type="text/javascript">
function excluir(arquivo,pasta,excluir=false)
{
  if(excluir)
  {
    $.post("{{asset('importacao/ExcluirArquivo')}}", { arquivo: arquivo, pasta:pasta });
    location.reload();
  }
  else
    msg_confirm('<strong>Confirmação</strong>','Deseja excluir este arquivo?',"excluir('"+arquivo+"','"+pasta+"',true)"); 
}

function importar_arquivo(arq,importar=false)
{
  if(importar)
  {
    $.post("{{asset('importacao/Importar')}}", { arquivo: arq});
    location.reload();
  }
  else
    msg_confirm('<strong>Confirmação</strong>','Deseja Importar o arquivo ('+arq+')?',"importar_arquivo('"+arq+"',true)"); 
}
</script>

@stop