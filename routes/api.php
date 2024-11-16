<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\MangaController;
use App\Http\Controllers\SubcategoriaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/listar-categorias', [CategoriaController::class, 'index']);

Route::post('categorias', [CategoriaController::class, 'store']);
Route::put('categorias/{id} ', [CategoriaController::class, 'update']);
Route::delete('categorias/{id}', [CategoriaController::class, 'destroy']);

Route::get('subcategorias', [SubcategoriaController::class, 'index']);
Route::post('subcategorias', [SubcategoriaController::class, 'store']);
Route::put('subcategorias/{id} ', [SubcategoriaController::class, 'update']);
Route::delete('subcategorias/{id}', [SubcategoriaController::class, 'destroy']);

Route::get('mangas', [MangaController::class, 'index']);
Route::post('mangas', [MangaController::class, 'store']);
Route::put('mangas/{id} ', [MangaController::class, 'update']);
Route::delete('mangas/{id}', [MangaController::class, 'destroy']);

Route::get('/mangas/img/{id}', [MangaController::class, 'imagen']);