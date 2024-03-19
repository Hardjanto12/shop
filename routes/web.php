<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MobileLegendsController;

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


Route::get('', [AuthController::class, 'home'])->name('home');
Route::get('home', [AuthController::class, 'home'])->name('home');
Route::get('login', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('custom-login', [AuthController::class, 'customLogin'])->name('login.custom')->middleware('guest');
Route::get('register', [AuthController::class, 'register'])->name('register')->middleware('guest');
Route::post('custom-registration', [AuthController::class, 'customRegistration'])->name('register.custom')->middleware('guest');
Route::get('signout', [AuthController::class, 'signOut'])->name('signout')->middleware('auth');

Route::get('product', [ProductController::class, 'index'])->name('products');
Route::get('category', [CategoryController::class, 'index'])->name('categories');


Route::get('mobile-legends', [MobileLegendsController::class, 'index'])->name('mobile-legends');
Route::get('mobile-legends/fetch', [MobileLegendsController::class, 'fetch']);
Route::post('mobile-legends/order', [MobileLegendsController::class, 'placeOrder'])->name('place.order.ml');
Route::post('mobile-legends/checkout', [MobileLegendsController::class, 'executeOrder'])->name('execute.order.ml');
Route::get('mobile-legends/payment', [MobileLegendsController::class, 'payment'])->name('payment.order.ml');






Route::get('category/{id}', [CategoryController::class, 'show'])->name('categories.show');


Route::get('/order-items', [OrderController::class, 'index'])->name('order-items');
Route::get('/order-items/{id}', [OrderController::class, 'show']);

// // API
// Route::get('/order/fetch', [OrderController::class, 'fetch']);
// Route::post('/order/place', [OrderController::class, 'placeOrder'])->name('place.order');
// Route::get('/order/payment', [OrderController::class, 'payment'])->name('payment.order');



Route::get('/product/fetch', [ProductController::class, 'fetch']);
Route::get('/product/fetch/{serialnumber}', [ProductController::class, 'show']);
