<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Public\HomeController;

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
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('auth')->group(function () {
    Route::controller(LoginController::class)->prefix('login')->group(function () {
        Route::get('/', 'index')->name('auth.login.index');
    });
    Route::controller(RegisterController::class)->prefix('register')->group(function () {
        Route::get('/', 'index')->name('auth.register.index');
    });
});
