<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OderUserController;
use App\Http\Controllers\StatisticsController;

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

// Public Routes
Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/detail/{user}', [HomeController::class, 'showDetailUser'])->name('detailUsers');

Route::get('/product/{id}', [HomeController::class, 'show'])->name('product.show');
Route::get('/category/{id}', [HomeController::class, 'showByCategory'])->name('category.show');
Route::get('/search', [HomeController::class, 'search'])->name('product.search');

// Cart Routes
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/checkout/selected', [CartController::class, 'checkoutSelected'])->name('checkout.selected');
Route::patch('/cart/update-quantity/{id}', [CartController::class, 'updateQuantity'])->name('cart.updateQuantity');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

// Checkout Routes
Route::get('/checkout/confirm', [CheckoutController::class, 'confirm'])->name('checkout.confirm');
Route::post('/checkout/confirm', [CheckoutController::class, 'placeOrder'])->name('checkout.placeOrder');
Route::get('/order/invoice/{id}', [CheckoutController::class, 'invoice'])->name('order.invoice');

// Comment Routes
Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
Route::get('/products/{id}/comments', [CommentController::class, 'show'])->name('comments.show');

// Admin Routes
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'showAdmin'])->name('admin');
    Route::resource('orders', OrderController::class);
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('users', UserController::class);
});

// User Routes
Route::middleware('auth')->group(function () {
    Route::get('/history', [OderUserController::class, 'index'])->name('history.index');
    Route::get('/history/{order}', [OderUserController::class, 'show'])->name('history.show');
    Route::get('/history/{order}/edit', [OderUserController::class, 'edit'])->name('history.edit');
    Route::post('/history/{order}/update', [OderUserController::class, 'update'])->name('history.update');
});

// Statistics Route
Route::get('/statistics', [StatisticsController::class, 'getStatistics'])->name('statistics.index');
