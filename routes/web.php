<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\dashboard\CategoriesController;

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

Route::get('/', function () {
    return view('welcome');
})->name('laravelhome');


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


});







