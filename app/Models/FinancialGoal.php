<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinancialGoal extends Model
{
    protected $fillable = ['user_id', 'title', 'target_amount', 'target_date', 'current_savings'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
