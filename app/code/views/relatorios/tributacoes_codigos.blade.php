@extends('templates.principal.principal')

@section('titulo','Tribuatações / Códigos')

@section('topo')
<h1>Relatório
  <small>Tribuatações / Códigos</small>
</h1>
<ol class="breadcrumb">
  <li><a href="{{asset('')}}"><i class="fa fa-dashboard"></i> Início</a></li>
  <li><i class="glyphicon glyphicon-list-alt"></i> Relatório de Tribuatações / Códigos</li>
</ol>
@stop


@section('conteudo')
<div class="col-md-12">
	<div class="box">
		<div class="box-header">
	      	<p class="title_box"></p>			 
			<div class="box-tools pull-right">
			</div>
		</div>
		<div class="box-body">
		  <!-- conteudo -->
		
		<div class="row">
			<div class="col-md-12">

					
					<div class="row">
						<div class="col-md-2">
							<label>NCM</label>
							<input class="form-control" type="text" pattern="[0-9.]+" id="NCM" 
							@if(isset($ncm)) value="{{$ncm}}" @endif>
						</div>
						<div class="col-md-2">
							<label>ANP</label>
							<input class="form-control" type="text" pattern="[0-9.]+" id="ANP"
							@if(isset($anp)) value="{{$anp}}" @endif>
						</div>
						<div class="col-md-2">
							<label>CEST</label>
							<input class="form-control" type="text" pattern="[0-9.]+" id="CEST"
							@if(isset($cest)) value="{{$cest}}" @endif>
						</div>
						<div class="col-md-2">
							<label>CST Entrada</label>
							<input class="form-control" type="text" pattern="[0-9.]+" id="CST_entrada"
							@if(isset($cst_ent)) value="{{$cst_ent}}" @endif>
						</div>
						<div class="col-md-2">
							<label>CST Saida</label>
							<input class="form-control" type="text" pattern="[0-9.]+" id="CST_saida"
							@if(isset($cst_saida)) value="{{$cst_saida}}" @endif>
						</div>						
						<div class="col-md-2">
							<button type="submit" onclick="filtrar()" style="padding-bottom: 30px;padding-top: 30px;" class="btn btn-default"><span class="glyphicon glyphicon-print"></span> Relatório</button>
						</div>
					</div>


			</div>
		</div>

		<hr>


        <div class="row">
          @if(isset($produtos))
            <div class="col-md-12">
                    <br>      
                     <table class="table table-hover" style="font-size: 14px" id="tabela">
                      <thead>
                        <tr style="background-color: #F4F4F4;border-radius: 100px;">
                          <th>Código</th>
                          <th>Descrição</th>                
                          <th>cst saida</th>
                          <th>cst entrada</th>
                          <th>cest</th>
                          <th>ncm</th>
                          <th>anp</th>
                        </tr>
                      </thead>
                     <tbody>
                        @foreach($produtos as $prod)
                        <tr>
                          <td>{{$prod->codigo}}</td>
                          <td>{{$prod->descricao}}</td>
                          <td>{{$prod->codigo_st}}</td>
                          <td>{{$prod->codigo_stentrada}}</td>
                          <td>{{$prod->codigo_cest}}</td>      
                          <td>{{$prod->codigo_nbmsh}}</td>      
                          <td>{{$prod->codigoanp}}</td>       
                        </tr>
                        @endforeach
                     </tbody>
                   </table>
                  <hr> 
            </div>
          @endif
        </div>


		</div>
		<div class="box-footer">
			<!-- rodapé -->
		</div>
	</div>
</div>
@stop