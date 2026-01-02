<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Insight extends Model
{
    protected $fillable = ['user_id', 'type', 'content', 'importance', 'is_read', 'metadata'];

    protected $casts = [
        'metadata' => 'array',
        'is_read' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
