<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['auth', 'admin']], function () {
	Route::group(['prefix'=>'sessoes', 'where'=>['id'=>'[0-9]+']], function() {
	    Route::get("create",       ['as' => 'sessoes.create',  'uses' => "SessoesController@create"]);
	    Route::get("{id}/destroy", ['as' => 'sessoes.destroy', 'uses' => "SessoesController@destroy"]);
	    Route::get("{id}/edit",    ['as' => 'sessoes.edit',    'uses' => "SessoesController@edit"]);
	    Route::put("{id}/update",  ['as' => 'sessoes.update',  'uses' => "SessoesController@update"]);
	    Route::post("store",       ['as' => 'sessoes.store',   'uses' => "SessoesController@store"]);
	});
	
    Route::group(['prefix'=>'tipos', 'where'=>['id'=>'[0-9]+']], function() {
	    Route::get("create",       ['as' => 'tipos.create',  'uses' => "TiposController@create"]);
	    Route::get("{id}/destroy", ['as' => 'tipos.destroy', 'uses' => "TiposController@destroy"]);
	    Route::get("{id}/edit",    ['as' => 'tipos.edit',    'uses' => "TiposController@edit"]);
	    Route::put("{id}/update",  ['as' => 'tipos.update',  'uses' => "TiposController@update"]);
	    Route::post("store",       ['as' => 'tipos.store',   'uses' => "TiposController@store"]);
	});

	Route::group(['prefix'=>'atracoes', 'where'=>['id'=>'[0-9]+']], function() {
	    Route::get("create",       ['as' => 'atracoes.create',  'uses' => "AtracoesController@create"]);
	    Route::get("{id}/destroy", ['as' => 'atracoes.destroy', 'uses' => "AtracoesController@destroy"]);
	    Route::get("{id}/edit",    ['as' => 'atracoes.edit',    'uses' => "AtracoesController@edit"]);
	    Route::put("{id}/update",  ['as' => 'atracoes.update',  'uses' => "AtracoesController@update"]);
	    Route::post("store",       ['as' => 'atracoes.store',   'uses' => "AtracoesController@store"]);
	});
});

Route::group(['middleware' => 'auth'], function () {

    Route::group(['prefix'=>'reservas', 'where'=>['id'=>'[0-9]+']], function() {
	    Route::get("",             ['as' => 'reservas',         'uses' => "ReservasController@index"]);
	    Route::get("{id}/create",  ['as' => 'reservas.create',  'uses' => "ReservasController@create"]);
	    Route::get("{id}/destroy", ['as' => 'reservas.destroy', 'uses' => "ReservasController@destroy"]);
	    Route::get("{id}/edit",    ['as' => 'reservas.edit',    'uses' => "ReservasController@edit"]);
	    Route::put("{id}/update",  ['as' => 'reservas.update',  'uses' => "ReservasController@update"]);
		Route::post("store",       ['as' => 'reservas.store',   'uses' => "ReservasController@store"]);
	});

	Route::group(['prefix'=>'sessoes', 'where'=>['id'=>'[0-9]+']], function() {
	    Route::get("",             ['as' => 'sessoes',         'uses' => "SessoesController@index"]);
	});
	
    Route::group(['prefix'=>'tipos', 'where'=>['id'=>'[0-9]+']], function() {
	    Route::get("",             ['as' => 'tipos',         'uses' => "TiposController@index"]);
	});

	Route::group(['prefix'=>'atracoes', 'where'=>['id'=>'[0-9]+']], function() {
	    Route::get("",             ['as' => 'atracoes',         'uses' => "AtracoesController@index"]);
	});

	Route::group(['prefix'=>'profile', 'where'=>['id'=>'[0-9]+']], function() {
		Route::get("",             ['as' => 'profile',         'uses' => "AccountController@index"]);
		Route::get("/edit",        ['as' => 'profile.edit',    'uses' => "AccountController@edit"]);
		Route::put("/update",      ['as' => 'profile.update',  'uses' => "AccountController@update"]);
	});

	Route::group(['prefix'=>'change_password', 'where'=>['id'=>'[0-9]+']], function() {
	    Route::get("",             ['as' => 'change_password',  'uses' => "SessoesController@index"]);
	});
	
    //Please do not remove this if you want adminlte:route and adminlte:link commands to works correctly.
    #adminlte_routes
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
