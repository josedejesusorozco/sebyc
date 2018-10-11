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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', 'FrontController@index');
/*Route::get('formulario', 'StorageController@index');*/
Route::post('modelo_upload', 'StorageController@modelo_upload');
/*Route::post('modelo_upload', function () {
	request()->file('image')->store('imagenes');
	return back();
});*/

Route::post('cuenta_registros', 'CalculoController@cuenta_registros');
Route::get('cuenta_registros', 'CalculoController@cuenta_registros');

Route::post('prepara_arboles', 'CalculoController@prepara_arboles');
Route::get('prepara_arboles', 'CalculoController@prepara_arboles');

Route::get('arbol_biomasa', 'CalculoController@arbol_biomasa');
Route::post('arbol_biomasa', 'CalculoController@arbol_biomasa');

Route::get('arbol_densidad', 'CalculoController@arbol_densidad');
Route::post('arbol_densidad', 'CalculoController@arbol_densidad');

Route::get('arbol_carbono', 'CalculoController@arbol_carbono');
Route::post('arbol_carbono', 'CalculoController@arbol_carbono');

Route::get('calcula_biomasa', 'CalculoController@calcula_biomasa');
Route::post('calcula_biomasa', 'CalculoController@calcula_biomasa');

Route::get('muestra_resultados', 'CalculoController@muestra_resultados');
Route::post('muestra_resultados', 'CalculoController@muestra_resultados');

Route::post('importa_arboles', 'StorageController@importa_arboles');
Route::post('importa_modelos', 'StorageController@importa_modelos');
Route::post('importa_densidades', 'StorageController@importa_densidades');
Route::post('importa_fracciones', 'StorageController@importa_fracciones');