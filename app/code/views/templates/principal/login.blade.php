<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('titulo')</title>
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

  	   <div class="register-box-body">
  	    	@yield('conteudo')
  	   </div>
  	   		@yield('sublink')	
    </div>   
	</div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->

<!-- Bootstrap 3.3.6 -->
<script src="{{asset()}}template/plugins/jQuery/jquery.min.js"></script>
<script src="{{asset()}}template/bootstrap/js/bootstrap.min.js"></script>
<script src="{{asset()}}assets/js/custom.js"></script>



</body>
</html>