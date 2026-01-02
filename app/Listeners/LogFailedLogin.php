<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Failed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogFailedLogin
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Failed $event): void
    {
        \App\Models\SecurityLog::create([
            'user_id' => $event->user?->id,
            'event_type' => 'login_failed',
            'action' => 'Failed login attempt for email: ' . ($event->credentials['email'] ?? 'unknown'),
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'metadata' => ['credentials' => array_keys($event->credentials)]
        ]);
    }
}
