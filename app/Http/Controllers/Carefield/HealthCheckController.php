<?php

namespace App\Http\Controllers\Carefield;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\HealthCheck;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\UserPersonalInfo;


class HealthCheckController extends Controller
{
    /**
     * แสดงรายการการตรวจสุขภาพทั้งหมด.
     */
    public function index()
    {
        // ดึงข้อมูลผู้ป่วยพร้อมข้อมูลการตรวจสุขภาพ
        $users = User::whereHas('roles', function ($query) {
            $query->where('roles.id', 4); // role_id = 4 (patient)
        })->with('healthChecks')->get();

        return view('carefield.patient_list', compact('users'));
    }

    /**
     * นำไปแสดงที่หน้าโปรไฟล์
     * * */
    public function show(Request $request)
    {
        $user = auth()->user();

        // Retrieve health checks for the user
        $healthChecks = $user->healthChecks()->orderBy('check_date', 'desc')->get();

        // Pass the health checks to the view
        return view('profile.healthcheck', compact('user', 'healthChecks'));
    }





    /**
     * แสดงฟอร์มบันทึกข้อมูลการตรวจสุขภาพใหม่.
     */
    public function create()
    {
        $users = User::all(); // ดึงรายชื่อผู้ป่วยทั้งหมดสำหรับเลือก
        return view('health_checks.create', compact('users'));
    }

    /**
     * เก็บข้อมูลการตรวจสุขภาพ.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id', // Ensure this user exists in the `users` table
            'check_date' => 'required|date',
            'blood_pressure_sbp' => 'nullable|integer|min:0',
            'blood_pressure_dbp' => 'nullable|integer|min:0',
            'fpg' => 'nullable|numeric|min:0',
            'fpg_risk' => 'required|boolean',
            'blood_test_results' => 'nullable|string',
            'hearing_left' => 'nullable|string|in:ได้ยิน,ไม่ได้ยิน',
            'hearing_right' => 'nullable|string|in:ได้ยิน,ไม่ได้ยิน',
            'age' => 'nullable|integer|min:0',
            'weight' => 'nullable|numeric|min:0',
            'other_results' => 'nullable|string',
        ]);

        // ผู้ตรวจเป็นอสม. (user ที่ทำการกรอกข้อมูล) สามารถใช้ Auth::user()->id หรือส่งมาเป็นค่า user_id
        $recordedById = Auth::user()->id; // ใช้ id ของผู้ที่กรอก (อสม.)

        // Insert into `health_checks`
        HealthCheck::create([
            'user_id' => $validated['user_id'], // Directly map `user_id` from `users.id`
            'check_date' => $validated['check_date'],
            'recorded_by' => $recordedById, // แทนฟิลด์นี้ด้วย user_id ของผู้ที่ทำการตรวจ
            'blood_pressure_sbp' => $validated['blood_pressure_sbp'] ?? null,
            'blood_pressure_dbp' => $validated['blood_pressure_dbp'] ?? null,
            'fpg' => $validated['fpg'] ?? null,
            'fpg_risk' => $validated['fpg_risk'],
            'blood_test_results' => $validated['blood_test_results'] ?? null,
            'hearing_left' => $validated['hearing_left'] ?? null,
            'hearing_right' => $validated['hearing_right'] ?? null,
            'age' => $validated['age'] ?? null,
            'weight' => $validated['weight'] ?? null,
            'osta_index' => $ostaIndex ?? null,
            'osteoporosis_risk' => $osteoporosisRisk ?? null,
            'other_results' => $validated['other_results'] ?? null,
        ]);

        return redirect()->route('carefield.patient')->with('success', 'บันทึกข้อมูลการตรวจสุขภาพเรียบร้อยแล้ว!');
    }


    /**
     * แสดงฟอร์มแก้ไขข้อมูลการตรวจสุขภาพ.
     */
    public function edit($id)
    {
        $healthCheck = HealthCheck::findOrFail($id);
        $users = User::all(); // ดึงรายชื่อผู้ป่วยทั้งหมด
        return view('health_checks.edit', compact('healthCheck', 'users'));
    }

    /**
     * อัปเดตข้อมูลการตรวจสุขภาพ.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'check_date' => 'required|date',
            'blood_pressure_sbp' => 'nullable|integer|min:0',
            'blood_pressure_dbp' => 'nullable|integer|min:0',
            'fpg' => 'nullable|numeric|min:0',
            'fpg_risk' => 'required|boolean',
            'blood_test_results' => 'nullable|string',
            'other_results' => 'nullable|string',
        ]);

        $healthCheck = HealthCheck::findOrFail($id);
        $healthCheck->update($validated);

        return redirect()->route('carefield.patient_list')->with('success', 'อัปเดตข้อมูลการตรวจสุขภาพเรียบร้อยแล้ว!');
    }

    /**
     * ลบข้อมูลการตรวจสุขภาพ.
     */
    public function destroy($id)
    {
        $healthCheck = HealthCheck::findOrFail($id);
        $healthCheck->delete();

        return redirect()->route('carefield.patient_list')->with('success', 'ลบข้อมูลการตรวจสุขภาพเรียบร้อยแล้ว!');
    }
}

