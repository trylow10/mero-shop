<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;



Route::get('/category/index', [CategoryController::class, 'index'])->middleware(['auth', 'admin'])->name('category.index');


Route::get('/category', [CategoryController::class, 'create'])->middleware(['auth', 'admin'])->name('category.create');
Route::post('/category', [CategoryController::class, 'store'])->middleware(['auth', 'admin'])->name('category.store');
Route::get('/category/show{id}', [CategoryController::class, 'show'])->middleware(['auth', 'admin'])->name('category.show');
Route::get('category/edit/{id}', [CategoryController::class, 'edit'])->middleware(['auth', 'admin'])->name('category.edit');
Route::put('category/update/{id}', [CategoryController::class, 'update'])->middleware(['auth', 'admin'])->name('category.update');
Route::delete('category/{category}', [CategoryController::class, 'destroy'])->middleware(['auth', 'admin'])->name('category.delete');




Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

Route::get('/', [ProductController::class, 'showProduct'])->name('homepage');


Route::get('/dashboard', [DashboardController::class, 'count'])->middleware(['admin', 'auth'])->name('dashboard');


// Route::get('/cart', [PurchaseController::class, 'index']);
Route::get('/cart', [CartController::class, 'cart'])->name('cart');

Route::get('add-to-cart/{id}', [CartController::class, 'addToCart'])->name('add.to.cart');

Route::patch('update-cart', [CartController::class, 'update'])->name('update.cart');
Route::delete('remove-from-cart', [CartController::class, 'remove'])->name('remove.from.cart');

Route::get('/checkout', [PurchaseController::class, 'checkout'])->name('checkout');
// Route::get('/checkout', [PurchaseController::class, 'checkout'])->name('checkout.index');
// Route::get('/checkout', [PurchaseController::class, 'checkout'])->name('checkout');

Route::post('/checkout', [PurchaseController::class, 'storeOrderDetails'])->name('checkout.place.order');

Route::get('/purchase', [PurchaseController::class, 'index'])->middleware(['auth', 'admin'])->name('purchase');

require __DIR__ . '/auth.php';
