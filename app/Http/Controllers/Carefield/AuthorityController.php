<?php

namespace App\Http\Controllers\Carefield;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\HealthCheck;

class AuthorityController extends Controller
{
    // // หน้าหลัก
    // public function index()
    // {
    //     // $patients = Patient::with('healthChecks')->get();
    //     return view('carefield.index');
    // }

    // ลงทะเบียนผู้สูงอายุ
    public function registerPatient(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer',
            'gender' => 'required|string',
            'address' => 'required|string|max:500',
        ]);

        Patient::create($validated);

        return redirect()->route('carefield.index')->with('success', 'ลงทะเบียนผู้สูงอายุสำเร็จ!');
    }

    // ดูข้อมูลการตรวจสุขภาพ
    // public function viewHealthCheck($id)
    // {
    //     $patient = Patient::with('healthChecks')->findOrFail($id);
    //     return view('carefield.health-check', compact('patient'));
    // }

    // อัปเดตสถานะผู้สูงอายุ
    // public function updatePatientStatus(Request $request)
    // {
    //     $patient = Patient::find($request->id);
    //     if ($patient) {
    //         $patient->status = $request->status;
    //         $patient->save();

    //         return redirect()->route('carefield.index')->with('success', 'อัปเดตสถานะสำเร็จ!');
    //     }

    //     return redirect()->route('carefield.index')->with('error', 'ไม่พบข้อมูลผู้สูงอายุ!');
    // }
}
