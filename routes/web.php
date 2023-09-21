<?php

use App\Http\Controllers\Auth\SocialLoginController;
use App\Http\Controllers\Front\Auth\TwoFactorAuthenticationController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\CheckoutController;
use App\Http\Controllers\Front\CurrencyConverterController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\PaymentsController;
use App\Http\Controllers\Front\ProductController;
use Illuminate\Support\Facades\Route;

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
Route::get('/',[HomeController::class,'index'])
    ->name('home');

Route::get('/products',[ProductController::class,'index'])
    ->name('products.index');

Route::get('/products/{product:slug}',[ProductController::class,'show'])
    ->name('products.show');

Route::get('checkout',[CheckoutController::class,'create'])->name('checkout');
Route::post('checkout',[CheckoutController::class,'store'])->name('checkout');

Route::resource('cart',CartController::class);

Route::get('auth/user/2fa',[TwoFactorAuthenticationController::class,'index'])
    ->name('front.2fa');

Route::post('currency',[CurrencyConverterController::class,'store'])
    ->name('currency.store');

Route::get('auth/{provider}/redirect',[SocialLoginController::class,'redirect'])
    ->name('auth.socialaite.redirect');

Route::get('auth/{provider}/callback',[SocialLoginController::class,'callback'])
    ->name('auth.socialaite.callback');

Route::get('orders/{order}/pay',[PaymentsController::class,'create'])
    ->name('orders.payments.create');

Route::post('orders/{order}/stripe/payment-intent',[PaymentsController::class,'createStripePaymentIntent'])
    ->name('orders.paymentIntent.create');

Route::get('orders/{order}/pay/stripe/callback',[PaymentsController::class,'confirm'])
    ->name('stripe.return');
//require __DIR__.'/auth.php';
require __DIR__.'/dashboard.php';