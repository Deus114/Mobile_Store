<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;

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
});

Route::get('/login', [HomeController::class, 'login'])->name('login');

Route::group(['prefix' => 'admin'], function(){
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/categories', [AdminController::class, 'categories'])->name('admin.categories');
});