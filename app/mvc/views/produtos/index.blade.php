@extends('templates.principal.principal')

@section('titulo','Produtos')

@section('topo')
<h1>Produtos
  <small>Listagem</small>
</h1>
<ol class="breadcrumb">
  <li><a href="{{asset('admin/inicio')}}"><i class="fa fa-dashboard"></i> Início</a></li>
  <li><a href="{{asset('admin/produtos')}}"><i class="glyphicon glyphicon-erase"></i> Produtos</a></li>
</ol>
@stop


@section('conteudo')
<div class="col-md-12">
  <div class="box">
    <div class="box-header with-border">
        <p class="title_box"></p>  
      <div class="box-tools pull-right">
        <!-- <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"><i class="fa fa-minus"></i></button></div> -->
      </div>

   

        <div class="row">
          <form method="GET" action="{{asset('produtos')}}">
            <div class="col-md-12">
              <div class="input-group input-group-sm" >
                  <input type="text" style="text-transform:uppercase" name="filtro" value="{{$filtro}}" class="form-control pull-right" id="filtro" placeholder="Filtro de busca">
                  <div class="input-group-btn">
                    <button id="btn-filtro" type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
              </div>
            </div>
          </form>
        </div>
        <br>
         {{$qtde_registros}} 
          @if($qtde_registros>1)
            Registros
          @else  
            Registro
          @endif
          ({{number_format($tempo_consulta,5)}} segundos)
           <button title="Gerar Relatório" onclick="imprimir();" class="btn btn-default pull-right"><span class="glyphicon glyphicon-print"></span></button>
        <hr>

        <div class="row">
          <div class="box-body table-responsive no-padding">  
            <div class="col-md-12">
               <table class="table table-striped" id="tabela">
               <thead>
                  <tr>
                      <th>Código</th>
                      <th>Código Estendido</th>
                      <th>Nome</th>
                      <th>Descrição</th>
                      <th class="centro"><span class="glyphicon glyphicon-cog"></span></th>                      
                  </tr>
               </thead>
               <tbody>
                  @foreach($produtos as $produto)
                  <tr>
                    <td>{{$produto->codigo}}</td>
                    <td>{{$produto->codigoestendido}}</td>
                    <td>{{$produto->nomefantasia}}</td>
                    <td>{{$produto->descricao}}</td>
                    <td class="centro">
                      <a title="Visualizar" href='{{asset("produtos/show/$produtos->sequencia")}}' class="btn btn-primary"><span class="glyphicon glyphicon-search"></span></a>
                    </td>
                  </tr>
                  @endforeach
               </tbody>
             </table>
             {{$produtos->links()}}
            </div>
          </div>
        </div>
      </div>

          
  </div>  
</div>

<script src="{{PASTA_PUBLIC}}/template/plugins/jQuery/jquery.min.js"></script>
<script src="{{PASTA_PUBLIC}}/template/bootstrap/js/custom.js"></script>
<script type="text/javascript">
function imprimir()
{
  var action = "{{asset('produtos/relatorio_simples')}}";
  var form = '<form action="'+action+'" method="post">' +
                '<input type="hidden" value="'+$('#filtro').val()+'" name="filtro" />' +
              '</form>';
  $('body').append(form);
  $(form).submit();  
}
</script>

@stop