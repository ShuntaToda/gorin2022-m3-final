<?php

use App\Http\Controllers\CouponController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LoginController;
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
    return redirect(route('home'));
});


Route::get('login', [LoginController::class, 'index'])->middleware('guest')->name('login');
Route::post('login', [LoginController::class, 'check'])->middleware('guest');

Route::get('logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

Route::get('admin/items', [ItemController::class, 'index'])->middleware('auth')->name('home');

Route::get('admin/items_create', [ItemController::class, 'create'])->middleware('auth')->name('items_create');
Route::post('admin/items_create', [ItemController::class, 'store'])->middleware('auth');

Route::get('admin/items_edit/{id}', [ItemController::class, 'edit'])->middleware('auth')->name('items_edit');
Route::post('admin/items_edit/{id}', [ItemController::class, 'update'])->middleware('auth');

Route::get('admin/items_delete/{id}', [ItemController::class, 'destroy'])->middleware('auth')->name('items_delete');



Route::get('admin/coupons', [CouponController::class, 'index'])->middleware('auth')->name('coupons_list');

Route::get('admin/coupons_create', [CouponController::class, 'create'])->middleware('auth')->name('coupons_create');
Route::post('admin/coupons_create', [CouponController::class, 'store'])->middleware('auth');


Route::get('admin/coupons_delete/{id}', [CouponController::class, 'destroy'])->middleware('auth')->name('coupons_delete');
