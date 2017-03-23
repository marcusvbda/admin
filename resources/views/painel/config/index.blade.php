@extends('painel.template.painel')
@section('titulo','Configurações')
@section('topo')
<section class="content-header">
  <h1>
    <i class="fa fa-wrench"></i>
    Configurações
    <small>Parâmentros de sistema</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{asset('admin')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Configurações</li>
  </ol>
</section>
@stop
@section('conteudo')

<div class="col-md-6">
  <div class="box box-primary">
      <div class="box-header">
          <i class="fa fa-sort-numeric-asc"></i>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>      
            <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
          </div>
          <h3 class="box-title">Numerais</h3>    
      </div>
    <!-- /.box-header -->
      <div class="box-body">

        <form id="frm_numerais">
          <div class="row">
            <div class="col-md-6">
              <div class="input-group input-group-sm"> 
                  <span class="input-group-addon">Moeda</span> 
                  <select class="form-control" disabled="" name="moeda" id="moeda">
                    <option value="R$" @if($config->moeda=="R$") checked @endif>R$ (Real - Brasil)</option>
                  </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="input-group input-group-sm"> 
                  <span class="input-group-addon">Casas decimais moeda</span> 
                  <input type="number" step="1"  class="form-control" name="qtde_dec_dinheiro" id="qtde_dec_dinheiro" value="{{$config->qtde_dec_dinheiro}}" disabled="" required=""> 
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="input-group input-group-sm"> 
                  <span class="input-group-addon">Casas decimais %</span> 
                  <input type="number" step="1"  class="form-control" name="qtde_dec_porcento" id="qtde_dec_porcento" value="{{$config->qtde_dec_porcento}}" disabled="" required=""> 
              </div>
            </div>
          </div>
          <input type="submit" class="submit" style="display:none;"> 
        </form>
        <hr>
        @if(can('configuracoes','put'))
        <div>
          <button type="button" class="btn btn-primary btn-sm" id="btn_editar_numerais" onclick="editar_numerais()">Editar</button>
          <div id="btn_salvar_numerais" style="display: none;">
            <button type="button" class="btn  btn-success btn-sm" onclick="salvar_numerais()">Salvar</button>
            <button type="button" class="btn btn-danger btn-sm" onclick="cancelar_numerais()">Cancelar</button>
          </div>
        </div>  
        @endif
      </div>
  </div>
</div>

<div class="col-md-6" >
  <div class="box box-primary">
      <div class="box-header">
          <i class="fa fa-file-image-o"></i>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>      
            <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
          </div>
          <h3 class="box-title">Visual</h3>    
      </div>
    <!-- /.box-header -->
      <div class="box-body" style="background-color: #222d32">


          <style type="text/css">
            
            .skin:hover 
            {
              opacity: 0.3;
            }

          </style>
          <div class="row">
            <div class="col-md-4 text-center skin">
              <label onclick="skin('blue')" >
                <img src="{{asset('public/custom/img/skins/blue.png')}}" width="70%">
                <p style="color:white">Blue</p>
              </label>
            </div>
            <div class="col-md-4 text-center  skin">
              <label onclick="skin('black')">
                <img src="{{asset('public/custom/img/skins/black.png')}}"  width="70%">
                <p style="color:white">Black</p>                
              </label>
            </div>
            <div class="col-md-4 text-center  skin" >
              <label onclick="skin('purple')">
                <img src="{{asset('public/custom/img/skins/purple.png')}}"  width="70%">
                <p style="color:white">Purple</p> 
              </label>
            </div>
          </div>

          <div class="row">
            <div class="col-md-4  text-center  skin">
              <label onclick="skin('green')">
                <img src="{{asset('public/custom/img/skins/green.png')}}" width="70%">
                <p style="color:white">Green</p> 
              </label>
            </div>
            <div class="col-md-4 text-center  skin">
              <label onclick="skin('red')">
                <img src="{{asset('public/custom/img/skins/red.png')}}"  width="70%">
                <p style="color:white">Red</p> 
              </label>
            </div>
            <div class="col-md-4 text-center  skin">
              <label onclick="skin('yellow')">
                <img src="{{asset('public/custom/img/skins/yellow.png')}}"  width="70%">
                <p style="color:white">Yellow</p>
              </label>
            </div>
          </div>

          <div class="row">
            <div class="col-md-4  text-center  skin">
              <label onclick="skin('blue-light')">
                <img src="{{asset('public/custom/img/skins/blue_light.png')}}" width="70%">
                <p style="color:white">Blue Light</p>
              </label>
            </div>
            <div class="col-md-4  text-center  skin">
              <label onclick="skin('black-light')">
                <img src="{{asset('public/custom/img/skins/black_light.png')}}"  width="70%">
                <p style="color:white">Black Light</p>
              </label>
            </div>
            <div class="col-md-4  text-center  skin">
              <label onclick="skin('purple-light')">
                <img src="{{asset('public/custom/img/skins/purple_light.png')}}"  width="70%">
                <p style="color:white">Purple Light</p>
              </label>
            </div>
          </div>

          <div class="row">
            <div class="col-md-4  text-center  skin">
              <label onclick="skin('green-light')">
                <img src="{{asset('public/custom/img/skins/green_light.png')}}" width="70%">
                <p style="color:white">Green Light</p>
              </label>
            </div>
            <div class="col-md-4  text-center  skin">
              <label onclick="skin('red-light')">
                <img src="{{asset('public/custom/img/skins/red_light.png')}}"  width="70%">
                <p style="color:white">Red Light</p>
              </label>
            </div>
            <div class="col-md-4 text-center  skin">
              <label onclick="skin('yellow-light')">
                <img src="{{asset('public/custom/img/skins/yellow_light.png')}}"  width="70%">
                <p style="color:white">Yellow Light</p>
              </label>
            </div>
          </div>

          <hr>

          <div class="col-md-6 text-center  skin">
            <label>
              <input onchange="alterar_navbar('fix_navbar')" id="fix_navbar" type="checkbox" @if($config->fix_navbar=="S") checked @endif>
              <p style="color:white">Fixar no topo o navbar</p>
            </label>
          </div>

          <div class="col-md-6 text-center  skin">
            <label>
              <input onchange="alterar_sidebar('sidebar_collapse')" id="sidebar_collapse" type="checkbox" @if($config->sidebar_collapse=="S") checked @endif>
              <p style="color:white">Menu lateral esquerdo recolhido por padrão</p>
            </label>
          </div>


      </div>
  </div>
</div>



<script type="text/javascript">
  var editando = false;
  function editar_numerais()
  {
    if(editando)
      return msg("Oops","Você precisa salvar ou cancelar primeira edição iniciada","error");
    editando=true;
    $("#frm_numerais :input").prop('disabled', false);
    $('#btn_editar_numerais').hide();
    $('#btn_salvar_numerais').show("slide",350);
  } 

  function cancelar_numerais()
  {
    msg_confirm('Cancelar ?','Se sim serão mantidas as configurações anteriores de numerias',function()
    {
      editando=false;
      reload_numerais();
    });    
  }

  function reload_numerais()
  {
    $('#frm_numerais').load("{{asset('admin/config')}} #frm_numerais");
    $('#btn_salvar_numerais').hide();    
    $('#btn_editar_numerais').show("slide",350);    
  }

  function salvar_numerais()
  {
    $('#frm_numerais .submit').click();
  }

  $('#frm_numerais').submit(function(form) 
  {
      msg_confirm('Confirmação','Salvar alterações nas configurações de numerias ?',function()
      {
        var dados = $('#frm_numerais').FormData();
        xCode.ajax('put',"{{asset('admin/config/edit')}}",dados).then(function(response)
        {
            if(!response.success)
              msg("Ooops",response.msg,"error");   
            reload();
        });  
      });   
      editando=false;
      return false;
  });

  function skin(skin)
  {
    xCode.ajax('put',"{{asset('admin/config/setconfig')}}",{valor:skin,parametro:'skin'}).then(function(response)
    {
        var skin_antiga = $('meta[name=_skin]').attr('content');
        $('meta[name=_skin]').attr('content',skin);
        $('body').toggleClass('skin-'+skin_antiga);
        $('body').addClass('skin-'+skin);
    })
  }

  function alterar_navbar(parametro)
  {
    if($('#'+parametro).is( ":checked" ))
      var valor = 'S';
    else
      var valor = "N";

    xCode.ajax('put',"{{asset('admin/config/setconfig')}}",{valor:valor,parametro:'fix_navbar'}).then(function(response)
    {
        if(valor=='S')
          $('body').addClass('fixed');
        else
          $('body').removeClass('fixed');
    });   
  }

  function alterar_sidebar(parametro)
  {
    if($('#'+parametro).is( ":checked" ))
      var valor = 'S';
    else
      var valor = "N";

    xCode.ajax('put',"{{asset('admin/config/setconfig')}}",{valor:valor,parametro:'sidebar_collapse'}).then(function(response)
    {
        if(valor=='S')
          $('body').addClass('sidebar-collapse');
        else
          $('body').removeClass('sidebar-collapse');
    });   
  }
</script>
@stop