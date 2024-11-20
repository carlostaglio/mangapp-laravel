<?php

use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\MangaController;
use App\Http\Controllers\SubcategoriaController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/create-example-user', [UserController::class, 'createExampleUser']);

Route::post('/login', [UserController::class, 'login']);

Route::get('/listar-categorias', [CategoriaController::class, 'index']);
Route::post('categorias/crear', [CategoriaController::class, 'store'])->middleware('auth:sanctum');
Route::put('categorias/editar/{id} ', [CategoriaController::class, 'update'])->middleware('auth:sanctum');
Route::delete('categorias/eliminar/{id}', [CategoriaController::class, 'destroy'])->middleware('auth:sanctum');

Route::get('listar-subcategorias', [SubcategoriaController::class, 'index']);
Route::post('subcategorias/crear', [SubcategoriaController::class, 'store'])->middleware('auth:sanctum');
Route::put('subcategorias/editar/{id} ', [SubcategoriaController::class, 'update'])->middleware('auth:sanctum');
Route::delete('subcategorias/eliminar/{id}', [SubcategoriaController::class, 'destroy'])->middleware('auth:sanctum');

Route::get('listar-mangas', [MangaController::class, 'index']);
Route::post('mangas/crear', [MangaController::class, 'store'])->middleware('auth:sanctum');
Route::put('mangas/editar/{id} ', [MangaController::class, 'update'])->middleware('auth:sanctum');
Route::delete('mangas/eliminar/{id}', [MangaController::class, 'destroy'])->middleware('auth:sanctum');

Route::get('/mangas/img/{id}', [MangaController::class, 'imagen']);