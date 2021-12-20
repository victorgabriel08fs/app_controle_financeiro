<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::apiResource('registros', 'RegistroController');
Route::prefix('api')->get('/teste', function () {
    Mail::send('auth.passwords.email', function ($m) {
        $m->from('contato.servidorlaravel@gmail.com', 'Controle Financeiro');
        $m->subject('Teste');
        $m->to('victorgabriel08fs@gmail.com');
    });
})->name('teste');
