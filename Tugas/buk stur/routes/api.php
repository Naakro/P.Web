<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;

// Route default
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// API Routes untuk books
Route::apiResource('books', BookController::class);

// API Routes untuk categories
Route::apiResource('categories', CategoryController::class);
