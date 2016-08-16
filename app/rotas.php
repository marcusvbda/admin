<?php

function rotas_liberadas()
{
	 $rotas_liberadas = array
		(
			"usuariosController@getLogin",
			"usuariosController@getRenovasenha",
			"usuariosController@postLogar",
			"usuariosController@getUsuarioexiste",
			"usuariosController@getValidalogin",
			"usuariosController@postDefinirsenha",
			"usuariosController@postRenovarSenha"
		);
	return array_upper_case($rotas_liberadas);
}

function rotas_protegidas()
{
	$rotas_protegidas = array
		(
			"usuariosController@getIndex"
		);
	return array_upper_case($rotas_protegidas);
}