<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\ProductsController as PublicProductsController;

use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\UsersController as AdminUsersController;
use App\Http\Controllers\Admin\ProductsController as AdminProductsController;

use App\Http\Controllers\Manager\HomeController as ManagerHomeController;

use App\Http\Controllers\Distributor\CartController as DistributorCartController;

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
Route::prefix('products')->controller(PublicProductsController::class)->group(function () {
    Route::get('/', 'index')->name('public.products.index');
    Route::prefix('{id}')->controller(PublicProductsController::class)->group(function () {
        Route::get('/', 'show')->name('public.products.show');
    });
});

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
        Route::prefix('{userId}')->group(function () {
            Route::put('/', 'update')->name('admin.users.update');
        });
    });

    Route::prefix('products')->controller(AdminProductsController::class)->group(function () {
        Route::get('/', 'index')->name('admin.products.index');
        Route::prefix('create')->group(function () {
            Route::get('/', 'create')->name('admin.products.create');
            Route::post('/', 'store')->name('admin.products.store');
        });
        Route::prefix('{productId}')->group(function () {
            Route::delete('/', 'destroy')->name('admin.products.destroy');
        });
    });
});

// Factory Manager
Route::middleware('auth:' . Role::FACTORY_MANAGER . '')->prefix('manager')->group(function () {
    Route::get('/', [ManagerHomeController::class, 'index'])->name('manager.home');
});

//Distributor
Route::middleware('auth:' . Role::DISTRIBUTOR . '')->prefix('distributor')->group(function () {
   Route::prefix('cart')->controller(DistributorCartController::class)->group(function() {
    Route::post('/', 'store')->name('distributor.cart.products.store');
   });
});
