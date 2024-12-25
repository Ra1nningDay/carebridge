<?php

namespace App\Http\Controllers\Carefield;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\UserPersonalInfo;
use App\Models\UserPhysical;

class PatientController extends Controller
{
    public function index()
    {
        $users = User::with(['personalInfo', 'healthChecks'])->whereHas('roles', function ($query) {
            $query->where('roles.id', 4); // role_id = 4 (patient)
        })->get();

        return view('carefield.patient.patient_list', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'citizen_id' => 'required|string|size:13|unique:users,citizen_id',  // ตรวจสอบ citizen_id ที่ยาว 13 หลักและไม่ซ้ำ
            'password' => 'required|string|min:8',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:male,female,other',
            'phone' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'medical_history' => 'nullable|string',
            'allergies' => 'nullable|string',
            'medications' => 'nullable|string',
            'weight' => 'nullable|double',
            'height' => 'nullable|double',
            'blood_type' => 'nullable|string',
        ]);

        try {
            DB::transaction(function () use ($validated) {
                // สร้างบัญชีผู้ใช้งาน
                $user = User::create([
                    'name' => $validated['name'],
                    'citizen_id' => $validated['citizen_id'],  // ใช้ citizen_id แทน email
                    'password' => Hash::make($validated['password']),
                ]);

                // บันทึกข้อมูลผู้ใช้งานส่วนบุคคล (เช่น วันเกิด, เพศ, ประวัติการแพทย์ ฯลฯ)
                UserPersonalInfo::create([
                    'user_id' => $user->id,
                    'date_of_birth' => $validated['date_of_birth'],
                    'gender' => $validated['gender'],
                    'phone' => $validated['phone'] ?? null,
                    'address' => $validated['address'] ?? null,
                    'medical_history' => $validated['medical_history'] ?? null,
                    'allergies' => $validated['allergies'] ?? null,
                    'medications' => $validated['medications'] ?? null,
                ]);

                // บันทึกข้อมูลทางกายภาพ (เช่น )
                UserPhysical::create([
                    'user_id' => $user->id,
                    'weight' => $validated['weight'] ?? null,
                    'gender' => $validated['gender'] ?? null,
                    'blood_type' => $validated['blood_type'] ?? null,
                ]);
            });

            return redirect()->route('patients.index')->with('success', 'Patient created successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }
}
