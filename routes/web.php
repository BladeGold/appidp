<?php

use Illuminate\Support\Facades\Route;

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


Auth::routes();


//Route::get('users/show_users', 'UserController@show_users')->name('users.show_users');
//Route::get('users/{user}/edit_admin', 'UserController@edit_admin')->name('users.edit_admin');

//RUTAS USERS
Route::get('users/dashboard', 'UserController@dashboard')->name('users.dashboard
	');
Route::get('users/{iglesia}/asignarIglesia', 'UserController@asignarIglesia')->name('users.asignarIglesia');
Route::resource('users', 'UserController');

//RUTAS ADMIN

Route::get('admin/show_users', 'AdminController@show_users')->name('admin.show_users')->middleware('single_admin');
Route::get('admin/dashboard', 'AdminController@index')->name('admin.dashboard');
Route::resource('admin', 'AdminController');

//RUTAS ROLES
Route::resource('roles', 'RoleController');


//RUTAS IGLESIAS
Route::post('iglesias/asignarPastor/{pastor}', 'IglesiaController@asignarPastor')->name('iglesias.asignarPastor');
Route::get('iglesias/shows/{id}', 'IglesiaController@shows')->name('iglesias.shows');
Route::resource('iglesias', 'IglesiaController');


