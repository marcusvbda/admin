dataTable('#tabela');
function excluir(id)
{
    msg_confirm('Confirmação',"Deseja mesmo excluir esta Grupo de Acesso ?",function()
    {
        send("DELETE","{{asset('usuarios/ExcluirGrupoAcesso')}}",{id}, function(excluiu)
        {
            if(excluiu)
                msg_stop(":)","Grupo Acesso Excluida com sucesso !!",function()
                    {
                        location.href="{{asset('usuarios/grupos_acesso')}}";
                    },'success');
            else
                return  msg("Oops","Erro ao excluir Grupo de acesso !!",'error');
        },"{{Request::getToken()}}");
        
    },false);
}