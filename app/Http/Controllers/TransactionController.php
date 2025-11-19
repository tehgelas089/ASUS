<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Revenue;
use App\Models\Transaction;

class TransactionController extends Controller
{
    // 🔹 Tampilkan halaman transaksi
    public function index()
    {
        $products = Product::all();
        return view('app', [
            'products' => $products,
            'title' => 'Halaman Transaksi'
        ]);
    }

    // 🔹 Simpan transaksi
    public function store(Request $request)
    {
        // Simpan transaksi ke DB
        $transaction = Transaction::create([
            'product_name' => $request->items,
            'price' => $request->total_bayar,
            'money_received' => $request->uang,
            'change' => $request->kembalian,
        ]);

        // Simpan juga ke tabel revenue
        // Revenue::create([
        //     'transaction_id' => $transaction->id,
        //     'income' => $request->total_bayar,
        // ]);

        // 🔥 Notif berhasil (ini aja yang aku tambahin)
        return redirect()->back()->with('success', 'Transaksi berhasil disimpan!');
    }
}
