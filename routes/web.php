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

    Route::middleware('cadastro.completo')->group(function () {
        Route::prefix('admin')->group(function () {
            Route::post('/user/revive/{user_id}', 'UserController@revive')->name('user.revive');
            Route::resource('user', 'UserController');
            Route::resource('taxa', 'TaxaController');
            Route::get('/dashboard', 'AdminController@index')->name('admin.dashboard');
            Route::get('/contas/{message?}', 'AdminController@contas')->name('admin.contas');
            Route::delete('/conta/{conta}', 'ContaController@destroy')->name('conta.destroy');
            Route::get('/conta/create/{user}/{tipo?}', 'ContaController@create')->name('conta.create');
            Route::post('/conta/cpf', 'ContaController@cpf')->name('conta.cpf');
            Route::post('/conta', 'ContaController@store')->name('conta.store');
            Route::post('/conta/revive/{conta_id}', 'ContaController@revive')->name('conta.revive');
            Route::put('/solicitacao/{solicitacao}', 'SolicitacaoController@update')->name('solicitacao.update');
            Route::get('/solicitacao', 'SolicitacaoController@index')->name('solicitacao.index');
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
            Route::post('/solicita', 'SolicitacaoController@store')->name('solicitacao.store');
            Route::post('/deposito/{conta}', 'ContaController@deposito')->name('conta.deposito');
            Route::post('/saque/{conta}', 'ContaController@saque')->name('conta.saque');
            Route::post('/transfer/{conta}', 'ContaController@transfer')->name('conta.transfer');
        });
    });

    Route::resource('endereco', 'EnderecoController');
    Route::post('/cep', 'EnderecoController@preencherEndereco')->name('endereco.preencher');
    Route::get('/cep/create/{cep}', 'EnderecoController@createCep')->name('endereco.cep');
    Route::resource('user_dados', 'UserDadosController');
});

Route::fallback(function () {
    return view('fallback');
});
