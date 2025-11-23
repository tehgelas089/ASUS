<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

use Illuminate\Support\Facades\Schedule;
use App\Models\Revenue;
use App\Models\RevenueHistory;

Schedule::call(function () {

    // Total pendapatan hari ini
    $totalHariIni = Revenue::whereDate('created_at', today())->sum('income');

    // Simpan ke history harian
    RevenueHistory::updateOrCreate(
        ['date' => today()],
        ['total_income' => $totalHariIni]
    );

    // Hapus data lebih dari 7 hari
    RevenueHistory::where('date', '<', today()->subDays(7))->delete();
})->dailyAt('23:59');
