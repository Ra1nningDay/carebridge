<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        // ตรวจสอบบทบาทของผู้ใช้
        if (Auth::user()->roles->contains('name', 'admin')) {
            return redirect()->intended('/dashboard'); // กำหนดเส้นทาง admin
        }

        if (Auth::user()->roles->contains('name', 'authority')) {
            return redirect()->intended('/carefield.index'); // กำหนดเส้นทาง admin
        }

        // กรณีเป็นผู้ใช้ทั่วไป
        return redirect()->intended('/')->with('success', 'การเข้าสู่ระบบของคุณเสร็จสิ้น!');; // กำหนดเส้นทางของ use
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
