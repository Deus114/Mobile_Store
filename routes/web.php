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
    //Cart
    Route::get('/cart', [HomeController::class, 'cart_view'])->name('cart.view');
    Route::get('/onlinecart', [HomeController::class, 'online_cart_view'])->name('onlinecart.view');
    Route::get('/add_onlinecart/{product}', [HomeController::class, 'add_onlinecart'])->name('onlinecart.add');
    Route::get('/delete_onlinecart/{id}', [HomeController::class, 'delete_onlinecart'])->name('onlinecart.delete');
    Route::get('/onlinecartdown/{id}', [HomeController::class, 'onlinecart_down'])->name('onlinecart.down');
    Route::get('/onlinecartup/{id}', [HomeController::class, 'onlinecart_up'])->name('onlinecart.up');
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