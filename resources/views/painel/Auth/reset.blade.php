<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="_token" content="{!! csrf_token() !!}"/>
  <link rel="icon" type="image/png" href="{{asset('public/custom/img')}}/{{env('FAVICON')}}" />
  <title>Esqueci a senha</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="{{asset('public/painel/bootstrap/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('public/painel/dist/css/AdminLTE.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('public/painel/plugins/iCheck/square/blue.css')}}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <img src="{{asset('public/custom/img')}}/{{env('FAVICON')}}" style="width: 20%">
    <b>{{env('APP_NAME')}}</b>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Digite seu email para receber o link de renovação</p>
    <div id="loading" style="display: none;text-align: center;">
        <img src="{{asset('public/custom/img/loading.gif')}}">
    </div>
    <form id="frm_reset">
      <div class="form-group has-feedback">
        <input type="email" id="usuario" class="form-control" name="usuario"  placeholder="Email" required max="250">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-12">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Enviar link para este email</button>
        </div><!-- /.col -->
      </div>
    </form>
    <!-- /.social-auth-links -->

    <a href="{{asset('admin/auth/login')}}">Voltar à página de login</a><br>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="{{asset('public/painel/plugins/jQuery/jquery-2.2.3.min.js')}}"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{asset('public/painel/bootstrap/js/bootstrap.min.js')}}"></script>
<!-- iCheck -->
<script src="{{asset('public/painel/plugins/iCheck/icheck.min.js')}}"></script>

<!-- sweetalert -->
<script src="{{asset('public/libs/sweetalert/sweetalert.min.js')}}"></script>  
<link rel="stylesheet" type="text/css" href="{{asset('public/libs/sweetalert/sweetalert.css')}}">

<script src="{{asset('public/libs/xCode/xCode.js')}}"></script>
<script>
$(function () {
  $('input').iCheck({
    checkboxClass: 'icheckbox_square-blue',
    radioClass: 'iradio_square-blue',
    increaseArea: '20%' // optional
  });
});

function loading()
{
    $('#frm_reset').toggle(150);
    $('#loading').toggle(150);
}

$('#frm_reset').submit(function(event) 
{
    var usuario = $('#usuario').val();
    loading();
    xCode.ajax("post","{{asset('admin/auth/reset')}}",{usuario}).then(function(response)
    {
      console.log(response);
        loading();
        if(response.success)
        {
            msg_stop("",response.msg,function()
            {
                load("{{asset('admin/auth/login')}}");
            },'success');
        }
        else
            return msg("Ooops",response.msg,"error");
    });
    event.preventDefault();
});
</script>
</body>
</html>
