<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::prefix('/v1')->group(function () {
    include __DIR__ . '/products.php';
    include __DIR__ . '/stocks.php';

    include __DIR__ . '/category.php';
    include __DIR__ . '/profiles.php';

    include __DIR__ . '/dashboard.php';
    include __DIR__ . '/report.php';
    include __DIR__ . '/report-stocks.php';

    Route::prefix('/stock')->group(function () {
        // isi sesua controller masing masing
        Route::get('/', function () {
            return json_encode([
                "message" => "hallo",
            ]);
        });
        Route::post('/', function () {
            return json_encode([
                "message" => "hallo",
            ]);
        });
        Route::put('/:id', function () {
            return json_encode([
                "message" => "hallo",
            ]);
        });
        Route::delete('/:id', function () {
            return json_encode([
                "message" => "hallo",
            ]);
        });
    });

    Route::prefix('/transactions')->group(function () {
        // isi sesua controller masing masing
        Route::get('/', [App\Http\Controllers\Api\TrancationController::class, 'index']);
        Route::post('/', [App\Http\Controllers\Api\TrancationController::class, 'store']);
        Route::get('/{id}', [App\Http\Controllers\Api\TrancationController::class, 'show']);
        Route::put('/:id', function () {
            return json_encode([
                "message" => "hallo",
            ]);
        });
        Route::delete('/:id', function () {
            return json_encode([
                "message" => "hallo",
            ]);
        });
    });
});

include __DIR__ . '/auth.php';
