<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\WelcomeController;
use App\Models\User;
use App\Notifications\UserRegistered;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Redis;
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

Route::get('/', [WelcomeController::class, 'homeProducts'])->name('welcome');
Route::get('/product/{product}', [WelcomeController::class, 'showProduct'])->name('showProduct');
Route::get('/categorySingle/{category}', [WelcomeController::class, 'showCategoryProducts'])->name('showCategoryProducts');
Route::get('/categoryList', [WelcomeController::class, 'showCategories'])->name('showCategories');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::group(['middleware' => 'auth'], function () {

    Route::group(['middleware' => 'role:member'], function () {
        Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
        Route::post('/cart', [CartController::class, 'upsert'])->name('cart.store');
        Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
    });

    Route::resource('products', ProductsController::class);
    Route::resource('categories', CategoriesController::class);
});

Route::get('wasd/{id}', function ($id) {
    $visits = Redis::get('posts.{$id}.views');
    //$visits = Redis::incrBy('visits', 5);
    return $visits;

});

Route::get('blog/{id}/views', function ($id) {

    Redis::incr('posts.{$id}.views');
    return back();
});

Route::get('/notify', function () {
  $user = User::first();

  Notification::send($user, new UserRegistered);

});
