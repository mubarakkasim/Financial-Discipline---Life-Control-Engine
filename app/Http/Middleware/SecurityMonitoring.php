<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityMonitoring
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Alert on unauthorized attempts or suspicious activity
        if ($response->getStatusCode() === 403 || $response->getStatusCode() === 401) {
            \App\Models\SecurityLog::create([
                'user_id' => $request->user()?->id,
                'event_type' => 'unauthorized_access_attempt',
                'action' => 'Attempted to access ' . $request->fullUrl(),
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'metadata' => ['method' => $request->method()]
            ]);
        }

        return $response;
    }
}
