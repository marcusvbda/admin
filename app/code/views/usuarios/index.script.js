

dataTable('#tabela');


function excluir(id)
{
  msg_confirm('Confirmação',"Deseja mesmo excluir ?",function()
  {   
    send("DELETE","{{asset('usuarios/excluir')}}",{id}, function(excluiu)
    {
        if(excluiu)
            msg_stop(":)","Excluido com sucesso !!",function()
            {
                REFRESH();
            },'success');
        else
            return  msg("Oops","Erro ao excluir !!",'error');
    },"{{Request::getToken()}}");
        
  },false);
  
}

