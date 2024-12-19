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

        // สร้างอาร์เรย์ 12 เดือนเริ่มต้นด้วยค่า 0
        $monthlyStatsWithZeros = array_fill(1, 12, 0);

        // เติมค่าจาก $monthlyUserStats ลงใน $monthlyStatsWithZeros
        foreach ($monthlyUserStats as $month => $count) {
            $monthlyStatsWithZeros[$month] = $count;
        }

        

        // ตรวจสอบผลลัพธ์
        // dd($monthlyStatsWithZeros);

        // ส่งตัวแปรทั้งหมดไปยัง View
        return view('dashboard.dashboard', compact(
            'postCount', 
            'userCount', 
            'caregiverCount', 
            'visitCount', 
            'commentCount', 
            'monthlyStatsWithZeros'
        ));
    }

}


