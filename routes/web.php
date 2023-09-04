<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Seller\ProductController;
use App\Http\Controllers\Buyer\ProductController as buyerproductcontroller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Buyer\ProductListController;

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

Route::get('/', [LoginController::class, 'login'])->name('login');
Route::post('/', [LoginController::class, 'login_check'])->name('login_check');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');


Route::get('Registration', [LoginController::class,'registration'])->name('registration');
Route::post('Registration', [LoginController::class,'add_registration'])->name('add_registration');

//Seller Side
Route::prefix('Seller')->name('seller.')->group(function(){
     Route::middleware('auth')->group(function(){
       Route::get('dashboard', [DashboardController::class, 'seller_dashboard'])->name('dashboard');
       Route::resource('product', ProductController::class);
     });
});




//Buyer Side
Route::prefix('Buyer')->name('buyer.')->group(function(){
    Route::middleware('auth')->group(function(){
      Route::get('dashboard', [DashboardController::class, 'buyer_dashboard'])->name('dashboard');

      //products
      Route::get('all_products', [ProductListController::class,'all_products'])->name('all_products');
      Route::get('women_products', [ProductListController::class,'women_product'])->name('women_product');
      Route::get('men_products', [ProductListController::class,'men_products'])->name('men_product');
      Route::get('watch_products', [ProductListController::class,'watch_products'])->name('watch_product');
      Route::get('shoes_products', [ProductListController::class,'shoes_products'])->name('shoes_product');
      Route::get('bag_products', [ProductListController::class,'bag_product'])->name('bag_product');

      //product details
      Route::get('product_details/{id}', [buyerproductcontroller::class,'product_details'])->name('product_details');
      Route::post('add_to_wishlist', [buyerproductcontroller::class, 'add_to_wishlist'])->name('add_to_wishlist');
    });
});