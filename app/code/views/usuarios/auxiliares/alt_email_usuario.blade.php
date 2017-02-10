@if(Access("PUT","usuarios"))
  <style type="text/css">
    .error
    {
      border-color: red;
    }
  </style>


  <div class="box-body">
    <div class="alert alert-warning alert-dismissible">
      <h4><i class="glyphicon glyphicon-pencil"></i> Alterar email de acesso</h4>

      <div id="div_alterar_email">

        <div class="row" id="step1">
          <div class="col-md-12">
            <h5>Para alterar o email de acesso é necessário saber o email e a senha atual.</h5>
          </div>
          <div class="col-md-12 text-right">
            <button class="btn btn-oval btn-default" id="btn_danger_zone_usuario" onclick="Prosseguir(2)"><i class="glyphicon glyphicon-pencil"></i> Alterar</button>
          </div>
        </div>

        <div class="row" id="step2" style="display: none;">
          <div class="col-md-12">
            <label>Email Atual</label>
            <input type="email" id="email_step2" placeholder="Email atual" class="form-control" maxlength="150">
            <input  id="email" style="display: none;" >
          </div>
          <div class="col-md-12 text-right">
            <button class="btn btn-oval btn-default"  onclick="Prosseguir(3)"> Prosseguir 1/3</button>
            <button class="btn btn-oval btn-danger"  onclick="cancelar(2)">Cancelar</button>          
          </div>
        </div>

        <div class="row" id="step3" style="display: none;">
          <div class="col-md-12">
            <label>Senha</label>
            <input type="password" id="senha_step3" placeholder="Senha" class="form-control">
            <input style="display: none;" id="senha" >
          </div>
          <div class="col-md-12 text-right">
            <button class="btn btn-oval btn-default"  onclick="Prosseguir(4)"> Prosseguir 2/3</button>
            <button class="btn btn-oval btn-danger"  onclick="cancelar(3)">Cancelar</button>          
          </div>
        </div>

        <div class="row" id="step4" style="display: none;">
          <div class="col-md-12">
            <label>Novo Email</label>
            <input type="email" id="email_step4" placeholder="Novo Email" class="form-control" maxlength="150">
            <input  style="display: none;">
          </div>
          <div class="col-md-12 text-right">
            <button class="btn btn-oval btn-default"  onclick="Prosseguir(1)"> Concluir 3/3</button>
            <button class="btn btn-oval btn-danger"  onclick="cancelar(4)">Cancelar</button>

          </div>
        </div>


      </div>
    </div>
  </div>


  <script type="text/javascript">
  function cancelar(stepatual)
  {
    msg_confirm("Cancelar","Deseja cancelar ?",function()
    {
      step('#step'+stepatual,"#step1");
    });
  }
  function Prosseguir(mostrar)
  {
    switch(mostrar) 
    {
        case 2:
            step('#step1','#step2'); 
            break;
        case 3:
            if(!ValidarCampos(["#email_step2"]))
              return msg("Oops","Os campos em vermelho são obrigatórios","error");
            var id = $('#id').val();
            var email = $('#email_step2').val();
            send("POST","{{asset('usuarios/Restvalidaemail')}}" ,{email,id},function(existe)
            {
              if(!existe)
              {
                $('#email_step2').addClass('error');
                return msg("Oops","Email invalido !!","error");
              }
              else
                step('#step2','#step3'); 
            });
          break;
          case 4:
            if(!ValidarCampos(["#senha_step3"]))
              return msg("Oops","Os campos em vermelho são obrigatórios","error");
            var id = $('#id').val();
            var email = $('#email_step2').val();
            var senha = $('#senha_step3').val();          
            send("POST","{{asset('usuarios/Restvalidaemail')}}" ,{email,id,senha},function(existe)
            {
              if(!existe)
              {
                $('#email_step2').addClass('error');
                return msg("Oops","Senha invalida !!","error");
              }
              else
                step('#step3','#step4'); 
            });
            break;
          case 1:
            if(!ValidarCampos(["#email_step4"]))
              return msg("Oops","Os campos em vermelho são obrigatórios","error");
            var id = $('#id').val();
            var email = $('#email_step4').val();         
            send("POST","{{asset('usuarios/Restvalidanovoemail')}}" ,{email,id},function(valida)
            {
              if(!valida)
              {
                $('#email_step4').addClass('error');
                return msg("Oops","Email já cadastrado !!","error");
              }
              else
              {
                msg_confirm("Confirmação","Confirma esta alteração ?",function()
                {
                    send("PUT","{{asset('usuarios/AlteraEmail')}}" ,{email,id},function(alterou)
                    {
                        if(!alterou)
                          return msg("oops!","Erro ao alterar !!","error");

                        msg(":)","Alterado com sucesso !!","success");  

                    },"{{Request::getToken()}}");
                    limpa();
                    step('#step4','#step1');  
                },false);
              }
            });
            break;
        
    }
  }

  function step(esconder,mostrar)
  {
    $(esconder).toggle(150);
    $(mostrar).toggle(150);
  }

  function limpa()
  {
    $('#email_step4').removeClass('error');
    $('#email_step2').removeClass('error');
    $('#senha_step3').removeClass('error');
    $('#email_step4').val('');
    $('#email_step2').val('');
    $('#senha_step3').val('');

  }

  </script>
@endif