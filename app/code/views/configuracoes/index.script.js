function clique()
{	
	var cliques = parseInt($('#cliques').val());
	if(cliques==0)
	{
		$('#cliques').val(cliques+1);
		$('#btn_salvar').toggle(150);
	}
}

$('#btn_salvar').on('click', function() 
{
	msg_confirm('<strong>Confirmação</strong>','Deseja salvar as alterações?',"salvar()"); 

}); 

function salvar()
{
	var admin_rede = "{{Auth('admin_rede')}}";
	var action = "{{asset('configuracoes/salvar')}}";
	var form = '<form action="'+action+'" method="post">';

	$.getJSON("{{asset('configuracoes/Buscaparametros')}}", function(data) 
	{
		$.each(data, function(dados,d)
        {      
        	tipo = $('#'+d.id).attr('type');
         	if(tipo=="checkbox")
         	{
         		if( $('#'+d.id).prop("checked") == true)         			
         			form += '<input type="text" value="S" name="'+d.id+'" />';
         		else
         			form += '<input type="text" value="N" name="'+d.id+'" />';
         	}
         	else if((tipo=="number")||(tipo=="text"))
         	{
         			valor = $('#'+d.id).val();
         			form += '<input type="text" value="'+valor+'" name="'+d.id+'" />';
         	}
        });
    form += "</form>";
  	$('body').append(form);
  	$(form).submit(); 
	});	
}
