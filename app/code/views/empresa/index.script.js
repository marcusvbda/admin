
function seleciona(serie)
{
	var selec = $('#check_'+serie).val();
	if(selec=="S")
	{
		$('#check_'+serie).val('N')
		$('#tr_'+serie).css("background-color", "#fad7d7");
		$('#spam_'+serie).removeClass("glyphicon glyphicon-check");
		$('#spam_'+serie).addClass("glyphicon glyphicon-unchecked");
	}
	else
	{
		$('#check_'+serie).val('S')
		$('#tr_'+serie).css("background-color", "#d8ffd8");
		$('#spam_'+serie).removeClass("glyphicon glyphicon-unchecked");
		$('#spam_'+serie).addClass("glyphicon glyphicon-check");
	}
}

$('#btn_salvar').click(function()
{
	var  dados  = $('#form_empresas').getData();
	var contador = 0;
	var selecionados = [];
	$.each(dados, function (dados, d) 
	{
	  	if(d=='S')
	  	{
	  		selecionados.push(dados.replace("check_", ""));
	  		contador++;
	  	}

	});

	if(contador==0)
	{
		msg('Oops','Ao menos 1 empresa deve ser selecionada','error');
		return false;
	}


	msg_confirm('Confirmação',"Deseja mesmo alterar as empresas selecionadas ?",function()
	{   
	  	send("PUT","{{asset('empresa/selecionar')}}",{selecionados}, function(selecionou)
	  	{
	      	if(selecionou)
	          	msg(":)","Selecionado com sucesso !!",'success');
	      	else
	          	return  msg("Oops","Erro ao selecionar !!",'error');
	  	},"{{Request::getToken()}}");
	      
	},false);
});