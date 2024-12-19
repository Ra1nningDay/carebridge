<?php

namespace App\Http\Controllers\Carefield\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\HealthCheck;

class CareFieldDashboardController extends Controller
{
    /**
     * แสดงผลหน้าดashboard.
     */
    public function index()
    {
        $totalPatients = User::whereHas('roles', function ($query) {
            $query->where('roles.id', 4); // role_id = 4 (patient)
        })->count();

        $totalHealthChecks = HealthCheck::count();

        $malePatients = User::whereHas('roles', function ($query) {
            $query->where('roles.id', 4); // role_id = 4 (patient)
        })->whereHas('personalInfo', function ($query) {
            $query->where('gender', 'male');
        })->count();

        $femalePatients = User::whereHas('roles', function ($query) {
            $query->where('roles.id', 4); // role_id = 4 (patient)
        })->whereHas('personalInfo', function ($query) {
            $query->where('gender', 'female');
        })->count();

        $recentActivities = [
            ['message' => 'เพิ่มผู้ป่วยใหม่', 'time' => '1 ชั่วโมงที่ผ่านมา'],
            ['message' => 'บันทึกการตรวจสุขภาพ', 'time' => '2 ชั่วโมงที่ผ่านมา'],
            ['message' => 'อัปเดตข้อมูลผู้ป่วย', 'time' => 'เมื่อวาน'],
        ];

        return view('carefield.index', compact('totalPatients', 'totalHealthChecks', 'malePatients', 'femalePatients', 'recentActivities'));

    }
}
