<?php

use App\Http\Controllers\CostomerController;
use App\Http\Controllers\DiscountController;
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
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\MembershipProductController;

Route::controller(LoginController::class)->group(function () {
    Route::get('register', 'register');
    Route::post('register/process', 'register_process');
    Route::get('/', 'login');
    Route::post('login/process', 'login_process');
    Route::get('logout','logout');
});

Route::get('admin/dashboard', function() {
    return view('admin.dashboard');
});



use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductUserController;
use App\Http\Controllers\TransaksiController;
use App\Http\Middleware\AuthMiddleware;

Route::middleware([AuthMiddleware::class])->group(function() {
    Route::controller(ProductController::class)->group(function() {
        Route::get('admin/dashboard', function() {
            return view('admin.dashboard');
        });

        Route::get('admin/product','list');
        Route::get('admin/product/create','create');
        Route::post('admin/product/create/process','create_process');
        Route::get('admin/product/{id}/update','update');
        Route::post('admin/product/{id}/update/process','update_process');
        Route::get('admin/product/{id}/restock','restock');
        Route::post('admin/product/{id}/restock/process','restock_process');
        Route::delete('admin/product/{id}/delete','delete');
    
    });

    Route::controller(MembershipProductController::class)->group(function() {
        Route::get('admin/membership','index');
        Route::get('admin/membership/create','create');
        Route::post('admin/membership/create/process','create_process');
        Route::get('admin/membership/{id}/update','update');
        Route::post('admin/membership/{id}/update/process','update_process');
        Route::get('admin/membership/{id}/restock','restock');
        Route::post('admin/membership/{id}/restock/process','restock_process');
        Route::delete('admin/membership/{id}/delete','delete');
    });

    Route::controller(DiscountController::class)->group(function() {
        Route::get('admin/discount','list');
        Route::get('user/discount','index');
        Route::get('admin/discount/create','create');
        Route::post('admin/discount/create/process','create_process');
        Route::get('admin/discount/{id}/update','update');
        Route::post('admin/discount/{id}/update/process','update_process');
        Route::delete('admin/discount/{id}/delete','delete');
    });

    Route::controller(CostomerController::class)->group(function() {
        Route::get('admin/customers','index');
        Route::get('admin/customers/{id}/update','update');
        Route::post('admin/customers/{id}/update/process','update_process');
    });

    Route::controller(MembershipController::class)->group(function() {
        Route::get('user/dashboard','dashboard');
        Route::get('user/membership','index');
        Route::get('user/membership/order','data');
        Route::get('user/membership/order/exchange','exchange');
        Route::get('user/membership/history','history');
        Route::get('user/membership/{id}/order','order');
        Route::get('user/membership/order/{id}/delete','delete');
        Route::get('admin/membership/recap','recap');
        Route::get('user/membership/{id}/detail','detail');
    });

    Route::controller(ProductUserController::class)->group(function() {
        Route::get('user/product','product');
        Route::get('user/product/category/{category}','category');
        Route::get('user/product/{id}','detail');
        Route::get('user/product/{id}/order','order');
        Route::get('user/order','data');
        Route::get('user/order/{id}/delete','delete');
        Route::get('user/order/transaksi','add_transaksi');
        Route::get('user/order/{id}/discount','discount');
        Route::get('user/order/{id}/discount/transaksi','add_transaction');
    });

    Route::controller(TransaksiController::class)->group(function() {
        Route::get('admin/recap','recap');
        Route::get('admin/recap/{id}/detail','detail');
        Route::get('user/transaksi','index');
        Route::get('user/transaksi/{id}/cetak_struk','cetak_struk');
    });
});