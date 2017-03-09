<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('saludo',function()
{
    return "hola mundo";
});
Route::get('portada', 'FrontController@index'); // Devuelve la portada del sistema (actualmente vacio)
//Route::get('prueba', 'PruebaController@index');
Route::get('admin', 'FrontController@admin'); // Devuelve el administrador de sistema para subir obras
Route::get('image','imagenController@index'); //primera version del formulario para subir imagen (no usado)
Route::resource('usuario','UsuarioController');//Devuelve el administrador de sistema para crear usuario(no terminado)
Route::post('uploadimage','UsuarioController@store');//Sube imagenes de el usuario (no terminado)

Route::get('user/{id}', 'PruebaController@index');//ruta q captura el uid y devuelve la info del tag


Route::post('uploadimage','imagenController@store');//ruta que manda a traer a el controlador que sube la imagen






