<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/catalog');
});

Route::get('/registration', [RegistrationController::class, 'index'])->name('registration');
Route::post('/registration/validateData', [RegistrationController::class, 'validateData'])->name('registration.validateData');
Route::post('/registration/create', [RegistrationController::class, 'create'])->name('registration.create');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');


Route::get('/main', function () { return view('main');})->name('main');
Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog');

Route::post('/catalog', [CatalogController::class, 'filter'])->name('filter');

Route::get('/cart', [CartController::class, 'index'])->middleware('auth')->name('cart');
Route::post('/cart/add', [CartController::class, 'addToCart'])->middleware('auth')->name('cart.add');
Route::post('/cart/remove', [CartController::class, 'removeFromCart'])->middleware('auth')->name('cart.remove');

Route::get('/order', [OrderController::class, 'index'])->middleware('auth')->name('order');
Route::post('/order/sale', [OrderController::class, 'sale'])->middleware('auth')->name('order.sale');
Route::post('/order/add', [OrderController::class, 'create'])->middleware('auth')->name('order.add');

Route::get('/account', [AccountController::class, 'index'])->middleware('auth')->name('account.show');
Route::get('/account/data', [AccountController::class, 'showData'])->middleware('auth')-> name('account.data');
Route::get('/account/order', [AccountController::class, 'showOrder'])->middleware('auth')->name('account.order');
Route::get('/data', [AccountController::class, 'getUserData'])->middleware('auth')->name('data');
Route::post('/account/data/edit', [AccountController::class, 'editUser']) -> name('account.data.editUser');
Route::post('/account/data/editPassword', [AccountController::class, 'editPassword']) -> name('account.data.editPassword');

Route::get('/admin-panel', function () { return view('admin');})->middleware('admin')->name('admin');


