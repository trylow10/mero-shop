<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RatingReviewController;
use App\Http\Controllers\StockController;

Route::get('products', [ProductController::class, 'show'])->middleware(['admin', 'auth'])->name('products');

Route::get('details/{id}', [ProductController::class, 'imgshow'])->name('details');
// Route::get('details/{id}', [ProductController::class, 'imgshow'])->name('details');

// Route::get('/post-create', [RatingReviewController::class, 'create'])->name('post.create');
// Route::post('/post-store', [RatingReviewController::class, 'store'])->name('post.store');
// Route::get('/post-list', [RatingReviewController::class, 'list'])->name('post.list');
// Route::get('view/{id}', [RatingReviewController::class, 'view'])->name('view');

#Manage Review
Route::post('/review-store', [RatingReviewController::class, 'store'])->name('review.store');
// Route::get('/review', [RatingReviewController::class, 'index'])->name('review');

Route::get('/stock', [StockController::class, 'create'])->name('stock');













Route::get('/addProduct', function () {
    return view('addProduct');
})->middleware(['auth', 'admin'])->name('addProducts');
// create a new product

Route::get('product', [ProductController::class, 'create'])->middleware(['auth', 'admin'])->name('create');
Route::post('product', [ProductController::class, 'store'])->middleware(['auth', 'admin'])->name('store');

// show products for admin for crud
Route::get('stock', [StockController::class, 'create'])->name('stock');

// edit product view route
Route::get('product/edit/{id}', [ProductController::class, 'edit'])->middleware(['auth', 'admin'])->name('productedit');

// edit product POST or submit data route
Route::put('editproduct/{id}', [ProductController::class, 'update'])->middleware(['auth', 'admin'])->name('product.update');

// del product
Route::delete('/products/{products}', [ProductController::class, 'destroy'])->middleware(['auth', 'admin'])->name('productdelete');

// show all products to homepage for user
// Route::get('/', [ProductController::class, 'showProduct'])->name('homepagee');
// require __DIR__ . '/auth.php';
