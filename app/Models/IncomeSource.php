<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IncomeSource extends Model
{
    protected $fillable = ['user_id', 'name', 'amount', 'frequency'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
