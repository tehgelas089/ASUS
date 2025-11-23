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

        // Total income semua
        $total = Revenue::sum('income');

        $user = User::find($id);

        // Data revenue utama
        $revenues = Revenue::with('transaction')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // 🔥 Ambil pendapatan 7 hari terakhir untuk tampilan di akun
        $history7days = Revenue::selectRaw('DATE(created_at) as date, SUM(income) as total_income')
            ->where('created_at', '>=', now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->get();

        return view('pendapatan', [
            'revenues' => $revenues,
            'total' => $total,
            'title' => 'Halaman Pendapatan',
            'user' => $user,
            'history7days' => $history7days, // ⬅ ditambah
        ]);
    }

    // 🔥 Untuk modal ketika tanggal diklik
    public function detail($date)
    {
        $detail = Revenue::whereDate('created_at', $date)->get();
        return response()->json($detail);
    }
}
