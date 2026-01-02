<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Traits\Auditable;

class SavingsVault extends Model
{
    use Auditable;

    protected $fillable = ['user_id', 'amount', 'is_locked'];

    protected $casts = [
        'amount' => 'encrypted',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
