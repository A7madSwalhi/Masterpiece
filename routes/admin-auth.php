<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\RegisteredAdminController;
use App\Http\Controllers\Admin\Auth\AdminLoginController;
use App\Http\Controllers\Admin\dashboard\CategoriesController;

Route::prefix('admin')->middleware('guest:admin')->group(function () {


    Route::get('register', [RegisteredAdminController::class, 'create'])
                ->name('admin.register');

    Route::post('register', [RegisteredAdminController::class, 'store']);


    Route::get('login', [AdminLoginController::class, 'create'])
                ->name('admin.login');

    Route::post('login', [AdminLoginController::class, 'store']);


});

Route::prefix('admin')->as('admin.')->middleware('auth:admin')->group(function () {

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::post('logout', [AdminLoginController::class, 'destroy'])
                ->name('logout');

    Route::resource('/categories',CategoriesController::class);
});
