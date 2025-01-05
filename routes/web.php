<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PaymentController;

// Route untuk signup (tampilan awal)
Route::get('/signup', [AuthController::class, 'showSignup'])->name('signup');

// Route untuk form registrasi
Route::get('/register', [AuthController::class, 'showRegister'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

// Route untuk menu dan detail produk
Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');
Route::get('/menu/{id}', [MenuController::class, 'show'])->name('menu.detail');

// Route untuk keranjang belanja
Route::post('/cart/add', [MenuController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/update/{id}', [MenuController::class, 'updateQuantity'])->name('cart.update');
Route::post('/cart/remove/{id}', [MenuController::class, 'removeFromCart'])->name('cart.remove');
Route::get('/menu/detail/{id}', [MenuController::class, 'show'])->name('menu.detail');


// Route untuk checkout
Route::get('/checkout', [CheckoutController::class, 'checkout'])->name('checkout.show');

Route::post('/checkout', [CheckoutController::class, 'processCheckout'])->name('checkout.process');

// Route untuk pembayaran
Route::post('/payment', [PaymentController::class, 'processPayment'])->name('payment.process');

// Route untuk halaman "Thank You"
Route::get('/thank-you', fn() => view('thank_you'))->name('thank_you.index');
