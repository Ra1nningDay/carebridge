<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Assessment;
use App\Models\Question;
use App\Models\SurveyAnswer;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    public function index()
    {
        $assessments = Assessment::all();
        return view('dashboard.survey.index', compact('assessments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Assessment::create($request->only('name', 'description'));

        return redirect()->route('survey.index')->with('success', 'หัวข้อแบบประเมินถูกเพิ่มเรียบร้อยแล้ว!');
    }

    public function questions($id)
    {
        $assessment = Assessment::with('questions')->findOrFail($id);
        return view('dashboard.survey.questions', compact('assessment'));
    }

    public function storeQuestion(Request $request, $id)
    {
        $request->validate([
            'question_text' => 'required|string',
            'question_type' => 'required|string|in:text,select,radio',
            'options' => 'nullable|string',
        ]);

        Question::create([
            'assessment_id' => $id,
            'question_text' => $request->question_text,
            'question_type' => $request->question_type,
            'options' => $request->options ? json_encode(explode(',', $request->options)) : null,
        ]);

        return redirect()->route('survey.index')->with('success', 'คำถามถูกเพิ่มเรียบร้อยแล้ว!');
    }

    public function updateQuestion(Request $request, $id)
    {
        $request->validate([
            'question_text' => 'required|string',
            'question_type' => 'required|string|in:text,select,radio',
            'options' => 'nullable|string',
        ]);

        $question = Question::findOrFail($id);
        $question->update([
            'question_text' => $request->input('question_text'),
            'question_type' => $request->input('question_type'),
            'options' => $request->input('options') ? json_encode(explode(',', $request->input('options'))) : null,
        ]);

        return redirect()->back()->with('success', 'แก้ไขคำถามเรียบร้อยแล้ว!');
    }


    public function destroyQuestion($id)
    {
        $question = Question::findOrFail($id);
        $question->delete();

        return redirect()->route('survey.index')->with('success', 'คำถามถูกลบเรียบร้อยแล้ว!');
    }

    public function submit(Request $request, $id)
    {
        $assessment = Assessment::with('questions')->findOrFail($id);

        // ดึงคำตอบจากผู้ใช้
        $answers = $request->input('answers');

        // ตรวจสอบว่ามีคำตอบจากผู้ใช้หรือไม่
        if (!$answers || empty($answers)) {
            return back()->with('error', 'กรุณาตอบคำถามทุกข้อ');
        }

        // คำนวณคะแนนรวม
        $totalScore = array_sum($answers);

        // ประมวลผลผลลัพธ์ตามคะแนน
        $result = $this->calculateResult($assessment->name, $totalScore);

        // บันทึกคำตอบของผู้ใช้ลงในฐานข้อมูล
        foreach ($answers as $questionId => $answer) {
            // ตรวจสอบว่า questionId และ answer มีค่าก่อนบันทึก
            if (!is_null($questionId) && !is_null($answer)) {
                SurveyAnswer::create([
                    'user_id' => auth()->id(),
                    'assessment_id' => $id,
                    'question_id' => $questionId,
                    'answer' => $answer, // บันทึกคำตอบของคำถาม
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // ส่งผลลัพธ์ไปยังหน้าผลลัพธ์
        return view('survey.result', compact('assessment', 'totalScore', 'result'));
    }

    private function calculateResult($assessmentName, $totalScore)
    {
        if ($assessmentName === 'แบบประเมินโรคซึมเศร้า (9Q)') {
            if ($totalScore < 7) {
                return 'ไม่มีอาการของโรคซึมเศร้าหรือมีอาการโรคซึมเศร้าระดับน้อยมาก';
            } elseif ($totalScore >= 7 && $totalScore <= 12) {
                return 'ไม่มีอาการของโรคซึมเศร้าหรือมีอาการโรคซึมเศร้าระดับน้อยมาก';
            } elseif ($totalScore >= 13 && $totalScore <= 18) {
                return 'ไม่มีอาการของโรคซึมเศร้าหรือมีอาการโรคซึมเศร้าระดับน้อยมาก';
            } elseif ($totalScore >= 19) {
                return 'ไม่มีอาการของโรคซึมเศร้าหรือมีอาการโรคซึมเศร้าระดับน้อยมาก';
            }
        }

        // เพิ่มการคำนวณสำหรับแบบประเมินอื่นได้ที่นี่
        return 'ไม่สามารถประมวลผลได้';
    }





    
}

