<?php

// app/Http/Controllers/DashboardController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Caregiver;
use App\Models\Visit;
use App\Models\Comment;

class DashboardController extends Controller
{
    public function index()
    {
        // ดึงข้อมูลจำนวนทั้งหมดจากฐานข้อมูล
        $postCount = Post::count(); // จำนวนกระทู้
        $userCount = User::count(); // จำนวนผู้ใช้งาน
        $caregiverCount = Caregiver::count(); // จำนวนผู้ดูแล
        $visitCount = Visit::count(); // จำนวนการเข้าชม
        $commentCount = Comment::count(); // จำนวนการคอมเมนต์

        // ข้อมูลผู้ใช้งานในแต่ละเดือน
        $monthlyUserStats = User::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
                                ->groupBy('month')
                                ->orderBy('month')
                                ->pluck('count', 'month');

        // ข้อมูลผู้ใช้งานในแต่ละวัน
        $dailyUserStats = User::selectRaw('DATE(created_at) as date, COUNT(*) as count')
                            ->groupBy('date')
                            ->orderBy('date')
                            ->pluck('count', 'date');

        // ข้อมูลผู้ใช้งานในแต่ละปี
        $yearlyUserStats = User::selectRaw('YEAR(created_at) as year, COUNT(*) as count')
                            ->groupBy('year')
                            ->orderBy('year')
                            ->pluck('count', 'year');

        // สร้างอาร์เรย์ 12 เดือนเริ่มต้นด้วยค่า 0
        $monthlyStatsWithZeros = array_fill(1, 12, 0);
        $dailyStatsWithZeros = array_fill(1, 31, 0); // เริ่มต้นวันแรกจากวันที่ 1 ถึง 31
        $yearlyStatsWithZeros = array_fill(2020, date('Y') - 2020 + 1, 0); // เริ่มต้นตั้งแต่ปี 2020

        // เติมค่าจาก $monthlyUserStats ลงใน $monthlyStatsWithZeros
        foreach ($monthlyUserStats as $month => $count) {
            $monthlyStatsWithZeros[$month] = $count;
        }

        // เติมค่าจาก $dailyUserStats ลงใน $dailyStatsWithZeros
        foreach ($dailyUserStats as $date => $count) {
            $dailyStatsWithZeros[date('d', strtotime($date))] = $count;
        }

        // เติมค่าจาก $yearlyUserStats ลงใน $yearlyStatsWithZeros
        foreach ($yearlyUserStats as $year => $count) {
            $yearlyStatsWithZeros[$year] = $count;
        }

        // ส่งข้อมูลทั้งหมดไปยัง View
        return view('dashboard.dashboard', compact(
            'postCount', 
            'userCount', 
            'caregiverCount', 
            'visitCount', 
            'commentCount', 
            'monthlyStatsWithZeros', 
            'dailyStatsWithZeros',
            'yearlyStatsWithZeros'
        ));
    }


    // public function map() {
    //     return view('dashboard.risks.map'); // เพิ่มเนื้อหาแผนที่ใน view นี้
    // }

    // public function kpis() {
    //     return view('dashboard.risks.kpis'); // เน้นการแสดงตัวบ่งชี้ความเสี่ยง
    // }

    // public function alerts() {
    //     return view('dashboard.risks.alerts'); // แสดงแจ้งเตือนความเสี่ยง
    // }

}


