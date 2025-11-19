<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $guarded  = ['id', 'timestamps'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function revenue()
    {
        return $this->hasOne(Revenue::class);
    }

    protected static function booted()
    {
        static::created(function ($transaction) {
            $income = $transaction->money_received - $transaction->change;

            \App\Models\Revenue::create([
                'transaction_id' => $transaction->id,
                'income' => $income,
            ]);
        });
    }
}
