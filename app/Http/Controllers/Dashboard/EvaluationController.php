<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\EvaluationTopic;
use App\Models\Rating;
use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    /**
     * แสดงหน้าหลักของการจัดการหัวข้อและคะแนนประเมิน.
     */
    public function index()
    {
        $evaluationTopics = EvaluationTopic::all(); // ดึงหัวข้อประเมินทั้งหมด
        $ratings = Rating::with('topic')->get(); // ดึงคะแนนและหัวข้อที่เกี่ยวข้อง

        return view('dashboard.evaluation.index', compact('evaluationTopics', 'ratings'));
    }

    public function form()
    {
        // ตัวอย่าง: ดึงข้อมูลสำหรับหน้า evaluation
        $evaluationTopics = EvaluationTopic::all(); // ดึงข้อมูลจาก Model Evaluation

        // ส่งข้อมูลไปยัง View
        return view('evaluation.index', compact('evaluationTopics'));
    }

    

    /**
     * เพิ่มหัวข้อการประเมินใหม่.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        EvaluationTopic::create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('evaluations.index')->with('success', 'Evaluation topic added successfully.');
    }

    public function edit($id)
    {
        $topic = EvaluationTopic::findOrFail($id);
        return view('evaluations.edit', compact('topic'));
    }

    /**
     * อัปเดตหัวข้อการประเมิน.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $topic = EvaluationTopic::findOrFail($id);
        $topic->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('evaluations.index')->with('success', 'Evaluation topic updated successfully.');
    }

    /**
     * ลบหัวข้อการประเมิน.
     */
    public function destroy(EvaluationTopic $evaluationTopic)
    {
        $evaluationTopic->delete();

        return redirect()->route('evaluations.index')->with('success', 'Evaluation topic deleted successfully.');
    }
}
