<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('products', [ProductController::class, 'show'])->middleware(['admin', 'auth'])->name('products');

Route::get('image/{id}', [ProductController::class, 'imgshow'])->name('images');

Route::get('/addProduct', function () {
    return view('addProduct');
})->middleware(['auth', 'admin'])->name('addProducts');
// create a new product

Route::get('product', [ProductController::class, 'create'])->middleware(['auth', 'admin'])->name('create');
Route::post('product', [ProductController::class, 'store'])->middleware(['auth', 'admin'])->name('store');

// show products for admin for crud

// edit product view route
Route::get('product/edit/{id}', [ProductController::class, 'edit'])->middleware(['auth', 'admin'])->name('productedit');

// edit product POST or submit data route
Route::post('editproduct/{id}', [ProductController::class, 'update'])->middleware(['auth', 'admin'])->name('productedit');

// del product
Route::delete('/products/{products}', [ProductController::class, 'destroy'])->middleware(['auth', 'admin'])->name('productdelete');

// show all products to homepage for user
// Route::get('/', [ProductController::class, 'showProduct'])->name('homepagee');
// require __DIR__ . '/auth.php';