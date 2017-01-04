@extends('templates.principal.principal')

@section('titulo','Dashboard')

@section('topo')
<h1>Dashboard
  <small>Painel de controle</small>
</h1>
<ol class="breadcrumb">
  <li><i class="fa fa-dashboard"></i> Início</li>
</ol>
@stop



@section('conteudo')


<div class="row" style="display: none;" id="div_importacao_dados">
	<div class="col-md-12">
		<div class="box">
			<div class="box-header">
		      	<p class="title_box">Importação de Dados</p>
		      	<div class="box-tools pull-right">
			    	<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"><i class="fa fa-minus"></i></button>
			    </div>			 
				<div class="box-tools pull-right">
				</div>
			</div>
			<div class="box-body">
			  <!-- conteudo -->
				

		           
		           	<div class="col-md-4" id="importacao_notificacao" style="display:none;">
						<div class="small-box bg-red">
							<div class="inner">
								<h3 id="importacao_qtde">0</h3>
							        <p id="importacao_texto">Arquivo aguardando importação</p>
							</div>
							<a id="importacao_btn_importar" class="small-box-footer">Importar <i class="fa fa-arrow-circle-right"></i></a>
						</div>
					</div>
					<div id="importacao_loading" style="display:none;">
						<div class="col-md-4">
							<div class="small-box">
							    <div class="centro">
							        <p><img src="{{asset()}}/template/img/loading.gif"></p>
							    </div>
							    <a class="small-box-footer"> <strong style="color:black;">Importando ...  </strong></a>
							</div>
						</div>
					</div>

					<div class="col-md-4" id="btn_ultima_importacao">
						<div class="small-box bg-green">
							<div class="inner">
								<h3><i class="glyphicon glyphicon-thumbs-up"></i></h3>
							    <p id="data_ultima_importacao">20/09/2016</p>
							</div>
							<a href="{{asset('importacao/Importados')}}" class="small-box-footer"> Ver Importações Com Sucesso <i class="fa fa-arrow-circle-right"></i></a>
						</div>
					</div>

					<div class="col-md-4" id="btn_importacao_erro" style="display:none;">
						<div class="small-box bg-yellow">
							<div class="inner">
								<h3><i class="glyphicon glyphicon-thumbs-down"></i></h3>
							    <p id="qtde_com_erro">0</p>
							</div>
							<a href="{{asset('importacao/erro')}}" class="small-box-footer"> Ver Importações Com Erro <i class="fa fa-arrow-circle-right"></i></a>
						</div>
					</div>






			</div>
			<div class="box-footer">
				<!-- rodapé -->
			</div>
		</div>
	</div>
	
</div>


@if(parametro('lista_de_afazeres')=="S")
	<div class="row" style="display:none;" id="lista_de_afazeres">
		<div class="col-md-5">
			<div class="box">
				<div class="box-header with-border" style="height: 31px;">
				  <p class="title_box">Lista de Afazeres (<span id="porcentagem_afazeres">0%</span>)</p>		
				  <div class="box-tools pull-right">
				    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"><i class="fa fa-minus"></i></button></div>
				</div>
				<div class="box-body">
				  <!-- conteudo -->
						
						<div class="progress sm">
	                      <div class="progress-bar progress-bar-aqua" id="afazeres_porcentagem_progresso" style="width: 0%"></div>
	                    </div>
			           
			            <!-- /.box-header -->
			              <ul class="todo-list ui-sortable" id="afazeres" style="overflow: hidden;"> 
			                
			               
			              </ul>
			            <!-- /.box-body -->
			            <div class="box-footer clearfix no-border">
			              <button onclick="novoafazer();" type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Novo Afazer</button>
			            </div>



				</div>
				<div class="box-footer">
					<!-- rodapé -->
				</div>
			</div>
		</div>

	</div>
@endif




@stop
