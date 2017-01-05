dataTable('#tabela');
function filtrar()
{
	var ncm = $('#NCM').val();
	var anp = $('#ANP').val();
	var cest = $('#CEST').val();
	var CST_entrada = $('#CST_entrada').val();
	var CST_saida = $('#CST_saida').val();
    SEND("POST","{{asset('relatorios/Tributacoes_codigos')}}",{ncm:ncm,anp:anp,cest:cest,CST_entrada:CST_entrada,CST_saida:CST_saida},"{{Request::getToken()}}");
}