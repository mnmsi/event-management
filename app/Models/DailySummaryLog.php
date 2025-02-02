<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailySummaryLog extends Model
{
    protected $fillable = ['log_date', 'total_revenue', 'total_participants'];
}
