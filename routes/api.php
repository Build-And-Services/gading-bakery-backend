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

    require __DIR__ . './category.php';

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
});

require __DIR__ . './auth.php';
