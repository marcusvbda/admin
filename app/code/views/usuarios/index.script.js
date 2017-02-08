

dataTable('#tabela');


function excluir(id)
{
  msg_confirm('Confirmação',"Deseja mesmo excluir este cliente ?",function()
  {   
    send("DELETE","{{asset('usuarios/excluir')}}",{id}, function(excluiu)
    {
        if(excluiu)
            msg_stop(":)","Cliente Excluido com sucesso !!",function()
            {
                REFRESH();
            },'success');
        else
            return  msg("Oops","Erro ao excluir Cliente !!",'error');
    },"{{Request::getToken()}}");
        
  },false);
  
}

