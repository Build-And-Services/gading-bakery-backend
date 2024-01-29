<?php

use App\Http\Controllers\Api\StockReportController;
use Illuminate\Support\Facades\Route;

Route::prefix('/report-stocks')->group(function () {
    Route::get('/', [StockReportController::class, 'index']);
    Route::get('/today', [StockReportController::class, 'getReportsToday']);
    Route::get('/month/{month}', [StockReportController::class, 'getReportsMonth']);
    Route::get('/year/{year}', [StockReportController::class, 'getReportsYear']);
    Route::get('/date/{date}', [StockReportController::class, 'customGetReports ']);
});
