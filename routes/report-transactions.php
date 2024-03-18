<?php

use App\Http\Controllers\Api\TransactionReportController;
use Illuminate\Support\Facades\Route;

Route::prefix('/report-transactions')->group(function () {
    Route::get('/', [TransactionReportController::class, 'index']);
    Route::get('/{day}/{month}/{year}', [TransactionReportController::class, 'getReportsToday']);
    Route::get('/{month}/{year}', [TransactionReportController::class, 'getReportsMonth']);
    Route::get('/{year}', [TransactionReportController::class, 'getReportsYear']);
});
