<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//RUTA PRESENTE en la creación del proyecto en la que se requiere el AUTH y el API
////Route::middleware('auth:api')->get('/user', function (Request $request) {
////    return $request->user();
////});


//Ruta(s) registrada(s) para API(s)
Route::apiResources([
    'users' => 'API\UserController',
    'contacts' => 'API\ContactController',
]);
// -------------------------------------------------------------------------------
//Listar usuarios conectados
Route::get('/users/online/list', 'API\UserController@onlineList')
    ->name('user.online.list');
//Buscador para filtrar resultados en el listado
//  >> término que buscar
Route::post('/users/search', 'API\UserController@search')
    ->name('user.search');
//Con el Soft Delete activado, esta ruta es:
//  >> para forzar el borrado definitivo
Route::get('/users/force-delete/{id}', 'API\UserController@forceDelete')
    ->name('user.force-delete');
//  >> para restaurar usuario en papelera
Route::get('/users/restore-delete/{id}', 'API\UserController@restoreDelete')
    ->name('user.restore-delete');

// -------------------------------------------------------------------------------
//Carga de datos resumen en perfil completo de usuario
Route::get('/users/prof-data-resum/{id}', 'API\UserController@profileDataResume')
    ->name('user.prof-data-resum');
//Carga de actividad en perfil completo de usuario
Route::get('/users/prof-activity/{id}', 'API\UserController@profileActivity')
    ->name('user.prof-activity');

// -------------------------------------------------------------------------------
//Mensaje(s) NO leido(s) Total
Route::get('/contacts/no-readed/tot', 'API\ContactController@getTotLeidoNo')
    ->name('contacts_no-readed_tot');
//Mensaje(s) NO leido(s) Top3
Route::get('/contacts/no-readed/top3', 'API\ContactController@getTop3LeidoNo')
    ->name('contacts_no-readed_top3');
//Marcar como leido Si/NO
Route::get('/contacts/editar/{id}/{campo}/{valor}', 'API\ContactController@update_campo')
    ->name('contact_editar_campo');
//Buscador para filtrar resultados en el listado
//  >> término que buscar
Route::post('/contacts/search', 'API\ContactController@search')
    ->name('contact.search');
//Con el Soft Delete activado, esta ruta es:
//  >> para forzar el borrado definitivo de todos/registro
//      >>PRIMERO, la ruta de ALL antes de la del parámetro para que no se confundan entre ellas
Route::get('/contacts/force-delete/all', 'API\ContactController@forceDeleteAll')
    ->name('contact.force-delete-all');
Route::get('/contacts/force-delete/{id}', 'API\ContactController@forceDelete')
    ->name('contact.force-delete');
//  >> para restaurar todos/registro en papelera
Route::get('/contacts/restore-delete/all', 'API\ContactController@restoreDeleteAll')
    ->name('contact.restore-delete-all');
Route::get('/contacts/restore-delete/{id}', 'API\ContactController@restoreDelete')
    ->name('contact.restore-delete');
//Enviar Email de respuesta de mensaje de contacto
Route::post('/contacts/send-response', 'API\ContactController@sendContactResponse')
    ->name('contact_msg.send_response');
//Listar mensaje(s) enviado(s)
//  >>tanto a esta como a la siguiente, se le añade el '/list'
//  para que la ruta '/api/contacts/sended' no produzca un 404
//  al confundirse con la ruta GET de /api/contacts/{contact}
//  para @show que se encuentra definida dentro del apiResources
//  en la parte superior de este archivo
Route::get('/contacts/sended/list', 'API\ContactController@sended')
    ->name('contact_sended');
//Listar mensaje(s) en papelera
Route::get('/contacts/trashed/list', 'API\ContactController@trashed')
    ->name('contact_trashed');
