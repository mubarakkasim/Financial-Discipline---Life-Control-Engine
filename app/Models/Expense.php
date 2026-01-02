<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Traits\Auditable;

class Expense extends Model
{
    use Auditable;

    protected $fillable = ['user_id', 'expense_category_id', 'amount', 'note', 'spent_at'];

    protected $casts = [
        'amount' => 'encrypted',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(ExpenseCategory::class, 'expense_category_id');
    }
}
