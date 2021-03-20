<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::group(['middleware' => 'auth'], function () {

    Route::group(['middleware' => 'role:admin'], function () {

    });

    Route::group(['middleware' => 'role:member'], function () {
        Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
        Route::post('/cart', [CartController::class, 'upsert'])->name('cart.store');
        Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
    });

    Route::resource('products', ProductsController::class);
    Route::resource('categories', CategoriesController::class);
});
