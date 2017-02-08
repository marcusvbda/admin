<?php

function rotas_liberadas()
{
	 $rotas_liberadas = array
		(
			_route("usuariosController@getLogin"),
			_route("usuariosController@getRenovasenha"),
			_route("usuariosController@postLogar"),
			_route("usuariosController@getLogar"),
			_route("usuariosController@getUsuarioexiste"),
			_route("usuariosController@getValidalogin"),
			_route("usuariosController@postDefinirsenha"),
			_route("usuariosController@postRenovarSenha")
		);
	return $rotas_liberadas;
}
