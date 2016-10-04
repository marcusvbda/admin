@extends('templates.principal.principal')

@section('titulo','Grupos Produtos')

@section('topo')
<h1>Produtos
  <small>Tipos</small>
</h1>
<ol class="breadcrumb">
  <li><a href="{{asset('admin/inicio')}}"><i class="fa fa-dashboard"></i> Início</a></li>
  <li><a href="{{asset('admin/produtos/grupos')}}"><i class="glyphicon glyphicon-erase"></i> Grupos Produtos</a></li>
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
          <form method="GET" action="{{asset('produtos/grupos')}}">
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
                      <th>Descrição</th>
                      <th class="centro">Calcula PIS</th>
                      <th class="centro">Calcula Cofins</th>                   
                  </tr>
               </thead>
               <tbody>
                  @foreach($grupos as $grupo)
                  <tr>
                    <td>{{$grupo->codigo}}</td>
                    <td>{{$grupo->descricao}}</td>
                    <td class="centro">
                      @if($grupo->calcula_pis=='S')
                        <span class="glyphicon glyphicon-ok" style="color:green;"></span>
                      @else
                        <span class="glyphicon glyphicon-remove" style="color:red;"></span>
                      @endif
                    </td>
                    <td class="centro">
                      @if($grupo->calcula_cofins=='S')
                        <span class="glyphicon glyphicon-ok" style="color:green;"></span>
                      @else
                        <span class="glyphicon glyphicon-remove" style="color:red;"></span>
                      @endif
                    </td>
                  </tr>
                  @endforeach
               </tbody>
             </table>
             {{$grupos->links()}}
            </div>
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
  var action = "{{asset('produtos/relatorio_simples_tipos')}}";
  var form = '<form action="'+action+'" method="post">' +
                '<input type="hidden" value="'+$('#filtro').val()+'" name="filtro" />' +
              '</form>';
  $('body').append(form);
  $(form).submit();  
}
</script>

@stop