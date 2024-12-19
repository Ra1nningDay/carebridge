<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Log;

class AdminOnly
{
    public function handle(Request $request, Closure $next)
    {
        // เพิ่ม log เพื่อตรวจสอบการทำงานของ Middleware
        Log::info('AdminOnly middleware called.');

        // ตรวจสอบว่าผู้ใช้มี role เป็น 'admin' หรือ 'authority'
        if (Auth::check() && Auth::user()->roles->pluck('name')->contains(function ($role) {
            return in_array($role, ['admin', 'authority']);
        })) {
            return $next($request); // อนุญาตให้ผ่าน
        }

        // Redirect ไปหน้า Welcome หากไม่มีสิทธิ์
        return redirect()->route('welcome');
    }
}
