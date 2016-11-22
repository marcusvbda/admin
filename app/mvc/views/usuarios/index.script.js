function excluir(id,perguntar=true)
{
  if(perguntar)
    msg_confirm('<strong>Confirmação</strong>','Deseja excluir este usuário','excluir('+id+',false)');
  else
  {
    SEND("DELETE","{{asset('usuarios/excluir')}}",{id:id} );
  }
}

function imprimir()
{
  var filtro = $('#filtro').val();
  var action = "{{asset('usuarios/relatorio_simples')}}";
  var form = '<form action="'+action+'" method="post">' +
                '<input type="hidden" value="'+filtro+'" name="filtro" />' +
              '</form>';
  $('body').append(form);
  $(form).submit();  
}
