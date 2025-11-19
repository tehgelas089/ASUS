<?php

namespace App\Http\Controllers;

use App\Models\Revenue;

class RevenueController extends Controller
{
    public function index()
    {
        // ✅ Ambil semua pendapatan dengan relasi transaksi dari database
        $revenues = Revenue::with('transaction')->orderBy('created_at', 'desc')->get();

        // ✅ Hitung total semua income
        $total = $revenues->sum('income');

        // ✅ Kirim data ke view
        return view('pendapatan', [
            'revenues' => $revenues,
            'total' => $total,
            'title' => 'Halaman Pendapatan'
        ]);
    }
}
