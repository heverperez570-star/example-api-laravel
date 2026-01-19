<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoryController; // Controlador de categorías

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

// http://localhost:8000/api/categories/index
Route::get('categories/index', [
    CategoryController::class, 
    'index'
]);

// http://localhost:8000/api/categories/register
Route::post('categories/register', [
    CategoryController::class, 
    'store'
]);

// http://localhost:8000/api/categories/find/{id}
Route::get('categories/find/{id}', [
    CategoryController::class, 
    'show'
]);

// http://localhost:8000/api/categories/update/{id}
Route::put('categories/update/{id}', [
    CategoryController::class, 
    'update'
]);

// http://localhost:8000/api/categories/delete/{id}
Route::delete('categories/delete/{id}', [
    CategoryController::class, 
    'destroy'
]);
