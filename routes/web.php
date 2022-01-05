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

Route::get('/acesso-negado', function () {
    return view('acesso-negado');
})->name('acesso-negado');

Auth::routes();
// Auth::routes(['verify' => true]);

Route::middleware('auth')->group(function () {

    Route::middleware('user_dados')->group(function () {
        Route::middleware('endereco')->group(function () {
            Route::prefix('admin')->group(function () {
                Route::middleware('admin')->post('/user/revive/{user_id}', 'UserController@revive')->name('user.revive');
                Route::middleware('admin')->resource('user', 'UserController');
                Route::middleware('admin')->get('/dashboard', 'AdminController@index')->name('admin.dashboard');
                Route::middleware('admin')->get('/contas', 'AdminController@contas')->name('admin.contas');
                Route::delete('/conta/{conta}', 'ContaController@destroy')->name('conta.destroy');
                Route::middleware('admin')->post('/conta/revive/{conta_id}', 'ContaController@revive')->name('conta.revive');
            });
            Route::prefix('registros')->group(function () {
                Route::get('/home', 'HomeController@index')->name('registro.home');
                Route::get('/home/show/{ano}', 'HomeController@ano')->name('registro.home.ano');
                Route::resource('registro', 'RegistroController');
                Route::get('/{ordenacao}', 'RegistroController@sort')->name('registro.sort');
                Route::get('/show/{ano}', 'RegistroController@ano')->name('registro.ano');
            });

            Route::get('/home', 'HomeController@home')->name('home');

            Route::prefix('conta')->group(function () {
                Route::get('/', 'ContaController@index')->name('conta.index');
                Route::post('/deposito/{conta}', 'ContaController@deposito')->name('conta.deposito');
                Route::post('/saque/{conta}', 'ContaController@saque')->name('conta.saque');
                Route::post('/transfer/{conta}', 'ContaController@transfer')->name('conta.transfer');
            });
        });
    });
    Route::resource('endereco', 'EnderecoController');
    Route::resource('user_dados', 'UserDadosController');
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

Route::fallback(function () {
    return view('fallback');
});
