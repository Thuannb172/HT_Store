<?php

use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\FrontendController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('/admin', function () {
    return view('admin.home');
});
Route::get('/login', [FrontendController::class, 'showLoginForm'])->name('login');
Route::post('/login', [FrontendController::class, 'login']);
Route::get('/logout', function () {
    Auth::logout();
    return redirect('/login')->with('success', 'Bạn đã đăng xuất!');
})->middleware('auth')->name('logout');




Route::get('/admin/product/create', [ProductController::class, 'addProduct']);
Route::get('/admin/product/list', [ProductController::class, 'listProduct'])->name('admin.product.list');
Route::post('/admin/product/add', [ProductController::class, 'store']);
Route::get('/admin/product/{id}/edit', [ProductController::class, 'edit'])->name('admin.product.edit');
Route::put('/admin/product/{id}', [ProductController::class, 'update'])->name('admin.product.update');
Route::delete('/admin/product/{id}', [ProductController::class, 'destroy'])->name('admin.product.destroy');

Route::get('/admin/order/list', [OrderController::class, 'listOrders'])->name('admin.order.list');
Route::get('/admin/order/detail/{id}', [OrderController::class, 'detail'])->name('admin.order.detail');
Route::get('/admin/order/{id}/confirm', [OrderController::class, 'confirm'])->name('admin.order.confirm');
Route::get('/admin/order/{id}/delete', [OrderController::class, 'delete'])->name('admin.order.delete');




// Front-end
Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('/product/{id}', [FrontendController::class, 'show'])->name('product.show');
Route::get('/cart', [FrontendController::class, 'showCart'])->name('cart');
Route::post('/cart/{id}', [FrontendController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/remove/{id}', [FrontendController::class, 'removeCart'])->name('cart.remove');
Route::post('/cart/update/{id}', [FrontendController::class, 'updateCart'])->name('cart.update');
Route::post('/place-order', [FrontendController::class, 'placeOrder'])->name('order.place');
Route::get('/order/confirm', [FrontendController::class, 'orderConfirm'])->name('order.confirm');
Route::get('/order/success', [FrontendController::class, 'orderSuccess'])->name('order.success');
