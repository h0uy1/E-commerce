<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;

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


Route::get('/',function(){
    return view('login');
})->name('login');

Route::get('/register',function(){
    return view('register');
});
Route::get('/login',function(){
    return view('login');
});
Route::get('/success',[CartController::class,'handleSuccess'])->name('Success');
Route::get('/failed',function(){
    return view('failed')->name('Failed');
});
Route::post('/webhook',[CartController::class,'handleWebhook']);

Route::middleware(['auth'])->group(function () {
    Route::get('/cart',[CartController::class,'getCarts'])->name('cart');
    Route::delete('/deleteCart/{cart}',[CartController::class,'deleteCart']);
    Route::put('/editCart/{cart}',[CartController::class,'updateCart']);
    Route::get('/user',[ProductController::class,'showUser'])->name('user');
    Route::post('/cart',[CartController::class,'addCart']);
    Route::post('/checkout',[CartController::class,'checkout']);
    Route::post('/user',[ProductController::class,'search']);
});



Route::post('/register',[UserController::class,'register']);
Route::post('/login',[UserController::class,'login']);
Route::post('/logout',[UserController::class,'logout']);


Route::middleware(['auth','is_admin'])->group(function () {
    // Routes that require authentication
    Route::post('/create_product', [ProductController::class, 'createProduct']);
    Route::get('/edit/{product}', [ProductController::class, 'editScreen']);
    Route::put('/edit/{product}',[ProductController::class,'editProduct']);
    Route::delete('/delete/{product}',[ProductController::class,'deleteProduct']);
    Route::get('/admin', [ProductController::class,'showAdmin']);
    Route::get('/admin/latest', [ProductController::class,'showLatest']);
    Route::post('/admin', [ProductController::class,'search']);
});