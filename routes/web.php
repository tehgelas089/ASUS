<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\RevenueController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/', [LoginController::class, 'showLogin'])->name('login');

Route::post('/landing', [LoginController::class, 'loginOrRegister'])->name('login.process');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::get('/akun', [ProfileController::class, 'akun'])->name('akun');


Route::middleware(['auth'])->group(function () {
  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});



Route::get('/app', [TransactionController::class, 'index'])->name('app');
// Route::post('/transaksi', [TransactionController::class, 'store'])->name('transaksi.store');

Route::get('/pendapatan', [RevenueController::class, 'index'])->name('pendapatan.index');


Route::get('/kelola', [ProductController::class, 'index'])->name('product.index');
Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');
Route::post('/product/update/{product}', [ProductController::class, 'update'])->name('product.update');
Route::delete('/product/delete/{product}', [ProductController::class, 'destroy'])->name('product.delete');
Route::get('/landing', [ProductController::class, 'showLanding'])->name('landing');

Route::get('/test', function () {
  return view('test', ['title' => 'testing']);
});

// Route::post('/transaksi/store', [TransactionController::class, 'storeJs'])->name('transaksi.store.js');
Route::post('/transaksi/store', [TransactionController::class, 'store'])
  ->name('transaksi.store');

Route::get('/pendapatan-detail/{date}', [RevenueController::class, 'detail']);

Route::get('/edit', [ProfileController::class, 'edit'])->name('edit.page');
