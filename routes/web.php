<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware('auth')->group(function () {
    Route::prefix('/dashboard')->group(function(){
       Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    });
    Route::prefix('/products')->group(function() {
        Route::get('/', [ProductController::class, 'index'])->name('product.index');
        Route::post('/', [ProductController::class, 'store'])->name('product.store');
        Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
        Route::post('/update/{id}', [ProductController::class, 'update'])->name('product.update');
        Route::delete('/delete/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
    });
    Route::prefix('/categories')->group(function() {
        Route::get('/', [CategoriesController::class, 'index'])->name('category.index');
        Route::post('/', [CategoriesController::class, 'store'])->name('category.store');
        Route::get('/edit/{id}', [CategoriesController::class, 'edit'])->name('category.edit');
        Route::post('/update/{id}', [CategoriesController::class, 'update'])->name('category.update');
        Route::delete('/delete/{id}', [CategoriesController::class, 'destroy'])->name('category.destroy');
    });
    Route::prefix('/users')->group(function() {
        Route::get('/', [UsersController::class, 'index'])->name('user.index');
    });
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
