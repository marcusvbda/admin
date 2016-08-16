@extends('templates.principal.principal')

@section('titulo','ERRO')

@section('topo')
<!-- <h1>Dashboard
  <small>Subtitulo</small>
</h1> -->
<!-- <ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Início</a></li>
  <li><a href="#">Pagina em branco</a></li> 
</ol> -->
@stop


@section('conteudo')
<div class="col-md-12">
	<div class="box">
		<div class="box-header with-border">
		  <h3 class="box-title">

		  </h3>
		  <div class="box-tools pull-right">
		    <!-- <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"><i class="fa fa-minus"></i></button></div> -->
		</div>
		<div class="box-body">
		  <!-- conteudo -->
				
  		<section class="content">
        <div class="error-page">
          <h2 class="headline text-yellow">403  </h2>

          <div class="error-content">
            <h3><i class="fa fa-warning text-yellow"></i> Oops! Acesso não autorizado.</h3>

            <p>
              Para acessar o endereço solicitado é obrigatório uma autenticação de administrador, tente novamente com outro usuário.
            </p>

        
          </div>
          <!-- /.error-content -->
        </div>
      </section>

		</div>
		<div class="box-footer">
			<!-- rodapé -->
		</div>
	</div>
</div>
@stop