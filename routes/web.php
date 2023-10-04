<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Models\Product;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//Users
Route::group(['prefix' => 'users', 'controller' => UserController::class], function () {
    Route::get('/', 'index')->name('users.index');
    Route::post('/', 'create')->name('users.create');
    Route::put('/',  'modify')->name('users.modify');
    Route::delete('/{id}',  'destroy')->name('users.destroy');
});

//Categories
Route::group(['prefix' => 'categories', 'controller' => CategoryController::class], function () {
    Route::get('/', 'index')->name('categories.index');
    Route::get('/{id}', 'getCategory')->name('categories.getCategory');
    Route::post('/', 'create')->name('categories.create')->middleware('can:categories.create');
    Route::put('/' , 'modify')->name('categories.modify')->middleware('can:categories.modify');
    Route::delete('/{id}', 'destroy')->name('categories.destroy')->middleware('can:categories.destroy');
});

//Products
Route::group(['prefix' => 'products', 'controller' => ProductController::class], function () {
    Route::get('/', 'index')->name('products.index');
    Route::get('/{id}', 'getProduct')->name('products.getProduct');
    Route::post('/', 'create')->name('products.create');
    Route::put('/' , 'modify')->name('products.modify');
    Route::delete('/{id}', 'destroy')->name('products.destroy');
});


//cart
Route::group(['prefix' => 'cart', 'controller' => CartController::class], function () {
    Route::get('/', 'index')->name('cart.index');
    Route::post('/', 'create')->name('cart.create');
    Route::delete('/{id}', 'destroy')->name('cart.destroy');
});
