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
});

Auth::routes();

Route::middleware('auth')->get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware('auth')->get('/home/show/{ano}', 'HomeController@ano')->name('home.ano');

Route::middleware('auth')->resource('registro', 'RegistroController');
Route::middleware('auth')->get('/registros/{ordenacao}', 'RegistroController@sort')->name('registro.sort');
Route::middleware('auth')->get('/registros/show/{ano}', 'RegistroController@ano')->name('registro.ano');
