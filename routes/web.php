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
    return view('index');
})
    ->name('index');

Auth::routes();

//Panel de Usuarios
Route::get('/users/{username}', 'UserPanelController@index')
    ->name('user_panel_index');

//Panel Admin
Route::get('/admin/dashboard', 'AdminPanelController@index')
->name('admin_panel_index');

//==================================================
Route::get('/home', 'HomeController@index')
    ->name('home');



Route::post('/enviarDatosContacto', 'ContactoController@guardarDatos'); //guarda los datos del formulario de la landing page en la DDBB

Route::post('/admin/editarUsuario', 'UserController@editarUsuario');	//modifica los datos de un usuario en la DDBB
Route::post('/admin/borrarUsuario', 'UserController@borrarUsuario');	//borra un usuario de la DDBB

Route::get ('/receta', 'RecetaController@mostrar');






//Rutas de la parte PÚBLICA
Route::get ('/user/perfilPublico/{id}', 'UserPerfilController@mostrarPerfilPublico'); //mostrar perfil del usuario con información pública
Route::get ('/user/index', 'UserPerfilController@index'); //mostrar perfil del usuario con información pública


//rutas de usuario PRIVADAS
Route::get('/user/perfilprivado', 'UserPerfilController@mostrarPerfilPrivado');
Route::post('/user/guardarFotoPerfil', 'UserPerfilController@guardarFotoPerfil');

//prueba carga de foto de perfil (Borrar al terminar)
//se carga desde la modificación del perfil privado
Route::get('/prueba', 'UserPerfilController@prueba');



// [API]recoger datos 

Route::get ('/api/usuarios', 'ApiController@getUsuarios'); 	//json de todos los usuarios registrados
Route::get ('/api/perfiles', 'ApiController@getPerfiles');	//json de todos los perfiles disponibles
