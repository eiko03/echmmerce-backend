<?php

use App\Http\Controllers\AuthController;
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

Route::group(['prefix' => 'product','name'=>'admin.'],function () {

    Route::group(['middleware' => ['jwt.auth'], 'name' => 'product.'], function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('/{ProductId}', [ProductController::class, 'show'])->name('show');
        Route::delete('/{ProductId}', [ProductController::class, 'destroy'])->name('destroy');
    });

    Route::group(['middleware' => ['assign.guard:admin', 'jwt.auth']], function () {
        Route::post('/', [ProductController::class, 'store'])->name('store');
        Route::put('/{ProductId}', [ProductController::class, 'update'])->name('update');
    });
});
