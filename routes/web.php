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
    return view('index');
})->name('index');

Route::get('/acesso-negado')->name('acesso-negado');

Auth::routes();
// Auth::routes(['verify' => true]);

Route::middleware('auth')->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/home/show/{ano}', 'HomeController@ano')->name('home.ano');
    Route::middleware('admin')->prefix('/admin')->post('/user/revive/{user_id}', 'UserController@revive')->name('user.revive');
    Route::middleware('admin')->prefix('/admin')->resource('user', 'UserController');
    Route::middleware('admin')->get('/admin/dashboard', 'AdminController@index')->name('admin.dashboard');
    Route::resource('registro', 'RegistroController');
    Route::get('/registros/{ordenacao}', 'RegistroController@sort')->name('registro.sort');
    Route::get('/registros/show/{ano}', 'RegistroController@ano')->name('registro.ano');

    Route::get('/conta', 'ContaController@index')->name('conta.index');
    Route::post('/conta/deposito/{conta}', 'ContaController@deposito')->name('conta.deposito');
    Route::post('/conta/saque/{conta}', 'ContaController@saque')->name('conta.saque');
});
// Route::middleware('auth')->middleware('verified')->group(function () {
//     Route::get('/home', 'HomeController@index')->name('home');
//     Route::get('/home/show/{ano}', 'HomeController@ano')->name('home.ano');
//     Route::middleware('admin')->prefix('/admin')->resource('user', 'UserController');
//     Route::middleware('admin')->get('/admin/dashboard', 'AdminController@index')->name('admin.dashboard');
//     Route::resource('registro', 'RegistroController');
//     Route::get('/registros/{ordenacao}', 'RegistroController@sort')->name('registro.sort');
//     Route::get('/registros/show/{ano}', 'RegistroController@ano')->name('registro.ano');
// });
