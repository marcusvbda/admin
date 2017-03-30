<?php
Route::get('/phpinfo', function()
{	
	return phpinfo();
});

Route::get('/', function()
{	
	return view('landing.index');
});



Route::group(['prefix' => 'admin'], function () 
{
	Route::controller('/auth', 'Painel\Auth\AuthController');

	Route::group(['middleware' => 'auth'], function()
	{	
	    Route::get('/', 'Painel\dashboardController@index');
		Route::controller('/import', 'Painel\importacaoController');
		Route::controller('/dashboard', 'Painel\dashboardController');
		Route::controller('/users', 'Painel\usersController');
		Route::controller('/config', 'Painel\configController');
		Route::controller('/products', 'Painel\productsController');
		Route::controller('/tanks', 'Painel\tanksController');
		Route::controller('/bombs', 'Painel\bombsController');
		Route::controller('/abastecimentos', 'Painel\abastecimentosController');
		Route::controller('/caixas', 'Painel\caixasController');
	});

});

