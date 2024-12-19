<?php

namespace App\Http\Controllers\Survey;

use App\Http\Controllers\Controller;
use App\Models\Assessment;
use App\Models\Question;
use Illuminate\Http\Request;

class AssessmentController extends Controller
{
    // ฟังก์ชันสำหรับแสดงหน้า Dashboard พร้อมค้นหา
    public function index(Request $request)
    {
        // รับคำค้นหาจากผู้ใช้
        $search = $request->input('search');

        // ดึงข้อมูลแบบประเมินที่ตรงกับคำค้นหา
        $assessments = Assessment::when($search, function ($query, $search) {
            $query->where('name', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%');
        })->get();

        // ส่งข้อมูลไปยัง view
        return view('survey.index', compact('assessments', 'search'));
    }

    // ฟังก์ชันสำหรับแสดงหน้าแบบประเมินเฉพาะหัวข้อ
    public function show($id)
    {
        // ดึงข้อมูลแบบประเมินและคำถามที่เกี่ยวข้อง
        $assessment = Assessment::with('questions')->findOrFail($id);

        // ส่งข้อมูลไปยัง view
        return view('survey.show', compact('assessment'));
    }

}


