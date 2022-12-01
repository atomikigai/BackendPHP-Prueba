<?php

use App\Http\Controllers\CodeVerification;
use App\Http\Controllers\RecuperacionController;
use App\Http\Controllers\RegistroController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InfoController;
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
    return view('invitacion');
})->name('invitacion');

Route::post('/codigo', function(){
    return view('codigo');
});

Route::get('/registro', function(){
    return view('registro');
})->name('registro')->middleware('registro');

Route::get('/recuperacion', function(){
    return view('recuperarContrasena');
})->name('recuperacion');

Route::post('verificacion', [CodeVerification::class, 'verification']);

Route::post('info', [InfoController::class, 'info'])->name('info');;

Route::post('registro', [RegistroController::class, 'store']);

Route::post('recuperacion', [RecuperacionController::class, 'check']);
