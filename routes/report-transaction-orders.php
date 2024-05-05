<?php

use App\Http\Controllers\Api\ReportTransactionsOrderController;
use Illuminate\Support\Facades\Route;

Route::prefix('/report-transaction-orders')->group(function () {
  Route::get('/', [ReportTransactionsOrderController::class, 'index']);
  Route::get('/{day}/{month}/{year}', [ReportTransactionsOrderController::class, 'reportDay']);
  Route::get('/{month}/{year}', [ReportTransactionsOrderController::class, 'reportMonth']);
  Route::get('/{year}', [ReportTransactionsOrderController::class, 'reportYear']);
});
