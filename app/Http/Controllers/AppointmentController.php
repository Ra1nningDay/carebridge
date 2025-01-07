<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    // แสดงรายการนัด
    public function index()
    {
        $user = Auth::user(); // ดึงข้อมูลผู้ใช้ที่ล็อกอิน

        $appointments = Appointment::where(function ($query) use ($user) {
            if ($user->roles->contains('name', 'caregiver')) {
                $query->where('caregiver_id', $user->id);
            }
            if ($user->roles->contains('name', 'patient')) {
                $query->where('elderly_id', $user->id);
            }
            if ($user->roles->contains('name', 'admin')) {
                $query->where('doctor_id', $user->id);
            }
        })
        ->orderBy('scheduled_at', 'asc')
        ->get();

        return view('appointments.index', compact('appointments'));
    }

    public function create(Request $request)
    {
        // ดึงค่า elderly_id จาก URL
        $elderly_id = $request->query('elderly_id');

        // ค้นหาผู้สูงอายุที่ตรงกับ ID ที่ได้รับ
        $elderly = User::whereHas('roles', function($query) {
            $query->where('name', 'patient'); // ค้นหาเฉพาะบทบาทผู้สูงอายุ
        })->findOrFail($elderly_id);

        // ดึงข้อมูลผู้ดูแลทั้งหมด
        $caregivers = User::whereHas('roles', function($query) {
            $query->where('name', 'caregiver');
        })->get();

        // ดึงข้อมูลหมอทั้งหมด
        $doctors = User::whereHas('roles', function($query) {
            $query->where('name', 'admin');
        })->get();

        // ส่งค่าทั้งหมดไปที่ view
        return view('appointments.create', compact('elderly', 'caregivers', 'doctors', 'elderly_id'));
    }

    public function show($id)
    {
        // ดึงข้อมูล Appointment จากฐานข้อมูลพร้อมข้อมูลที่เกี่ยวข้อง
        $appointment = Appointment::with(['elderly', 'caregiver', 'doctor'])->findOrFail($id);

        // ส่งข้อมูลไปที่ View
        return view('appointments.show', compact('appointment'));
    }


    public function store(Request $request)
    {
        try {
            // ตรวจสอบการส่งข้อมูลจากผู้ใช้
            $request->validate([
                'elderly_id' => 'required|exists:users,id',
                'caregiver_id' => 'required|exists:users,id',
                'doctor_id' => 'required|exists:users,id',
                'scheduled_at_date' => 'required|date',
                'scheduled_at_time' => 'required|string',
                'notes' => 'nullable|string',
            ]);

            // รวมวันที่และเวลาเข้าด้วยกัน
            $scheduledAt = $request->scheduled_at_date . ' ' . $request->scheduled_at_time;

            // สร้างบันทึกการนัดหมายใหม่
            $appointment = Appointment::create([
                'elderly_id' => $request->elderly_id,
                'caregiver_id' => $request->caregiver_id,
                'doctor_id' => $request->doctor_id,
                'scheduled_at' => $scheduledAt,
                'notes' => $request->notes,
            ]);

            // บันทึก Log สำหรับการสร้างนัดหมาย
            Log::info('Appointment created successfully', [
                'elderly_id' => $request->elderly_id,
                'caregiver_id' => $request->caregiver_id,
                'doctor_id' => $request->doctor_id,
                'scheduled_at' => $scheduledAt,
            ]);

            // รีไดเรคไปที่หน้าแสดงรายละเอียดการนัดหมายที่เพิ่งสร้าง
            return redirect()->route('appointments.show', ['appointment' => $appointment->id])
                            ->with('success', 'Appointment created successfully!');
        } catch (\Exception $e) {
            // หากเกิดข้อผิดพลาดในขณะที่บันทึกข้อมูล ให้บันทึกข้อผิดพลาดใน Log
            Log::error('Failed to create appointment', [
                'error' => $e->getMessage(),
                'request_data' => $request->all(),
            ]);
            
            // รีไดเรคกลับไปที่หน้ารายการนัดหมายพร้อมแสดงข้อความผิดพลาด
            return redirect()->route('appointments.index')->with('error', 'Failed to create appointment.');
        }
    }

}
