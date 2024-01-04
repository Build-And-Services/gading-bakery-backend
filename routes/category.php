<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;

Route::prefix('/categories')->group(function () {
    // isi sesua controller masing masing
    Route::get('/', [\App\Http\Controllers\Api\CategoryController::class, 'index']);
    Route::post('/',[\App\Http\Controllers\Api\CategoryController::class, 'store']);
    Route::put('/{id}', [\App\Http\Controllers\Api\CategoryController::class, 'update']);
    Route::delete('{id}', [\App\Http\Controllers\Api\CategoryController::class, 'destroy']);
});
