<?php

use App\Http\Controllers\CodeVerification;
use App\Http\Controllers\DataController;
use App\Http\Controllers\enviarInvitacion;
use App\Http\Controllers\login;
use App\Http\Controllers\RecuperacionController;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\UpdateController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InfoController;
use App\Http\Middleware\Admin;

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

Route::get('/admin', [DataController::class, 'show'])->name('admin');

Route::get('/admin/delete/{id}', [DataController::class, 'delete'])->middleware(Admin::class);
Route::get('/admin/editar/{id}', [DataController::class, 'getdata'])->middleware(Admin::class);
Route::post('/admin/editar/updatedata', [DataController::class, 'edit'])->middleware(Admin::class);

Route::get('/enviar', function(){
    return view('enviar');
})->name('enviar');

Route::post('verificacion', [CodeVerification::class, 'verification']);

Route::post('info', [InfoController::class, 'info'])->name('info');;

Route::post('registro', [RegistroController::class, 'store']);

Route::post('recuperacion', [RecuperacionController::class, 'check']);

Route::post('login', [login::class, 'login']);

Route::post('sendinvitation', [enviarInvitacion::class, 'invitacion'])->middleware(Admin::class);


