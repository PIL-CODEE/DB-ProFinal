<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\TorneosController;
use App\Http\Controllers\ClassesUserController;
use App\Http\Controllers\TorneosUserController;
use App\Http\Controllers\LoginController;

Route::view('/login', "login")->name('login');
Route::view('/registro', "register")->name('registro');
Route::post('/validar-registro',[LoginController::class, 'register'])->name('validate-register');
Route::post('/inicia-sesion',[LoginController::class, 'login'])->name('start-sesion');
Route::get('/logout',[LoginController::class, 'logout'])->name('logout');

Route::get('/admi_clases', [ClassesController::class, 'indexclass'])->name('administrador.clases');
Route::get('/eliminar_clase/{id}', [ClassesController::class, 'deleteclass'])->name('administrador.delete-classes');
Route::get('/desactivar_clase/{id}', [ClassesController::class, 'deactivate'])->name('administrador.desactivar-estado-clases');
Route::get('/activar_clase/{id}', [ClassesController::class, 'activate'])->name('administrador.activar-estado-clases');
Route::get('/registrar_clase', [ClassesController:: class, 'classcreate'])->name('administrador.register-class');
Route::post('/crear_clase', [ClassesController:: class, 'createclass'])->name('administrador.create-class');
Route::get('/editar_clase/{id}', [ClassesController:: class, 'editclass'])->name('administrador.edit-class');
Route::post('/modificar_clase/{id}', [ClassesController:: class, 'updateclass'])->name('administrador.update-class');

Route::get('/clases', [ClassesUserController:: class, 'indexclass'])->name('usuario.index-clases');
Route::view('/', "usuario.index");
Route::get('/torneos', [TorneosUserController:: class, 'indextorneo'])->name('usuario.index-torneos');

Route::get('/admi_torneos', [TorneosController::class, 'indextorneo'])->name('administrador.torneos');
Route::get('/desactivar_torneo/{id}', [TorneosController::class, 'deactivate'])->name('administrador.desactivar-estado');
Route::get('/activar_torneo/{id}', [TorneosController::class, 'activate'])->name('administrador.activar-estado');
Route::get('/registrar_torneo', [TorneosController:: class, 'torneocreate'])->name('administrador.register-torneo');
Route::post('/crear_torneo', [TorneosController:: class, 'createtorneo'])->name('administrador.create-torneo');
Route::get('/editar_torneo/{id}', [TorneosController:: class, 'edittorneo'])->name('administrador.edit-torneo');
Route::post('/modificar_torneo/{id}', [TorneosController:: class, 'updatetorneo'])->name('administrador.update-torneo');
Route::get('/eliminar_torneo/{id}', [TorneosController::class, 'deletetorneo'])->name('administrador.delete-torneo');

Route::view('/navegacion', "navegacion");

Route::middleware('auth')->group(function () {
    Route::get('/realizar_inscripcion/{id}', [ClassesUserController:: class, 'inscripciones'])->name('usuario.inscribirse');
    Route::get('/realizar_inscripcion_torneo/{id}', [TorneosUserController:: class, 'inscripciones'])->name('usuario.inscribirse-torneo');
});
