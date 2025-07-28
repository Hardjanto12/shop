<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ValorantController;
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

Route::get('', [AuthController::class, 'home']);
Route::get('home', [AuthController::class, 'home'])->name('home');

// register
// Route::get('register', [AuthController::class, 'register'])->name('register')->middleware('guest');
// Route::post('custom-registration', [AuthController::class, 'customRegistration'])->name('register.custom')->middleware('guest');

// login
Route::get('/admin/login', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('custom-login', [AuthController::class, 'customLogin'])->name('login.custom')->middleware('guest');
Route::post('/admin/signout', [AuthController::class, 'signOut'])->name('signout')->middleware('auth');
Route::get('/admin/changepasssword', [AuthController::class, 'changePassword'])->name('changepassword')->middleware('auth');
Route::post('/password/update', [AuthController::class, 'updatePassword'])->name('password.update');


// dashboard and admin section
// Route::get('/admin/dashboard', [AdminController::class, 'report'])->name('sales.report')->middleware('auth');
Route::get('/admin/dashboard/product-list', [AdminController::class, 'productList'])->name('productlist')->middleware('auth');
Route::get('/admin/dashboard/category-list', [AdminController::class, 'categoryList'])->name('categorylist')->middleware('auth');
Route::get('/admin/dashboard/order-list', [AdminController::class, 'orderList'])->name('orderlist')->middleware('auth');
Route::get('/admin/dashboard/sales-report', [AdminController::class, 'productList'])->name('salesreport')->middleware('auth');
Route::get('/admin/dashboard', [AdminController::class, 'report'])->name('sales.report')->middleware('auth');

// fetch and update
// Route::get('/admin/dashboard/fetchandupdate', [ProductController::class, 'fetchAndUpdate'])->name('mlbbfetch')->middleware('auth');
Route::post('/admin/dashboard/fetch-and-update', [ProductController::class, 'fetchAndUpdate'])->name('fetchAndUpdate')->middleware('auth');;



// Route::get('product', [ProductController::class, 'index'])->name('products');
// Route::get('category', [CategoryController::class, 'index'])->name('categories');

// mobile legend section

Route::get('mobile-legends', [MobileLegendsController::class, 'index'])->name('mobile-legends');
Route::get('mobile-legends/fetch', [MobileLegendsController::class, 'fetch']);
Route::post('mobile-legends/order', [MobileLegendsController::class, 'placeOrder'])->name('place.order.ml');
Route::get('mobile-legends/payment', [MobileLegendsController::class, 'payment'])->name('payment.order.ml');
Route::post('mobile-legends/checkout', [MobileLegendsController::class, 'executeOrder'])->name('execute.order.ml');
Route::get('transaction/success', [MobileLegendsController::class, 'success'])->name('transaction.success');


// valo 


Route::get('valorant', [ValorantController::class, 'index'])->name('valorant');
Route::get('valorant/fetch', [ValorantController::class, 'fetch']);
Route::post('valorant/order', [ValorantController::class, 'placeOrder'])->name('place.order.valo');
Route::get('valorant/payment', [ValorantController::class, 'payment'])->name('payment.order.valo');
Route::post('valorant/checkout', [ValorantController::class, 'executeOrder'])->name('execute.order.valo');
Route::get('transaction/success', [ValorantController::class, 'success'])->name('transaction.success');



// categories section
Route::post('categories/store', [CategoryController::class, 'store'])->name('categories.store');
// Route::get('category/{id}', [CategoryController::class, 'show'])->name('categories.show');
// Route::get('categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
Route::put('categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
Route::delete('categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');

Route::get('/order-items', [OrderController::class, 'index'])->name('order-items');
Route::get('/order-items/{id}', [OrderController::class, 'show']);

// // API
// Route::get('/order/fetch', [OrderController::class, 'fetch']);
// Route::post('/order/place', [OrderController::class, 'placeOrder'])->name('place.order');
// Route::get('/order/payment', [OrderController::class, 'payment'])->name('payment.order');



// Route::get('/product/fetch', [ProductController::class, 'fetch']);
// Route::get('/product/fetch/{serialnumber}', [ProductController::class, 'show']);

// Route::get('product/add', [ProductController::class, 'addProduct']);
Route::put('product/edit/{id}', [ProductController::class, 'update'])->name('product.edit');
Route::delete('product/{id}', [ProductController::class, 'destroy'])->name('product.destroy');