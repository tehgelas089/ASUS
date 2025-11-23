<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RevenueHistory extends Model
{
    protected $fillable = ['date', 'total_income'];
}
