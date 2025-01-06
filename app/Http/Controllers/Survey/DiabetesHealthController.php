<?php

namespace App\Http\Controllers\Survey;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DiabetesHealthController extends Controller
{
    public function index()
    {
        // แสดงฟอร์มแบบประเมินเบาหวาน
        return view('surveys.diabetes.index');
    }

    public function store(Request $request)
    {
        // ประมวลผลและบันทึกผลแบบประเมินเบาหวาน
        $validatedData = $request->validate([
            'blood_sugar' => 'required|numeric',
        ]);

        // บันทึกลงฐานข้อมูลหรือดำเนินการตาม logic
        // Example: DiabetesResult::create($validatedData);

        return redirect()->route('diabetes.survey.index')->with('success', 'บันทึกผลการประเมินสำเร็จ');
    }
}
