@if(Access("PUT","usuarios"))

  <style type="text/css">
    .error
    {
      border-color: red;
    }
  </style>


  <div class="box-body">
    <div class="alert alert-warning alert-dismissible">
      <h4><i class="glyphicon glyphicon-pencil"></i> Alterar Senha</h4>

      <div id="div_alterar_email">

        <div class="row" id="step1_">
          <div class="col-md-12">
            <h5>Para alterar a senha de acesso é necessário saber o email e a senha atual.</h5>
          </div>
          <div class="col-md-12 text-right">
            <button class="btn btn-oval btn-default" id="btn_danger_zone_usuario" onclick="Prosseguir_(2)"><i class="glyphicon glyphicon-pencil"></i> Alterar</button>
          </div>
        </div>

        <div class="row" id="step2_" style="display: none;">
          <div class="col-md-12">
            <label>Email Atual</label>
            <input type="email" id="email_step2_" placeholder="Email atual" class="form-control" maxlength="150">
            <input  id="email" style="display: none;" >
          </div>
          <div class="col-md-12 text-right">
            <button class="btn btn-oval btn-default"  onclick="Prosseguir_(3)"> Prosseguir 1/3</button>
            <button class="btn btn-oval btn-danger"  onclick="cancelar_(2)">Cancelar</button>          
          </div>
        </div>

        <div class="row" id="step3_" style="display: none;">
          <div class="col-md-12">
            <label>Senha Atual</label>
            <input type="password" id="senha_step3_" placeholder="Senha Atual" class="form-control">
            <input style="display: none;" id="senha" >
          </div>
          <div class="col-md-12 text-right">
            <button class="btn btn-oval btn-default"  onclick="Prosseguir_(4)"> Prosseguir 2/3</button>
            <button class="btn btn-oval btn-danger"  onclick="cancelar_(3)">Cancelar</button>          
          </div>
        </div>

        <div class="row" id="step4_" style="display: none;">
          <div class="col-md-12">
            <label>Nova Senha</label>
            <input type="password" id="senha_step4_" placeholder="Nova Senha" class="form-control">
            <input style="display: none;" id="senha" >
            <input  style="display: none;">
          </div>
          <div class="col-md-12 text-right">
            <button class="btn btn-oval btn-default"  onclick="Prosseguir_(1)"> Concluir 3/3</button>
            <button class="btn btn-oval btn-danger"  onclick="cancelar_(4)">Cancelar</button>

          </div>
        </div>


      </div>
    </div>
  </div>


  <script type="text/javascript">
  function cancelar_(stepatual)
  {
    msg_confirm("Cancelar","Deseja cancelar ?",function()
    {
      step('#step'+stepatual+'_',"#step1_");
    });
  }
  function Prosseguir_(mostrar)
  {
    switch(mostrar) 
    {
        case 2:
            step_('#step1_','#step2_'); 
            break;
        case 3:
            if(!ValidarCampos(["#email_step2_"]))
              return msg("Oops","Os campos em vermelho são obrigatórios","error");
            var id = $('#id').val();
            var email = $('#email_step2_').val();
            send("POST","{{asset('usuarios/Restvalidaemail')}}" ,{email,id},function(existe)
            {
              if(!existe)
              {
                $('#email_step2_').addClass('error');
                return msg("Oops","Email invalido !!","error");
              }
              else
                step_('#step2_','#step3_'); 
            });
          break;
          case 4:
            if(!ValidarCampos(["#senha_step3_"]))
              return msg("Oops","Os campos em vermelho são obrigatórios","error");
            var id = $('#id').val();
            var email = $('#email_step2_').val();
            var senha = $('#senha_step3_').val();          
            send("POST","{{asset('usuarios/Restvalidaemail')}}" ,{email,id,senha},function(existe)
            {
              if(!existe)
              {
                $('#email_step2_').addClass('error');
                return msg("Oops","Senha invalida !!","error");
              }
              else
                step_('#step3_','#step4_'); 
            });
            break;
          case 1:
            if(!ValidarCampos(["#senha_step4_"]))
              return msg("Oops","Os campos em vermelho são obrigatórios","error");
            var id = $('#id').val();
            var senha = $('#senha_step4_').val();       

            msg_confirm("Confirmação","Confirma esta alteração ?",function()
            {
                send("PUT","{{asset('usuarios/AlterarSenha')}}" ,{senha,id},function(alterou)
                {
                    if(!alterou)
                      return msg("oops!","Erro ao alterar !!","error");

                    msg(":)","Alterado com sucesso !!","success");  

                },"{{Request::getToken()}}");
                limpa();
                step_('#step4_','#step1_');  
            },false);
              break;
        
    }
  }

  function step_(esconder,mostrar)
  {
    $(esconder).toggle(150);
    $(mostrar).toggle(150);
  }

  function limpa_()
  {
    $('#email_step4_').removeClass('error');
    $('#email_step2_').removeClass('error');
    $('#senha_step3_').removeClass('error');
    $('#email_step4_').val('');
    $('#email_step2_').val('');
    $('#senha_step3_').val('');

  }

  </script>
@endif