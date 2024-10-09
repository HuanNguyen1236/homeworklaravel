<?php

use App\Http\Controllers\AccountController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;

// Route::get('/',[HomeController::class, 'index'])->name('index');
Route::get('/',[ProductController::class, 'store'])->name('index');
Route::get('/about', [HomeController::class, 'about'])->name("about");
Route::get('/product', [HomeController::class, 'show'])->name("product-detail");
Route::get('/cart', function () {
    return view(view: 'home.cart');
});
Route::get('/login', function () {
    return view(view: 'home.login');
})->name('login');
Route::get('/registers', function () {
    return view(view: 'home.register');
})->name('register');

Route::get('register', [AccountController::class, 'showRegistrationForm'])->name('registerForm');
Route::post('register', [AccountController::class, 'register'])->name('register');
Route::get('login', [AccountController::class, 'showLoginForm'])->name('loginForm');
Route::post('login', [AccountController::class, 'login'])->name('login');
Route::post('logout', [AccountController::class, 'logout'])->name('logout');

Route::get('/product/detail/{id}', [ProductController::class, 'show'])->name('productdetail');
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart/{id}', [CartController::class, 'create'])->name('addNewOrder');
