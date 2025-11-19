<?php

namespace App\Http\Controllers;

use App\Models\Revenue;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RevenueController extends Controller
{
    public function index()
    {
        $id = session('user_id');
        // 🔥 Hitung total income (lebih efisien)
        $total = Revenue::sum('income');
        $user = User::find($id);

        // 🔥 Ambil data untuk tampilan dengan pagination (10 per halaman)
        $revenues = Revenue::with('transaction')
            ->orderBy('created_at', 'desc')
            ->paginate(10); // ⬅ Pagination diterapkan di sini

        // 🔥 Kirim data ke view
        return view('pendapatan', [
            'revenues' => $revenues,
            'total' => $total,
            'title' => 'Halaman Pendapatan',
            'user' => $user
        ]);
    }
}
