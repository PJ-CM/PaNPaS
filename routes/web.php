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
