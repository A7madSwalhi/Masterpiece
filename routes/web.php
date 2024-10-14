<?php

use App\Http\Controllers\Admin\dashboard\BrandsController;
use App\Http\Controllers\Admin\dashboard\ProductsController;
use App\Http\Controllers\Front\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\dashboard\CategoriesController;
use App\Http\Controllers\Admin\dashboard\GallariesController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Vendor\ProfileController as VendorProfileController;

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

Route::get('/', [HomeController::class,'index'])->name('home');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});


require __DIR__.'/auth.php';

require __DIR__.'/admin-auth.php';

require __DIR__.'/vendor-auth.php';

/*
*
*
*  Admin Routes
*
*
*
*
 */



Route::prefix('admin')->as('admin.')->middleware('auth:admin')->group(function () {

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::resource('/categories',CategoriesController::class);

    Route::resource('/brands',BrandsController::class);
    Route::patch('/admin/brands/{product}/feature', [BrandsController::class, 'toggleFeature'])->name('brands.feature');


    Route::resource('/products',ProductsController::class);
    Route::patch('/admin/products/{product}/feature', [ProductsController::class, 'toggleFeature'])->name('products.feature');
    Route::put('/products/gallaryimage/{image}',[GallariesController::class,'update'])->name('products.feature.gallaryImage.update');

    Route::delete('/products/gallaryimage/{image}',[GallariesController::class,'destroy'])->name('products.feature.gallaryImage.destroy');

    Route::get('/profile/{id}', [AdminProfileController::class, 'edit'])->name('profile');
    Route::put('/profile/{id}', [AdminProfileController::class, 'update'])->name('profile.update');
});










/*
*
*
*
*   Vendor Routes
*
*
*
 */



Route::prefix('vendor')->as('vendor.')->middleware('auth:vendor')->group(function () {

    Route::get('/dashboard', function () {
        return view('store.dashboard');
    })->name('dashboard');

    Route::get('/profile/{id}', [VendorProfileController::class, 'edit'])->name('profile');
    Route::put('/profile/{id}', [VendorProfileController::class, 'update'])->name('profile.update');


});







