<?php

namespace App\Http\Controllers\Survey;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PM25Assessment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PM25AssessmentController extends Controller
{
    public function create()
    {
        $elders = Auth::user()->elderly; // ผู้สูงอายุที่ผู้ดูแลรับผิดชอบ
        return view('surveys.pm25.', compact('elders'));
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'user_id' => 'required|exists:users,id',
                'recorded_by' => 'required|exists:users,id',
                'question1' => 'required|string',
                'question2' => 'nullable|array',
                'question3' => 'nullable|array',
                'question4' => 'required|string',
            ]);

            // คำนวณความเสี่ยง
            $score = 0;

            $score += match ($validatedData['question1']) {
                'ไม่เคย' => 0,
                'บางครั้ง' => 1,
                'บ่อยครั้ง' => 2,
                'เกือบทุกวัน' => 3,
                default => 0,
            };

            if (!empty($validatedData['question2'])) {
                $score += count($validatedData['question2']) * 2;
            }

            if (!empty($validatedData['question3'])) {
                $score += count($validatedData['question3']);
            }

            $score += match ($validatedData['question4']) {
                'สวมทุกครั้ง' => 0,
                'สวมบางครั้ง' => 2,
                'ไม่สวมเลย' => 3,
                default => 0,
            };

            $riskLevel = match (true) {
                $score <= 5 => 'ความเสี่ยงต่ำ',
                $score <= 10 => 'ความเสี่ยงปานกลาง',
                default => 'ความเสี่ยงสูง',
            };

            // บันทึกข้อมูล
            $assessment = PM25Assessment::create(array_merge($validatedData, ['risk_level' => $riskLevel]));

            return redirect()->route('pm25.show', ['assessment' => $assessment->id])
                             ->with('success', 'บันทึกผลการประเมินสำเร็จ');
        } catch (\Exception $e) {
            Log::error('Error saving PM 2.5 assessment: ' . $e->getMessage());
            return back()->withErrors(['error' => 'เกิดข้อผิดพลาด: ' . $e->getMessage()]);
        }
    }

    public function show(PM25Assessment $assessment)
    {
        return view('surveys.pm25.show', compact('assessment'));
    }
}
