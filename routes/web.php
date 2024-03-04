<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BannerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Home Route
Route::prefix('')->group(function() {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    // Login
    Route::get('/login', [HomeController::class, 'login'])->name('login');
    Route::post('/login', [HomeController::class, 'check_login']);
    // Logout
    Route::get('/logout', [HomeController::class, 'logout'])->name('logout');
    // Register
    Route::get('/register', [HomeController::class, 'register'])->name('register');
    Route::post('/register', [HomeController::class, 'check_register']);
    // Detail
    Route::get('/detail/{product}', [HomeController::class, 'detail'])->name('home.detail');
    // Online Cart
    Route::get('/onlinecart', [HomeController::class, 'online_cart_view'])->name('onlinecart.view');
    Route::get('/add_onlinecart/{product}', [HomeController::class, 'add_onlinecart'])->name('onlinecart.add');
    Route::get('/delete_onlinecart/{id}', [HomeController::class, 'delete_onlinecart'])->name('onlinecart.delete');
    Route::get('/onlinecartdown/{id}', [HomeController::class, 'onlinecart_down'])->name('onlinecart.down');
    Route::get('/onlinecartup/{id}', [HomeController::class, 'onlinecart_up'])->name('onlinecart.up');
    // Show products
    Route::get('/product/{id}', [HomeController::class, 'product_by_category'])->name('product_by_category');
    Route::get('/product', [HomeController::class, 'product_all'])->name('product_all');
});

// User Cart
Route::group(['prefix' => 'usercart', 'middleware' => 'auth'], function(){
    Route::get('/view', [HomeController::class, 'user_cart_view'])->name('usercart.view');
    Route::get('/add/{product}', [HomeController::class, 'add_usercart'])->name('usercart.add');
    Route::get('/delete/{id}', [HomeController::class, 'delete_usercart'])->name('usercart.delete');
    Route::get('/down/{id}', [HomeController::class, 'usercart_down'])->name('usercart.down');
    Route::get('/up/{id}', [HomeController::class, 'usercart_up'])->name('usercart.up');
});

// User Cart
Route::group(['prefix' => 'profile', 'middleware' => 'auth'], function(){
    Route::get('/view', [HomeController::class, 'profile_view'])->name('profile.view');
    Route::get('/edit', [HomeController::class, 'profile_edit'])->name('profile.edit');
    Route::post('/edit', [HomeController::class, 'profile_update']);
});

// Admin Route
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function(){
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::resources([
        'category' => CategoryController::class,
        'product' => ProductController::class,
        'banner' => BannerController::class,
    ]);
    // Logout
    Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');
});