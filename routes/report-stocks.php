<?php

use App\Http\Controllers\Api\StockReportController;
use Illuminate\Support\Facades\Route;

Route::prefix('/report-stocks')->group(function () {
    Route::get('/', [StockReportController::class, 'index']);
});
