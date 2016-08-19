<?php

function rotas_liberadas()
{
	 $rotas_liberadas = array
		(
			_route("usuariosController@getLogin"),
			_route("usuariosController@getRenovasenha"),
			_route("usuariosController@postLogar"),
			_route("usuariosController@getUsuarioexiste"),
			_route("usuariosController@getValidalogin"),
			_route("usuariosController@postDefinirsenha"),
			_route("usuariosController@postRenovarSenha")
		);
	return $rotas_liberadas;
}

function rotas_protegidas()
{
	$rotas_protegidas = array
		(
			_route("usuariosController@getIndex")
		);
	return $rotas_protegidas;
}