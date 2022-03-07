<?php

use App\Http\Controllers\autores_controller;
use App\Http\Controllers\categorias_controller;
use App\Http\Controllers\editorial_controller;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\librosController;
use App\Http\Controllers\venta_controller;
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

Route::get('/', function () {return view('welcome');})->name('m.inicio');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Auth::routes();

Route::get('/privacidad', function(){return view('pages.privacidad');})->name('m.aviso');
Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::get('upgrade', function () {return view('pages.upgrade');})->name('upgrade'); 
	 Route::get('map', function () {return view('pages.maps');})->name('map');
	 Route::get('icons', function () {return view('pages.icons');})->name('icons'); 
	 Route::get('table-list', function () {return view('pages.tables');})->name('table');
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
	
	Route::get('libros',[librosController::class, 'index'])->name('r.libros');
			
	Route::post('api/guardar_libro',[librosController::class, 'guardar']);
	Route::post('api/eliminar_libro',[librosController::class, 'eliminar']);
	Route::get('api/libros',[librosController::class, 'listar']);
		Route::get('api/categorias',[categorias_controller::class, 'listar']);
	Route::get('api/autores',[autores_controller::class, 'listarAutor']);
	Route::get('api/editoriales',[editorial_controller::class, 'listarEditorial']);

	Route::get('categorias',[categorias_controller::class, 'index'])
				->middleware('verificarRol:1')
				->name('r.categorias');
	Route::post('api/guardar_categoria',[categorias_controller::class, 'guardar']);
	Route::post('api/eliminar_categoria',[categorias_controller::class, 'eliminar']);
	Route::get('api/categoria',[categorias_controller::class, 'listar']);
	
	Route::get('autores',[autores_controller::class, 'index'])
				->middleware('verificarRol:1')
				->name('r.autores');
	Route::post('api/guardar_autor',[autores_controller::class, 'guardar']);
	Route::post('api/eliminar_autor',[autores_controller::class, 'eliminar']);
	Route::get('api/autores',[autores_controller::class, 'listar']);

	Route::get('editoriales',[editorial_controller::class, 'index'])
				->middleware('verificarRol:1')
				->name('r.editoriales');
	Route::post('api/guardar_editorial',[editorial_controller::class, 'guardar']);
	Route::post('api/eliminar_editorial',[editorial_controller::class, 'eliminar']);
	Route::get('api/editoriales',[editorial_controller::class, 'listar']);

	Route::get('venta',[venta_controller::class, 'index'])->name('r.ventas');
	Route::post('api/guardar_venta',[venta_controller::class, 'guardar']);
	Route::post('api/eliminar_venta',[venta_controller::class, 'eliminar']);
	Route::get('api/mostrar_libros',[venta_controller::class, 'listar']);
});

