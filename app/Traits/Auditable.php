<?php

namespace App\Traits;

use App\Models\SecurityLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

trait Auditable
{
    public static function bootAuditable()
    {
        static::updated(function ($model) {
            self::logSecurityEvent($model, 'sensitive_data_change', 'Updated record in ' . class_basename($model));
        });

        static::created(function ($model) {
            self::logSecurityEvent($model, 'data_creation', 'Created record in ' . class_basename($model));
        });

        static::deleted(function ($model) {
            self::logSecurityEvent($model, 'data_deletion', 'Deleted record from ' . class_basename($model));
        });
    }

    protected static function logSecurityEvent($model, $type, $action)
    {
        SecurityLog::create([
            'user_id' => Auth::id(),
            'event_type' => $type,
            'action' => $action,
            'ip_address' => Request::ip(),
            'user_agent' => Request::userAgent(),
            'metadata' => [
                'model' => get_class($model),
                'model_id' => $model->id,
                'changes' => $model->getChanges(),
            ]
        ]);
    }
}
