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

//RUTA PRESENTE en la creación del proyecto
////Route::middleware('auth:api')->get('/user', function (Request $request) {
////    return $request->user();
////});


//Ruta(s) registrada(s) para API(s)
Route::apiResources([
    'users' => 'API\UserController',
]);
// -------------------------------------------------------------------------------
//Con el Soft Delete activado, esta ruta es para forzar el borrado definitivo
Route::get('/users/force-delete/{id}', 'API\UserController@forceDelete')
    ->name('user.force-delete');

Route::get('/users/restore-delete/{id}', 'API\UserController@restoreDelete')
    ->name('user.restore-delete');
