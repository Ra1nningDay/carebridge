<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * แสดงหน้าฟอร์มลงทะเบียนผู้ใช้งานใหม่
     */
    public function create(): View
    {
        return view('auth.register'); // แสดงหน้าลงทะเบียนผู้ใช้งาน
    }

    /**
     * จัดการคำขอลงทะเบียนผู้ใช้งานใหม่
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // การตรวจสอบข้อมูลที่ได้รับจากฟอร์ม
        $request->validate([
            'name' => ['required', 'string', 'max:255'], // ชื่อผู้ใช้งานต้องกรอกและมีความยาวไม่เกิน 255 ตัวอักษร
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class], // อีเมลต้องกรอกและไม่ซ้ำกับผู้ใช้งานที่มีอยู่
            'password' => ['required', 'confirmed', Rules\Password::defaults()], // รหัสผ่านต้องกรอกและต้องยืนยันรหัสผ่านให้ตรง
        ]);

        // สร้างผู้ใช้งานใหม่ในตาราง users
        $user = User::create([
            'name' => $request->name, // ชื่อผู้ใช้งาน
            'email' => $request->email, // อีเมล
            'password' => Hash::make($request->password), // รหัสผ่านที่เข้ารหัส
        ]);

        // กำหนด Role ให้ผู้ใช้งาน (ใช้ role_id ที่เหมาะสม เช่น 2 สำหรับ 'user')
        $defaultRoleId = 2; // เปลี่ยนค่าตามที่เหมาะสม เช่น 2 คือผู้ใช้งานทั่วไป
        $user->roles()->attach($defaultRoleId); // ผูกผู้ใช้งานกับ Role ที่กำหนด

        // ทำการเรียกใช้งาน event 'Registered' หลังจากผู้ใช้งานลงทะเบียนเสร็จ
        event(new Registered($user));

        // ทำการล็อกอินผู้ใช้งานที่ลงทะเบียนเสร็จแล้ว
        Auth::login($user);

        // เปลี่ยนเส้นทางไปยังหน้า welcome หลังจากลงทะเบียนและล็อกอินสำเร็จ
        return redirect(route('welcome', absolute: false)); // เปลี่ยนเส้นทางไปยังหน้า 'welcome'
    }
}
