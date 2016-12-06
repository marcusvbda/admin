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
          <div class="box-body table-responsive no-padding">  
            <div class="col-md-12">
               <table class="table table-striped" id="tabela">
               <thead>
                  <tr>
                      <th>Código</th>
                      <th>Descrição</th>
                      <th>Código ST</th>
                      <th>Aliquota IPI</th>
                      <th>Aliquota ISS</th>
                      <th class="centro">Calcula PIS</th>
                      <th class="centro">Calcula Cofins</th>                   
                  </tr>
               </thead>
               <tbody>
                  @foreach($grupos as $grupo)
                  <tr>
                    <td>{{$grupo->codigo}}</td>
                    <td>{{$grupo->descricao}}</td>
                    <td>{{$grupo->codigo_st}}</td>
                    <td>{{$grupo->aliquota_ipi}}</td>
                    <td>{{$grupo->aliquota_iss}}</td>
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
            </div>
          </div>
        </div>
      </div>
    </div>

          
  </div>  
</div>

@stop