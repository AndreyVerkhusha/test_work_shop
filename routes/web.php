<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/products');
Route::resource('products', ProductController::class);

Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
Route::post('/orders/{order}/complete', [OrderController::class, 'complete'])->name('orders.complete');
Route::post('/orders/{order}/increment-quantity', [OrderController::class, 'incrementQuantity'])->name('orders.incrementQuantity');
Route::post('/orders/{order}/decrement-quantity', [OrderController::class, 'decrementQuantity'])->name('orders.decrementQuantity');
