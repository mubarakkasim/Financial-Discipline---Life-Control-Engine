<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Traits\Auditable;

class FinancialGoal extends Model
{
    use Auditable;

    protected $fillable = ['user_id', 'title', 'target_amount', 'target_date', 'current_savings'];

    protected $casts = [
        'target_amount' => 'encrypted',
        'current_savings' => 'encrypted',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
