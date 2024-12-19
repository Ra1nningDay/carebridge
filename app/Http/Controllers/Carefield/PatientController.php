<?php

namespace App\Http\Controllers\Carefield;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\UserPersonalInfo;

class PatientController extends Controller
{
    public function index()
    {
        $users = User::with(['personalInfo', 'healthChecks'])->whereHas('roles', function ($query) {
            $query->where('roles.id', 4); // role_id = 4 (patient)
        })->get();

        return view('carefield.patient_list', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:male,female,other',
            'phone' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'medical_history' => 'nullable|string',
            'allergies' => 'nullable|string',
            'medications' => 'nullable|string',
        ]);

        try {
            DB::transaction(function () use ($validated) {
                // สร้างบัญชีผู้ใช้งาน
                $user = User::create([
                    'name' => $validated['name'],
                    'email' => $validated['email'],
                    'password' => Hash::make($validated['password']),
                ]);

                // บันทึกข้อมูลส่วนตัว
                UserPersonalInfo::create([
                    'user_id' => $user->id,
                    'date_of_birth' => $validated['date_of_birth'],
                    'gender' => $validated['gender'],
                    'phone' => $validated['phone'],
                    'address' => $validated['address'],
                    'medical_history' => $validated['medical_history'],
                    'allergies' => $validated['allergies'],
                    'medications' => $validated['medications'],
                ]);

                // เพิ่มบทบาท
                $roleId = DB::table('roles')->where('name', 'patient')->value('id');
                DB::table('role_user')->insert([
                    'user_id' => $user->id,
                    'role_id' => $roleId,
                ]);
            });

            return redirect()->back()->with('success', 'ลงทะเบียนผู้ป่วยและสร้างบัญชีสำเร็จ!');
        } catch (\Exception $e) {
            Log::error('Error during patient registration: ' . $e->getMessage());
            return redirect()->back()->with('error', 'เกิดข้อผิดพลาด: ' . $e->getMessage());
        }
    }


}
