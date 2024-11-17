<?php

use App\Http\Controllers\admin\dashboard\OrdersController;
use App\Http\Controllers\front\VendorController;
use App\Http\Controllers\user\BeVendorController;
use App\Http\Controllers\user\dashboardController;
use App\Http\Controllers\Vendor\dashboard\OrderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\front\CartController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\front\CheckoutController;
use App\Http\Controllers\front\PaymentsController;
use App\Http\Controllers\front\ProductsReviewsController;
use App\Http\Controllers\Admin\dashboard\BrandsController;
use App\Http\Controllers\admin\dashboard\CouponsController;
use App\Http\Controllers\Admin\dashboard\ProductsController;
use App\Http\Controllers\Admin\dashboard\GallariesController;
use App\Http\Controllers\Admin\dashboard\CategoriesController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\front\OrderTrackController;
use App\Http\Controllers\front\ProductsController as FrontProductsController;
use App\Http\Controllers\user\OrdersController as UserOrdersController;
use App\Http\Controllers\Vendor\dashboard\ProductsController as DashboardProductsController;
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
    route::post('/products/{product}/review',[ProductsReviewsController::class,'store'])->name('products.review.submit');


    Route::get('/dashboardu',[dashboardController::class,'dashboard'])
    ->name('user.dashboard');
    Route::get('/profileu/{id}',[dashboardController::class,'profile'])
        ->name('user.profile');
    Route::post('/profileu/{id}',[dashboardController::class,'updateProfile'])
        ->name('user.profile.update');
    Route::get('/profileu/{id}',[dashboardController::class,'profile'])
        ->name('user.profile');
    Route::get('/profile/orders',[UserOrdersController::class,'index'])
        ->name('user.profile.orders');

    Route::get('/profile/reviews',[UserOrdersController::class,'allReviews'])
        ->name('user.profile.reviews');
    Route::post('/profile/reviews/{review}/update',[UserOrdersController::class,'updateReviews'])
        ->name('user.profile.reviews.update');
    Route::post('/profile/reviews/{review}/delete',[UserOrdersController::class,'deleteReviews'])
        ->name('user.profile.reviews.delete');

    Route::get('/profile/orders/{order}',[UserOrdersController::class,'show'])
        ->name('user.orders.show');
    Route::post('/profile/orders/{order}',[UserOrdersController::class,'cancel'])
        ->name('user.orders.cancel');
    Route::post('/profile/return/{order}',[UserOrdersController::class,'return'])
        ->name('user.orders.return');

    Route::get('/profile/BeVendor',[BeVendorController::class,'index'])
        ->name('user.profile.bevendor.index');
    Route::post('/profile/BeVendor',[BeVendorController::class,'create'])
        ->name('user.profile.bevendor.create');
    Route::post('/switch-to-vendor/{email}', [BeVendorController::class, 'switchToVendorAccount'])->name('switch.to.vendor');

});

route::get('/products',[FrontProductsController::class,'index'])->name('products.index');

route::get('/products/{product:slug}',[FrontProductsController::class,'show'])->name('products.show');

route::get('/vendors',[VendorController::class,'index'])->name('vendors.index');


route::resource('cart',CartController::class);

route::get('checkout',[CheckoutController::class,'create'])->name('checkout');
route::post('checkout',[CheckoutController::class,'store']);

route::get('order/track',[OrderTrackController::class,'index'])->name('track.index');
route::post('order/track/find',[OrderTrackController::class,'find'])->name('track.find');



route::get('orders/{order}/pay',[PaymentsController::class,'create'])
    ->name('orders.payments.create');

route::post('orders/{order}/stripe/payment-intent',[PaymentsController::class,'createStripePaymentIntent'])
    ->name('stripe.paymentIntent.create');

Route::get('orders/{order}/pay/stripe/callback', [PaymentsController::class, 'confirm'])
    ->name('stripe.return');

Route::post('orders/{order}/stripe/cod',[PaymentsController::class,'cod'])
    ->name('cod.return');

Route::get('orders/{order}/invoice',[CheckoutController::class,'invoice'])
    ->name('order.payment.invoice');















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

    Route::resource('/coupons',CouponsController::class);

    Route::get('/orders/pending',[OrdersController::class,'pending'])->name('orders.pending');
    Route::get('/orders/confirmed',[OrdersController::class,'confirmed'])->name('orders.confirmed');
    Route::get('/orders/processing',[OrdersController::class,'processing'])->name('orders.processing');
    Route::get('/orders/delivering',[OrdersController::class,'delivering'])->name('orders.delivering');
    Route::get('/orders/completed',[OrdersController::class,'completed'])->name('orders.completed');

    Route::get('/orders/{order}/show',[OrdersController::class,'show'])->name('orders.show');
    Route::post('/orders/{order}/confirm',[OrdersController::class,'confirmOrder'])->name('orders.confirmOrder');
    Route::post('/orders/{order}/process',[OrdersController::class,'processOrder'])->name('orders.processorder');
    Route::post('/orders/{order}/delivering',[OrdersController::class,'shppingOrder'])->name('orders.deliveringOrder');
    Route::post('/orders/{order}/complete',[OrdersController::class,'completeOrder'])->name('orders.completeOrder');

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


    Route::resource('/products',DashboardProductsController::class);
    Route::patch('/vendor/products/{product}/feature', [DashboardProductsController::class, 'toggleFeature'])->name('products.feature');

    Route::get('/orders/confirmed',[OrderController::class,'confirmed'])->name('orders.confirmed');
    Route::get('/orders/all',[OrderController::class,'all'])->name('orders.all');
    Route::get('/orders/{order}/show',[OrderController::class,'show'])->name('orders.show');

    Route::post('/orders/{order}/process',[OrderController::class,'process'])->name('orders.processorder');



    Route::get('/profile/{id}', [VendorProfileController::class, 'edit'])->name('profile');
    Route::put('/profile/{id}', [VendorProfileController::class, 'update'])->name('profile.update');


});







