<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Vendor\Auth\VendorLoginController;
use App\Http\Controllers\Vendor\Auth\RegisteredVendorController;


Route::prefix('vendor')->middleware('guest:vendor')->group(function () {


    Route::get('register', [RegisteredVendorController::class, 'create'])
                ->name('vendor.register');

    Route::post('register', [RegisteredVendorController::class, 'store']);


    Route::get('login', [VendorLoginController::class, 'create'])
                ->name('vendor.login');

    Route::post('login', [VendorLoginController::class, 'store']);


});

Route::prefix('vendor')->as('vendor.')->middleware('auth:vendor')->group(function () {

    Route::get('/dashboard', function () {
        return view('store.dashboard');
    })->name('dashboard');

    Route::post('logout', [VendorLoginController::class, 'destroy'])
                ->name('logout');

});
