<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'auth','name'=>'admin.'],function () {
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/refresh', [AuthController::class, 'refresh'])->name('refresh');
    Route::get('/user-profile', [AuthController::class, 'userProfile'])->name('userProfile');
});

Route::group(['prefix' => 'product','name'=>'product.'],function () {

    Route::group(['middleware' => ['jwt.auth']], function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('/{ProductId}', [ProductController::class, 'show'])->name('show');
        Route::delete('/{ProductId}', [ProductController::class, 'destroy'])->name('destroy');
    });

    Route::group(['middleware' => ['assign.guard:admin', 'jwt.auth']], function () {
        Route::post('/', [ProductController::class, 'store'])->name('store');
        Route::put('/{ProductId}', [ProductController::class, 'update'])->name('update');
    });
});

Route::group(['prefix' => 'order','name'=>'order.','middleware' => ['assign.guard:user', 'jwt.auth']],function () {

    Route::get('/', [OrderController::class, 'index'])->name('index');
    Route::get('/{OrderId}', [OrderController::class, 'show'])->name('show');
    Route::delete('/{OrderId}', [OrderController::class, 'destroy'])->name('destroy');
    Route::post('/', [OrderController::class, 'store'])->name('store');
    Route::put('/{OrderId}', [OrderController::class, 'update'])->name('update');

});
