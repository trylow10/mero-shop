<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\StockController;




Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

Route::get('/', [ProductController::class, 'showProduct'])->name('homepage');


//Route::delete('stocks/destroy', 'StocksController@massDestroy')->name('stocks.massDestroy');




// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'admin'])->name('dashboard');

//route for products view
// Route::get('/products', function () {
//     return view('products');
// })->middleware(['auth', 'admin'])->name('products');

// route for add product view
// Route::get('/addProduct', function () {
//     return view('addProduct');
// })->middleware(['auth', 'admin'])->name('addProducts');

// create a new product
// Route::get('product', [ProductController::class, 'create'])->middleware(['auth', 'admin'])->name('create');
// Route::post('product', [ProductController::class, 'store'])->middleware(['auth', 'admin'])->name('store');

// // show products for admin for crud
// Route::get('/products', [ProductController::class, 'show'])->middleware(['auth', 'admin'])->name('products');

// // edit product view route
// Route::get('product/edit/{id}', [ProductController::class, 'edit'])->middleware(['auth', 'admin'])->name('productedit');

// // edit product POST or submit data route
// Route::post('editproduct/{id}', [ProductController::class, 'update'])->middleware(['auth', 'admin'])->name('productedit');

// // del product
// Route::delete('/products/{products}', [ProductController::class, 'destroy'])->middleware(['auth', 'admin'])->name('productdelete');

// // show all products to homepage for user
// Route::get('/', [ProductController::class, 'showProduct'])->name('homepage');


// //buy now and add to cart for user

// // Route::get('/', [ProductController::class, 'buynow'])->name('purchase');

// // mailchimp
// Route::post('newsletter', [ProductController::class, 'newsLetter']);

// dashboard Controller showing number of products

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
