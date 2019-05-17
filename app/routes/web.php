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

Route::get('autocomplete', 'HomeController@autocomplete');
Route::get('search', 'HomeController@search');
Route::get('like', 'HomeController@like');
Route::get('pokemon/index', 'PokemonController@bodyindex');
Route::get('pokemon/delete', 'PokemonController@delete');
Route::get('favorite/index', 'FavoriteController@bodyindex');
Route::get('favorite/delete', 'FavoriteController@delete');
Route::get('/', 'PokemonController@index');

Auth::routes();

Route::get('profile', 'UserController@profile');
Route::get('profile/index', 'UserController@profilebody');
Route::post('profile/update', 'UserController@update_avatar');
Route::post('changePassword','UserController@changePassword');

Route::resource('pokemon', 'PokemonController');
Route::resource('favorite', 'FavoriteController');

