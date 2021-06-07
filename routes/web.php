<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Manager\AuthController as ManagerAuthController;
use App\Http\Controllers\Manager\DashBoardController;
use App\Http\Controllers\Manager\ProductController;
use App\Http\Controllers\Manager\BillController;
use App\Http\Controllers\Manager\CustomerController;
use App\Http\Controllers\Manager\StockController;
use App\Http\Controllers\Manager\UserController;
use App\Http\Controllers\Manager\VoucherController;

Route::get('/', function () {
    return view('welcome');
});

//Auth::routes();

Route::prefix('manager')->group(function (){
    Route::get('login',             [ManagerAuthController::class,'login'])->name('manager.login_form');
    Route::post('login',            [ManagerAuthController::class,'postLogin'])->name('manager.login');
    Route::group([
        'middleware' => 'auth'
    ],function (){
        Route::get('logout',        [ManagerAuthController::class,'logout'])->name('manager.logout');
        Route::get('/',             [DashBoardController::class,'index'])->name('dashboard.index');

        Route::group([
            'prefix' => 'sam-pham'
        ],function (){
            Route::get('/',         [ProductController::class,'index'])->name('product.list');
            Route::get('tao-moi',   [ProductController::class,'index'])->name('product.create');
            Route::get('sua/{id}',  [ProductController::class,'edit'])->name('product.edit');
            Route::get('xoa/{id}',  [ProductController::class,'delete'])->name('product.delete');
            Route::post('cap-nhat', [ProductController::class,'update'])->name('product.update');
            Route::post('tao-moi',  [ProductController::class,'save'])->name('product.save');
        });
        Route::group([
            'prefix' => 'nhan-vien'
        ],function (){
            Route::get('/',         [UserController::class,'index'])->name('user.list');
            Route::get('tao-moi',   [UserController::class,'index'])->name('user.create');
            Route::get('sua/{id}',  [UserController::class,'edit'])->name('user.edit');
            Route::get('xoa/{id}',  [UserController::class,'delete'])->name('user.delete');
            Route::post('cap-nhat', [UserController::class,'update'])->name('user.update');
            Route::post('tao-moi',  [UserController::class,'save'])->name('user.save');
        });
        Route::group([
            'prefix' => 'kho'
        ],function (){
            Route::get('/',         [StockController::class,'index'])->name('stock.list');
            Route::get('tao-moi',   [StockController::class,'index'])->name('stock.create');
            Route::get('sua/{id}',  [StockController::class,'edit'])->name('stock.edit');
            Route::get('xoa/{id}',  [StockController::class,'delete'])->name('stock.delete');
            Route::post('cap-nhat', [StockController::class,'update'])->name('stock.update');
            Route::post('tao-moi',  [StockController::class,'save'])->name('stock.save');
        });
        Route::group([
            'prefix' => 'don-hang'
        ],function (){
            Route::get('/',         [BillController::class,'index'])->name('bill.list');
            Route::get('tao-moi',   [BillController::class,'index'])->name('bill.create');
            Route::get('sua/{id}',  [BillController::class,'edit'])->name('bill.edit');
            Route::get('xoa/{id}',  [BillController::class,'delete'])->name('bill.delete');
            Route::post('cap-nhat', [BillController::class,'update'])->name('bill.update');
            Route::post('tao-moi',  [BillController::class,'save'])->name('bill.save');
        });
        Route::group([
            'prefix' => 'voucher'
        ],function (){
            Route::get('/',         [VoucherController::class,'index'])->name('voucher.list');
            Route::get('tao-moi',   [VoucherController::class,'index'])->name('voucher.create');
            Route::get('sua/{id}',  [VoucherController::class,'edit'])->name('voucher.edit');
            Route::get('xoa/{id}',  [VoucherController::class,'delete'])->name('voucher.delete');
            Route::post('cap-nhat', [VoucherController::class,'update'])->name('voucher.update');
            Route::post('tao-moi',  [VoucherController::class,'save'])->name('voucher.save');
        });
    });
});
