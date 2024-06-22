<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClassesController;

Route::get('/', [ClassesController::class, 'indexclass'])->name('administrador.clases');
Route::get('/eliminar_clase/{id}', [ClassesController::class, 'deleteclass'])->name('administrador.delete-classes');
Route::get('/desactivar_clase/{id}', [ClassesController::class, 'deactivate'])->name('administrador.desactivar-estado');
Route::get('/activar_clase/{id}', [ClassesController::class, 'activate'])->name('administrador.activar-estado');
Route::get('/registrar_clase', [ClassesController:: class, 'classcreate'])->name('administrador.register-class');
Route::post('/crear_clase', [ClassesController:: class, 'createclass'])->name('administrador.create-class');
Route::get('/editar_clase/{id}', [ClassesController:: class, 'editclass'])->name('administrador.edit-class');
Route::post('/modificar_clase/{id}', [ClassesController:: class, 'updateclass'])->name('administrador.update-class');


