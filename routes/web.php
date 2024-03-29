<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\UpdatePasswordController;

use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\ProductsController as PublicProductsController;

use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\OrdersController as AdminOrdersContoller;
use App\Http\Controllers\Admin\UsersController as AdminUsersController;
use App\Http\Controllers\Admin\ProductsController as AdminProductsController;

use App\Http\Controllers\Distributor\CartController as DistributorCartController;
use App\Http\Controllers\Distributor\OrdersController as DistributorOrdersController;

use App\Http\Controllers\CustomerCare\OrdersController as CustomerCareOrdersController;

use App\Http\Controllers\Manager\ProcessingOrdersController;
use App\Http\Controllers\Manager\AvailableOrdersController;

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

    Route::controller(UpdatePasswordController::class)->prefix('user/confirm')->group(function () {
        Route::get('/', 'index')->name('auth.userConfirm.index');
        Route::put('/', 'update')->name('auth.userConfirm.update');
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
        Route::get('reports', 'print')->name('admin.users.report.index'); 
    }); 

    Route::prefix('products')->controller(AdminProductsController::class)->group(function () {
        Route::get('/generate-pdf', 'generatePdf')->name('admin.products.reports');
        Route::put('/products/{id}', [AdminProductsController::class, 'update'])->name('update.product');


        Route::get('/', 'index')->name('admin.products.index');
        Route::prefix('create')->group(function () {
            Route::get('/', 'create')->name('admin.products.create');
            Route::post('/', 'store')->name('admin.products.store');
        });
        Route::prefix('{productId}')->group(function () {
            Route::delete('/', 'destroy')->name('admin.products.destroy');
        });
    });

    Route::prefix('orders')->controller(AdminOrdersContoller::class)->group(function() {
        Route::get('/order-pdf', 'orderPdf')->name('admin.orders.reports');
        Route::get('/', 'index')->name('admin.orders.index');
    });
});

// Factory Manager
Route::middleware('auth:' . Role::FACTORY_MANAGER . '')->prefix('manager/orders')->group(function () {
    Route::controller(ProcessingOrdersController::class)->prefix('pending')->group(function () {
        Route::get('/', 'index')->name('manager.orders.processing.index');
        Route::put('/{id}', 'update')->name('manager.orders.processing.update');
    });
    Route::controller(AvailableOrdersController::class)->prefix('available')->group(function () {
        Route::get('/', 'index')->name('manager.orders.available.index');
    });
});

//Distributor
Route::middleware('auth:' . Role::DISTRIBUTOR . '')->prefix('distributor')->group(function () {
    Route::prefix('cart')->controller(DistributorCartController::class)->group(function () {
        Route::get('/', 'index')->name('distributor.cart.products.index');
        Route::post('/', 'store')->name('distributor.cart.products.store');
        Route::prefix('{productId}')->group(function () {
            Route::post('destroy', 'destroy')->name('distributor.cart.products.destroy');
        });
    });

    Route::prefix('orders')->controller(DistributorOrdersController::class)->group(function () {
        Route::get('/', 'index')->name('distributor.orders.index');
        Route::post('/', 'store')->name('distributor.orders.store');
        Route::prefix('{id}')->group(function () {
            Route::get('/', 'show')->name('distributor.orders.show');
            Route::put('/', 'update')->name('distributor.orders.update');
        });
    });
});

//Customer care
Route::middleware('auth:' . Role::CUSTOMER_CARE . '')->prefix('customercare')->group(function () {
    Route::controller(CustomerCareOrdersController::class)->group(function () {
        Route::get('/', 'index')->name('customercare.orders.index');
        Route::put('/{id}', 'update')->name('customercare.orders.update');
    });
});
