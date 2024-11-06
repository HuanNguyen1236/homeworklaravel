<?php

use App\Http\Controllers\AccountController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminController;

// Route::get('/',[HomeController::class, 'index'])->name('index');
Route::get('/', [ProductController::class, 'store'])->name('index');
Route::get('/about', [HomeController::class, 'about'])->name("about");
Route::get('/product', [HomeController::class, 'show'])->name("product-detail");

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

Route::get('/cart', [CartController::class, 'store'])->name('cart');
Route::get('/cart/removeallcart', [CartController::class, 'clearCart'])->name('clearCart');

Route::get('/profile/{id}', [AccountController::class, 'show'])->name('profile');
Route::post('/profile/update', [AccountController::class, 'update'])->name('profile.update');

Route::get('/admin/product/show/{id}', [AdminController::class, 'edit'])->name('product.edit');
Route::post('/admin/product/update/{id}', [ProductController::class, 'update'])->name('product.update');

Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
Route::get('/admin/user', [AdminController::class, 'storeUser'])->name('listUser');
Route::get('/admin/product', [AdminController::class, 'storeProduct'])->name('listProduct');
Route::get('/admin/product/newproduct', [AdminController::class, 'createProduct'])->name('createnewproduct');
Route::post('/admin/product/newproducts', [ProductController::class, 'create'])->name('product.create');
Route::get('/admin/cart', [AdminController::class, 'storeCart'])->name('listCart');
Route::get('/admin/product/remove/{id}', [ProductController::class, 'destroy'])->name('admin.removeProduct');
Route::get('/admin/product/clearAll', [ProductController::class, 'clearProduct'])->name('clearProduct');