<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ReportController;

Route::prefix('/reports')->group(function () {
    // isi sesua controller masing masing
    Route::get('/', [\App\Http\Controllers\Api\ReportController::class, 'index']);
});
