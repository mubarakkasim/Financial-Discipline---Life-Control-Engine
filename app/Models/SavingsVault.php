<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SavingsVault extends Model
{
    protected $fillable = ['user_id', 'amount', 'is_locked'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
