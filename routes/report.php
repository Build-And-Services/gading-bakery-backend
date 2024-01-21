<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ReportController;

Route::prefix('/reports')->group(function () {
    // isi sesua controller masing masing
    Route::get('/', [\App\Http\Controllers\Api\ReportController::class, 'index']);
    Route::get('/products', [\App\Http\Controllers\Api\ReportController::class, 'productReports']);
    Route::get('/products/{productId}', [\App\Http\Controllers\Api\ReportController::class, 'showProductReports']);
    Route::get('/categories', [\App\Http\Controllers\Api\ReportController::class, 'categoryReports']);
    Route::get('/categories/{categoryId}', [\App\Http\Controllers\Api\ReportController::class, 'showCategoryReports']);
});
