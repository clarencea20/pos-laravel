<?php

use App\Http\Controllers\Cart;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\Product;
use App\Http\Controllers\Supplier;
use App\Http\Controllers\Transaction;
use App\Models\ProductModel;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Middleware\Authenticate;
use App\Http\Controllers\User;

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

Route::controller(User::class)->group(function() {
    Route::get('/', 'login')->name('login');
    Route::post('/process/login', 'processLogin');
});

Route::group(['middleware' => 'auth'], function()  {
    Route::controller(Dashboard::class)->group(function() {
        Route::get('/dashboard', 'index');
    });
    
    Route::controller(User::class)->group(function(){
        Route::get('/users', 'index');
        Route::get('/user/create', 'create');
        Route::get('/user/show/{id}', 'show');
        Route::get('/user/edit/{id}', 'edit');
        Route::get('/user/delete/{id}', 'delete');
    
        Route::post('/add-user', 'store');
        Route::post('/logout', 'processLogout')->name('logout');
    
        Route::put('/user/update/{user}', 'update');
        Route::delete('/user/delete/{user}', 'destroy');
    });
    
    Route::controller(Product::class)->group(function(){
        Route::get('/products', 'index');
        Route::get('/product/show/{id}', 'show');
    
        Route::post('/add-product', 'store');
        Route::put('/product/update/{product}', 'update');
        Route::delete('/product/delete/{product}', 'destroy');
    });
    
    Route::controller(Cart::class)->group(function(){
        Route::get('/pos', 'index')->name('cart.index');
    
        Route::post('/cart/add', [Cart::class, 'addToCart'])->name('cart.add');
        Route::post('/cart/remove', [Cart::class, 'removeFromCart'])->name('cart.remove');
        Route::post('/cart/discount', [Cart::class, 'calculateDiscount'])->name('cart.discount');
        Route::post('/cart/pay', [Cart::class, 'pay'])->name('cart.pay');
    
        Route::get('/receipt', [Cart::class, 'showReceipt'])->name('receipt');
    });
    
    Route::controller(Transaction::class)->group(function() {
        Route::get('/transactions', 'index');
    });

    Route::controller(Supplier::class)->group(function() {
        Route::get('/suppliers', 'index');

        Route::post('/add-supplier', 'store');
        Route::put('/supplier/update/{supplier}', 'update');
        Route::delete('/supplier/delete/{supplier}', 'destroy');
    });
    
});

