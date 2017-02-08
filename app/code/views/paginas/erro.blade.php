<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Erro {{$erro}}</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="{{asset()}}template/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="{{asset()}}template/dist/css/AdminLTE.min.css">
  <link rel='icon' href={{asset('template/img/icone.ico')}} type='image/gif'>

  <!-- iCheck -->

<style type="text/css"></style></head>
<body class="hold-transition register-page" cz-shortcut-listen="true" style="overflow-y: hidden;">
	<div class="register-box">	
    <div class="contero_total">
        <div class="register-logo">
          <p><img src="{{asset('template/img/icone.ico')}}"></p>
        </div>

  	   <div class="register-box-body text-center">
  	    	<h1><strong>Erro {{$erro}}</strong></h1>
  	    	<h4>{{$sub}}</h4>
  	    	<h4>{{$subsub}}</h4>
  	    	<hr>  	    	
	  	    @if(CheckAuth())
	  	    	<a class="btn btn-primary" href="{{asset('')}}">Voltar ao Dashboard</a>
	  	    @else
	  	    	<a class="btn btn-primary" href="{{asset('')}}">Ir à página de login</a>
	  	    @endif
  	   </div>
    </div>   
	</div>
  <!-- /.form-box -->
</div>



</body>
</html>