<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;


// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

Route::post('product/{id}/checkout', [ProductController::class, 'checkout'])->name('products.checkout');
Route::get('/payment-success/{productId}', [ProductController::class, 'success'])->name('payment.success');
Route::get('/payment-cancel', [ProductController::class, 'cancel'])->name('payment.cancel');