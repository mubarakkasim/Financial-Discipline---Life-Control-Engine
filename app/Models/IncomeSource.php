<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Traits\Auditable;

class IncomeSource extends Model
{
    use Auditable;

    protected $fillable = ['user_id', 'name', 'amount', 'frequency'];

    protected $casts = [
        'amount' => 'encrypted',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
