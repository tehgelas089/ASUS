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


        $yesterday = now()->subDay()->toDateString();

        $yesterdayTotal = Revenue::whereDate('created_at', $yesterday)->sum('income');

        if ($yesterdayTotal > 0) {

            \App\Models\RevenueHistory::create([
                'date' => $yesterday,
                'total_income' => $yesterdayTotal
            ]);

            Revenue::whereDate('created_at', $yesterday)->delete();
        }



        $total = Revenue::sum('income');

        $user = User::find($id);

        $revenues = Revenue::with('transaction')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

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
            'history7days' => $history7days,
        ]);
    }


    public function detail($date)
    {
        $detail = Revenue::with('transaction')
            ->whereDate('created_at', $date)
            ->get();

        return response()->json($detail);
    }
}
