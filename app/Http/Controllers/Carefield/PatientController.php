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
        $users = User::with(['personalInfo', 'physicalInfo', 'healthChecks'])->whereHas('roles', function ($query) {
            $query->where('roles.id', 4); // role_id = 4 (patient)
        })->get();

        return view('carefield.patient.patient_list', compact('users'));
    }

    public function store(Request $request): RedirectResponse
    {
        // การตรวจสอบข้อมูลที่ได้รับจากฟอร์ม
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
            // Additional caregiver-related validation
            'caregiver_citizen_id' => ['required', 'string', 'size:13'],
            'password' => ['required', 'string', 'min:8'],
            'caregiver_date_of_birth' => ['required', 'date'],
            'caregiver_fname' => ['required', 'string', 'max:255'],
            'caregiver_lname' => ['required', 'string', 'max:255'],
            'caregiver_phone' => ['required', 'string', 'max:255'],
            'caregiver_address' => ['required', 'string', 'max:255'],
        ]);

        try {
            // สร้างผู้ใช้งานใหม่ในตาราง users
            $user = User::create([
                'name' => $request->first_name . ' ' . $request->last_name,
                'citizen_id' => $request->citizen_id,
                'password' => Hash::make($request->password),
            ]);

            // สร้างข้อมูลส่วนตัวของผู้ป่วย
            $personalInfo = UserPersonalInfo::create([
                'user_id' => $user->id,
                'firstname' => $request->first_name,
                'lastname' => $request->first_name,
                'date_of_birth' => $request->date_of_birth,
                'gender' => $request->gender,
                'phone' => $request->phone,
                'address' => $request->address,
                'medical_history' => $request->medical_history,
                'allergies' => $request->allergies,
                'medications' => $request->medications,
            ]);

            // สร้างข้อมูลทางร่างกายของผู้ป่วย
            $physicalInfo = UserPhysical::create([
                'user_id' => $user->id,
                'weight' => $request->weight,
                'height' => $request->height,
                'blood_type' => $request->blood_type,
            ]);

            // สร้างข้อมูลผู้ดูแล
            $caregiver = User::create([
                'name' => $request->caregiver_fname . ' ' . $request->caregiver_lname,
                'citizen_id' => $request->caregiver_citizen_id,
                'password' => Hash::make($request->password),
            ]);

            // เพิ่มบทบาท 'patient' ให้กับผู้ใช้
            $role = DB::table('roles')->where('name', 'patient')->first();
            if ($role) {
                $user->roles()->attach($role->id); 
            }

            // หากการลงทะเบียนสำเร็จ, เปลี่ยนเส้นทางไปยังหน้ารายชื่อผู้ป่วยพร้อมข้อความสำเร็จ
            return redirect()->back()->with('success', 'ลงทะเบียนผู้รับการตรวจสำเร็จ');
        } catch (\Exception $e) {
            // หากเกิดข้อผิดพลาดในการลงทะเบียน, บันทึกข้อผิดพลาดและแสดงข้อความข้อผิดพลาด
            \Log::error('Error creating patient: ' . $e->getMessage());
            return redirect()->back()->with('error', 'เกิดข้อผิดพลาดในการลงทะเบียน');
        }
    }

}
