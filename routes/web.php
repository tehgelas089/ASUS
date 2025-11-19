<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\RevenueController;
use App\Http\Controllers\LoginController; // ✅ pakai LoginController
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;



// =========================
// 🔐 SISTEM LOGIN
// =========================
Route::get('/', [LoginController::class, 'showLogin'])->name('login'); // form login

Route::post('/landing', [LoginController::class, 'loginOrRegister'])->name('login.process'); // proses login/daftar

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::get('/akun', function () {
  return app(App\Http\Controllers\ProfileController::class)->index()
    ->with('title', 'akun saya');
});

Route::post('/edit/update', [App\Http\Controllers\ProfileController::class, 'update'])
  ->name('edit.update');


// =========================
// 🔧 ROUTE ASLI KAMU (tidak diubah)
// =========================

// Halaman transaksi
Route::get('/app', [TransactionController::class, 'index'])->name('app');
// Route::post('/transaksi', [TransactionController::class, 'store'])->name('transaksi.store');

Route::get('/pendapatan', [RevenueController::class, 'index'])->name('pendapatan.index');


// Kelola produk (CRUD)
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



Route::get('/edit', function () {
  return view('edit', ['title' => 'Ubah akun ']);
});
