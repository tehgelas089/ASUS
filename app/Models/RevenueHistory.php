<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RevenueHistory extends Model
{
    protected $fillable = ['date', 'total_income'];

    // 🔥 Tambahkan relasi tanpa mengubah apapun yg sudah ada
    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
