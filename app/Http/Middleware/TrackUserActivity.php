<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;

class TrackUserActivity
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $expiresAt = now()->addMinutes(5); // กำหนดสถานะออนไลน์ 5 นาที
            Cache::put('user-is-online-' . Auth::id(), true, $expiresAt);
        }

        return $next($request);
    }
}
