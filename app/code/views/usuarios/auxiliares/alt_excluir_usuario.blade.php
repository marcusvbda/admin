@if(Access("DELETE","usuarios"))
  <style type="text/css">
    .error
    {
      border-color: red;
    }
  </style>


  <div class="box-body">
    <div class="alert alert-danger alert-dismissible">
      <h4><i class="glyphicon glyphicon-trash"></i> Excluir usuário</h4>

      <div id="div_alterar_email">

        <div class="row" id="step1__">
          <div class="col-md-12">
            <h5>Para excluir o usuário é necessário saber o email e a senha atual.</h5>
          </div>
          <div class="col-md-12 text-right">
            <button class="btn btn-oval btn-default" id="btn_danger_zone_usuario" onclick="Prosseguir__(2)"><i class="glyphicon glyphicon-trash"></i> Alterar</button>
          </div>
        </div>

        <div class="row" id="step2__" style="display: none;">
          <div class="col-md-12">
            <label>Email Atual</label>
            <input type="email" id="email_step2__" placeholder="Email atual" class="form-control" maxlength="150">
            <input  id="email" style="display: none;" >
          </div>
          <div class="col-md-12 text-right">
            <button class="btn btn-oval btn-default"  onclick="Prosseguir__(3)"> Prosseguir 1/2</button>
            <button class="btn btn-oval btn-danger"  onclick="cancelar__(2)">Cancelar</button>          
          </div>
        </div>

        <div class="row" id="step3__" style="display: none;">
          <div class="col-md-12">
            <label>Senha Atual</label>
            <input type="password" id="senha_step3__" placeholder="Senha Atual" class="form-control">
            <input style="display: none;" id="senha" >
          </div>
          <div class="col-md-12 text-right">
            <button class="btn btn-oval btn-default"  onclick="excluir()"> Concluir 2/2</button>
            <button class="btn btn-oval btn-danger"  onclick="cancelar__(3)">Cancelar</button>          
          </div>
        </div>


      </div>
    </div>
  </div>


  <script type="text/javascript">
  function cancelar__(stepatual)
  {
    msg_confirm("Cancelar","Deseja cancelar ?",function()
    {
      step('#step'+stepatual+'__',"#step1__");
    });
  }
  function Prosseguir__(mostrar)
  {
    switch(mostrar) 
    {
        case 2:
            step_('#step1__','#step2__'); 
            break;
        case 3:
            if(!ValidarCampos(["#email_step2__"]))
              return msg("Oops","Os campos em vermelho são obrigatórios","error");
            var id = $('#id').val();
            var email = $('#email_step2__').val();
            send("POST","{{asset('usuarios/Restvalidaemail')}}" ,{email,id},function(existe)
            {
              if(!existe)
              {
                $('#email_step2_').addClass('error');
                return msg("Oops","Email invalido !!","error");
              }
              else
                step_('#step2__','#step3__'); 
            });
          break;
          case 1:
            if(!ValidarCampos(["#senha_step4__"]))
              return msg("Oops","Os campos em vermelho são obrigatórios","error");
            var id = $('#id').val();
            var senha = $('#senha_step4__').val();       

            msg_confirm("Confirmação","Confirma esta alteração ?",function()
            {
                send("PUT","{{asset('usuarios/AlterarSenha')}}" ,{senha,id},function(alterou)
                {
                    if(!alterou)
                      return msg("oops!","Erro ao alterar !!","error");

                    msg(":)","Alterado com sucesso !!","success");  

                },"{{Request::getToken()}}");
                limpa();
                step_('#step4__','#step1__');  
            },false);
              break;      
    }
  }

  function excluir()
  {
      var id = $('#id').val();
      msg_confirm("Confirmação","Deseja mesmo excluir ?",function()
      {
          SEND("DELETE","{{asset('usuarios/Excluir')}}",{id:id},"{{Request::getToken()}}"); 
      },false);
  }

  function step__(esconder,mostrar)
  {
    $(esconder).toggle(150);
    $(mostrar).toggle(150);
  }

  function limpa__()
  {
    $('#email_step4__').removeClass('error');
    $('#email_step2__').removeClass('error');
    $('#senha_step3__').removeClass('error');
    $('#email_step4__').val('');
    $('#email_step2__').val('');
    $('#senha_step3__').val('');
  }

  </script>
@endif