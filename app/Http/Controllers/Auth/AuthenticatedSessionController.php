<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\RedirectResponse;
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
    public function store(Request $request): RedirectResponse
    {
        // ตรวจสอบความถูกต้องของข้อมูล
        $request->validate([
            'login' => 'required|string', // รับทั้ง citizen_id หรือ email
            'password' => 'required|string',
        ]);

        // ตรวจสอบว่าเป็น email หรือ citizen_id
        $loginField = filter_var($request->input('login'), FILTER_VALIDATE_EMAIL) ? 'email' : 'citizen_id';

        // ลองทำการเข้าสู่ระบบ
        if (!Auth::attempt([$loginField => $request->input('login'), 'password' => $request->input('password')], $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'login' => trans('auth.failed'),
            ]);
        }

        // รีเฟรช session
        $request->session()->regenerate();

        // ตรวจสอบบทบาทของผู้ใช้
        if (Auth::user()->roles->contains('name', 'admin')) {
            return redirect()->intended('/dashboard'); // เส้นทาง admin
        }

        if (Auth::user()->roles->contains('name', 'authority')) {
            return redirect()->intended('/carefield.index'); // เส้นทาง authority
        }

        // ผู้ใช้ทั่วไป
        return redirect()->intended('/')->with('success', 'การเข้าสู่ระบบของคุณเสร็จสิ้น!');
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
