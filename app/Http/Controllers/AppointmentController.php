<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ZoomController;

class AppointmentController extends Controller
{
    // แสดงรายการนัด
   public function index()
    {
        $user = Auth::user(); // ดึงข้อมูลผู้ใช้ที่ล็อกอิน

        // อัปเดตสถานะนัดหมายที่หมดอายุ
        Appointment::where('status', 'confirmed')
            ->where('scheduled_at', '<', now()->subMinutes(40))
            ->update(['status' => 'expired']);

        // ดึงเฉพาะนัดหมายที่ยังไม่หมดอายุหรือไม่ถูกยกเลิก
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
        ->whereNotIn('status', ['expired', 'canceled']) // ซ่อนนัดหมายที่หมดอายุหรือถูกยกเลิก
        ->orderBy('scheduled_at', 'asc')
        ->get();

        $expiredAppointments = Appointment::where(function ($query) use ($user) {
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
        ->where('status', 'expired') // ซ่อนนัดหมายที่หมดอายุหรือถูกยกเลิก
        ->orderBy('scheduled_at', 'desc')
        ->get();



        return view('appointments.index', compact('appointments', 'expiredAppointments'));
    }


    public function create(Request $request)
    {
        // ดึงค่า elderly_id จาก URL
        $elderly_id = $request->query('elderly_id');
        
        // ค้นหาผู้สูงอายุที่ตรงกับ ID ที่ได้รับ
        $elderly = User::whereHas('roles', function($query) {
            $query->where('name', 'patient'); // ค้นหาเฉพาะบทบาทผู้สูงอายุ
        })->findOrFail($elderly_id);

        // ค้นหาผู้ดูแลที่เชื่อมโยงกับผู้สูงอายุในตาราง elderly_caregiver
        $caregiver = $elderly->caregiver()->first();  // หาผู้ดูแลของผู้สูงอายุที่ตรง

        // ดึงข้อมูลผู้ดูแลทั้งหมด
        $caregivers = User::whereHas('roles', function($query) {
            $query->where('name', 'caregiver');
        })->get();

        // ดึงข้อมูลหมอทั้งหมด
        $doctors = User::whereHas('roles', function($query) {
            $query->where('name', 'admin');
        })->get();

        // ส่งค่าทั้งหมดไปที่ view
        return view('appointments.create', compact('elderly', 'caregiver', 'caregivers', 'doctors', 'elderly_id'));
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

    public function update(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);

        // ตรวจสอบว่าเป็นผู้ดูแลของนัดหมาย
        if (!auth()->user()->roles->contains('name', 'caregiver') || $appointment->caregiver_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        // อัปเดตสถานะการนัดหมาย
        $appointment->update([
            'status' => $request->input('status'),
        ]);

        // หากสถานะเป็น "confirmed" และยังไม่มี Zoom Link
        if ($request->input('status') === 'confirmed' && !$appointment->zoom_link) {
            try {
                // เรียกใช้ ZoomController เพื่อสร้างห้องประชุม
                $zoomController = new ZoomController();
                $zoomController->createMeetingAndSaveLink($appointment->id);
            } catch (\Exception $e) {
                return redirect()->route('appointments.index')
                    ->with('error', 'ไม่สามารถสร้างห้องประชุม Zoom ได้: ' . $e->getMessage());
            }
        }

        return redirect()->route('appointments.index')->with('success', 'Appointment status updated successfully!');
    }

    // อัปเดตสถานะนัดหมายที่หมดอายุ
    public function updateExpiredAppointments()
    {
        Appointment::where('status', 'confirmed')
            ->where('scheduled_at', '<', Carbon::now()->subMinutes(40)) // เลย 40 นาที
            ->update([
                'status' => 'expired',
                'expired_at' => Carbon::now()
            ]);
    }
}
