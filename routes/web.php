<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Public\HomeController;

use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\UsersController as AdminUsersController;

use App\Http\Controllers\Manager\HomeController as ManagerHomeController;

use App\Http\Controllers\Distributor\HomeController as DistributorHomeController;
use App\Http\Services\Auth\AuthServices;
use App\Models\Role;

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

//public
Route::get('/', [HomeController::class, 'index'])->name('home');

// Authentication
Route::prefix('auth')->group(function () {
    Route::controller(LoginController::class)->prefix('login')->group(function () {
        Route::get('/', 'index')->name('auth.login.index');
        Route::post('/', 'store')->name('auth.login.store');
    });
    Route::controller(RegisterController::class)->prefix('register')->group(function () {
        Route::get('/', 'index')->name('auth.register.index');
        Route::post('/', 'store')->name('auth.register.store');
    });
    // logout
    Route::post('logout', function () {
        return (new AuthServices)->logout();
    })->name('auth.logout');
});

//Administrator
Route::middleware('auth:' . Role::ADMIN . '')->prefix('admin')->group(function () {
    Route::get('/', [AdminHomeController::class, 'index'])->name('admin.home');

    Route::prefix('users')->controller(AdminUsersController::class)->group(function () {
        Route::get('/', 'index')->name('admin.users.index');
        Route::prefix('create')->group(function () {
            Route::get('/', 'create')->name('admin.users.create');
            Route::post('/', 'store')->name('admin.users.store');
        });
    });
});

// Factory Manager
Route::middleware('auth:' . Role::FACTORY_MANAGER . '')->prefix('manager')->group(function () {
    Route::get('/', [ManagerHomeController::class, 'index'])->name('manager.home');
});

//Distributor
Route::middleware('auth:' . Role::DISTRIBUTOR . '')->prefix('distributor')->group(function () {
    Route::get('/', [DistributorHomeController::class, 'index'])->name('distributor.home');
});
