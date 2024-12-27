<?php

namespace App\Http\Controllers\Carefield;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\UserPersonalInfo;
use App\Models\UserPhysical;
use Illuminate\Http\RedirectResponse; // เพิ่มการใช้ RedirectResponse ที่นี่

class PatientController extends Controller
{
    public function index()
    {
        $users = User::with(['personalInfo', 'physicalInfo', 'healthChecks', 'caregiver'])->whereHas('roles', function ($query) {
            $query->where('roles.id', 4); // role_id = 4 (patient)
        })->get();

        return view('carefield.patient.patient_list', compact('users'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'citizen_id' => ['required', 'string', 'size:13', 'unique:users,citizen_id'],
            'password' => ['required', 'string', 'min:8'],
            'date_of_birth' => ['required', 'date'],
            'gender' => ['required', 'in:male,female,other'],
            'phone' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
            'medical_history' => ['nullable', 'string'],
            'allergies' => ['nullable', 'string'],
            'medications' => ['nullable', 'string'],
            'weight' => ['nullable', 'numeric'],
            'height' => ['nullable', 'numeric'],
            'blood_type' => ['nullable', 'string'],
            // Caregiver Validation
            'caregiver_citizen_id' => ['required', 'string', 'size:13', 'unique:users,citizen_id'],
            'caregiver_password' => ['required', 'string', 'min:8'],
            'caregiver_date_of_birth' => ['required', 'date'],
            'caregiver_fname' => ['required', 'string', 'max:255'],
            'caregiver_lname' => ['required', 'string', 'max:255'],
            'caregiver_phone' => ['required', 'string', 'max:255'],
            'caregiver_address' => ['required', 'string', 'max:255'],
        ]);

        try {
            // สร้างผู้ใช้งานสำหรับ "ผู้สูงอายุ"
            $elder = User::create([
                'name' => $request->first_name . ' ' . $request->last_name,
                'citizen_id' => $request->citizen_id,
                'password' => Hash::make($request->password),
            ]);

            // เพิ่มข้อมูลรายละเอียด "ผู้สูงอายุ"
            UserPersonalInfo::create([
                'user_id' => $elder->id,
                'firstname' => $request->first_name,
                'lastname' => $request->last_name,
                'date_of_birth' => $request->date_of_birth,
                'gender' => $request->gender,
                'phone' => $request->phone,
                'address' => $request->address,
                'medical_history' => $request->medical_history,
                'allergies' => $request->allergies,
                'medications' => $request->medications,
            ]);

            UserPhysical::create([
                'user_id' => $elder->id,
                'weight' => $request->weight,
                'height' => $request->height,
                'blood_type' => $request->blood_type,
            ]);

            // กำหนดบทบาทสำหรับ "ผู้สูงอายุ"
            $elderRole = DB::table('roles')->where('name', 'patient')->first();
            if ($elderRole) {
                $elder->roles()->attach($elderRole->id);
            }

            // สร้างผู้ใช้งานสำหรับ "ผู้ดูแล"
            $caregiver = User::create([
                'name' => $request->caregiver_fname . ' ' . $request->caregiver_lname,
                'citizen_id' => $request->caregiver_citizen_id,
                'password' => Hash::make($request->caregiver_password),
            ]);

            // เพิ่มข้อมูลรายละเอียด "ผู้ดูแล"
            UserPersonalInfo::create([
                'user_id' => $caregiver->id,
                'firstname' => $request->caregiver_fname,
                'lastname' => $request->caregiver_lname,
                'date_of_birth' => $request->caregiver_date_of_birth,
                'phone' => $request->caregiver_phone,
                'address' => $request->caregiver_address,
            ]);

            UserPhysical::create([
                'user_id' => $caregiver->id,
                'weight' => $request->weight ?? null,  // ถ้าไม่มีก็ให้เป็น null
                'height' => $request->height ?? null,
                'blood_type' => $request->blood_type ?? null,
            ]);


            // กำหนดบทบาทสำหรับ "ผู้ดูแล"
            $caregiverRole = DB::table('roles')->where('name', 'caregiver')->first();
            if ($caregiverRole) {
                $caregiver->roles()->attach($caregiverRole->id);
            }

            $elder->caregivers()->attach($caregiver->id, ['created_at' => now(), 'updated_at' => now()]);

            return redirect()->back()->with('success', 'ลงทะเบียนผู้รับการตรวจสำเร็จ');
        } catch (\Exception $e) {
            \Log::error('Error creating user: ' . $e->getMessage());
            return redirect()->back()->with('error', 'เกิดข้อผิดพลาดในการลงทะเบียน');
        }
    }

}
