dataTable('#tabela');


function filtrar()
{
	var bico = $('#bicos').val();
	var bomba = $('#bomba').val();
	var combustivel = $('#combustivel').val();
	var de = $('#de').val();
	var ate = $('#ate').val();
    SEND("POST","{{asset('multiempresa/abastecimentos')}}",{bico:bico,bomba:bomba,combustivel:combustivel,de:de,ate:ate},"{{Request::getToken()}}");
}

