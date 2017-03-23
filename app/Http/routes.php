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
		Route::controller('/dashboard', 'Painel\dashboardController');
		Route::controller('/users', 'Painel\usersController');
		Route::controller('/config', 'Painel\configController');

		Route::group(['prefix' => 'persons'], function () 
		{
			Route::post('contacts/store', 'Painel\PersonsController@storecontatos');
			Route::get('{tipo}', 'Painel\PersonsController@index');
			Route::get('{tipo}/create', 'Painel\PersonsController@create');
			Route::post('{tipo}/clone', 'Painel\PersonsController@create');
			Route::post('{tipo}', 'Painel\PersonsController@postindex');
			Route::get('{tipo}/show/{id}', 'Painel\PersonsController@show');
			Route::put('{tipo}/edit', 'Painel\PersonsController@edit');
			Route::put('{tipo}/bloquear', 'Painel\PersonsController@bloquear');
			Route::put('{tipo}/ativar', 'Painel\PersonsController@ativar');
			Route::delete('{tipo}/destroy', 'Painel\PersonsController@excluir');
			Route::post('contacts/destroy', 'Painel\PersonsController@contatosdestroy');
			Route::post('{tipo}/store', 'Painel\PersonsController@store');
			Route::post('contacts/{id}', 'Painel\PersonsController@getContato');
			Route::post('contacts/edit', 'Painel\PersonsController@contatosedit');
		});

	});

});

