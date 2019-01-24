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

Route::get('/', 'RecetaController@getRecetasRanking')->name('index');

//Con Verificación por Email
Auth::routes(['verify' => true]);

//Landing Page
Route::post('/enviarDatosContacto', 'ContactoController@guardarDatos'); //guarda los datos del formulario de la landing page en la DDBB

//Panel donde se muestra la Receta
Route::get ('/receta/{id}/{toast?}', 'RecetaController@mostrar')->name('receta');
Route::post ('/insertarComentario', 'RecetaController@insertarComentario');

//Panel de Usuarios
Route::get('/users/{username?}', 'UserPanelController@index')
    ->name('user_panel_index');

Route::get('/logout', 'UserPanelController@logout')
    ->name('user_panel_logout');

Route::get('/recetas/{toast?}', 'UserPanelController@listaRecetas')
    ->name('user_recetas');

Route::get('/seguidos/{columna?}/{orden?}', 'UserPanelController@seguidos')
    ->name('user_seguidos');

Route::get('/seguidores', 'UserPanelController@seguidores')
    ->name('user_seguidores');

Route::get('/usuarios/{columna?}/{orden?}', 'UserPanelController@usuarios')
    ->name('user_usuarios');
Route::post('/buscarUsuario', 'UserPanelController@buscarUsuario')
    ->name('user_buscarUsuario');

Route::post('/buscarReceta', 'UserPanelController@buscarReceta')
    ->name('user_buscarReceta');



Route::post('/insertarReceta', 'RecetaController@insertarReceta')
    ->name('insertar_receta');




//Panel Público de Usuario
Route::get('/{username}', 'UserPanelController@perfil')
    ->name('user_perfil');

//rutas de usuario PRIVADAS
Route::post('/user/guardarFotoPerfil', 'UserPerfilController@guardarFotoPerfil');
Route::post('/user/actualizarDatos', 'UserPerfilController@actualizarDatos');

//FOLLOW SYSTEM routes
Route::get('/unfollow/{id}', 'FollowController@unfollow')
    ->name('follow_unfollow');
Route::get('/follow/{id}', 'FollowController@follow')
    ->name('follow_follow');



//Panel Admin
Route::get('/admin/dashboard', 'AdminPanelController@index')
    ->name('admin_panel_index');
Route::get('/admin/profile', 'AdminPanelController@profile')
    ->name('admin_panel_profile');
//Route::get('/admin/users', 'AdminPanelController@index')
//    ->name('admin_panel_index');

//Para aceptar URLs de todo tipo dentro de  este controlador
//  >> establecido para aceptar peticiones GET a las rutas
//  relacionadas con los componentes a cargar en él
Route::get('/admin/{path}', 'AdminPanelController@index')
    ->where( 'path', '([A-z\d-\/_.]+)?' );

//==================================================
Route::get('/home', 'HomeController@index')
    ->name('home');




//AJAX
Route::post ('/ajax/usuarios', 'AjaxController@updateUsers');


// [API]recoger datos

Route::get ('/api/usuarios', 'ApiController@getUsuarios'); 	//json de todos los usuarios registrados
Route::get ('/api/perfiles', 'ApiController@getPerfiles');	//json de todos los perfiles disponibles
Route::get ('/api/recetas', 'ApiController@getRecetas');	//json de todas las recetas disponibles
Route::get ('/api/ingredientes', 'ApiController@getIngredientes');	//json de todos los ingredinetes disponibles
Route::get ('/api/panaderias', 'ApiController@getPanaderias');	//json de todas las panaderias disponibles










//PARA HACER FILTRO


/*

Route::post('/admin/editarUsuario', 'UserController@editarUsuario');	//modifica los datos de un usuario en la DDBB
Route::post('/admin/borrarUsuario', 'UserController@borrarUsuario');	//borra un usuario de la DDBB

*/






//Rutas de la parte PÚBLICA
Route::get ('/user/perfilPublico/{id}', 'UserPerfilController@mostrarPerfilPublico'); //mostrar perfil del usuario con información pública
Route::get ('/user/index', 'UserPerfilController@index'); //mostrar perfil del usuario con información pública




//prueba carga de foto de perfil (Borrar al terminar)
//se carga desde la modificación del perfil privado
Route::get('/prueba', 'UserPerfilController@prueba');




