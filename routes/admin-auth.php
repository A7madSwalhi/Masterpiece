<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\RegisteredAdminController;
use App\Http\Controllers\Admin\Auth\AdminLoginController;


Route::prefix('admin')->middleware('guest:admin')->group(function () {


    Route::get('register', [RegisteredAdminController::class, 'create'])
                ->name('admin.register');

    Route::post('register', [RegisteredAdminController::class, 'store']);


    Route::get('login', [AdminLoginController::class, 'create'])
                ->name('admin.login');

    Route::post('login', [AdminLoginController::class, 'store']);


});

Route::prefix('admin')->as('admin.')->middleware('auth:admin')->group(function () {

    Route::post('logout', [AdminLoginController::class, 'destroy'])
                ->name('logout');

});
