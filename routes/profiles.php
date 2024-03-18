<?php

use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    // ...
    Route::prefix('/profile')->group(function () {
        // isi sesua controller masing masing
        Route::post('/{id}', [\App\Http\Controllers\Api\ProfileController::class, 'update']);
    });
});
