<?php

namespace App\Http\Controllers\Survey;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HealthAssessment;
use App\Models\HypertensionHealth;
use App\Models\DiabetesHealth;
use App\Models\OralHealth;
use App\Models\EyeHealth;
use Illuminate\Support\Facades\Auth;

class HealthAssessmentController extends Controller
{
    // หน้าแสดงฟอร์มสำหรับกรอกแบบประเมิน
    public function create()
    {
        // ดึงข้อมูลผู้สูงอายุที่ผู้ดูแลล็อกอินกำลังดูแล
        $elders = Auth::user()->elderly; // ใช้ความสัมพันธ์ใน Model User
        return view('surveys.health_assessment.create', compact('elders'));
    }


    // ฟังก์ชั่นสำหรับการบันทึกผลการกรอกแบบประเมิน
    public function store(Request $request)
    {
        // การตรวจสอบข้อมูลที่ได้รับ
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id', // ID ผู้ใช้
            'recorded_by' => 'required|exists:users,id', // ID ของผู้บันทึก

            // ข้อมูลที่เกี่ยวข้องกับ HypertensionHealth
            'hypertension_status' => 'required|string',
            'sbp' => 'nullable|integer',
            'dbp' => 'nullable|integer',

            // ข้อมูลที่เกี่ยวข้องกับ DiabetesHealth
            'diabetes_status' => 'required|string',
            'fpg' => 'nullable|numeric',
            'random_glucose' => 'nullable|numeric',

            // ข้อมูลที่เกี่ยวข้องกับ OralHealth
            'brushing_frequency' => 'nullable|string',
            'brushing_other' => 'nullable|string',
            'uses_toothpaste' => 'nullable|boolean',
            'cleans_between_teeth' => 'nullable|boolean',
            'cleaning_tool' => 'nullable|string',
            'smokes_more_than_10' => 'nullable|boolean',
            'chews_areca' => 'nullable|boolean',

            // ข้อมูลที่เกี่ยวข้องกับ EyeHealth
            'has_eye_issue' => 'nullable|boolean',
            'distance_vision_issue' => 'nullable|boolean',
            'near_vision_issue' => 'nullable|boolean',
            'cataract_risk_left' => 'nullable|boolean',
            'cataract_risk_right' => 'nullable|boolean',
            'glaucoma_risk_left' => 'nullable|boolean',
            'glaucoma_risk_right' => 'nullable|boolean',
            'macular_degeneration_left' => 'nullable|boolean',
            'macular_degeneration_right' => 'nullable|boolean',
        ]);

        // บันทึกข้อมูลในตาราง HealthAssessment
        $healthAssessment = HealthAssessment::create([
            'user_id' => $request->user_id,
            'recorded_by' => Auth::id(),
        ]);

        // บันทึกข้อมูลในตาราง HypertensionHealth
        $healthAssessment->hypertensionHealth()->create([
            'status' => $request->hypertension_status,
            'sbp' => $request->sbp,
            'dbp' => $request->dbp,
        ]);

        // บันทึกข้อมูลในตาราง DiabetesHealth
        $healthAssessment->diabetesHealth()->create([
            'status' => $request->diabetes_status,
            'fpg' => $request->fpg,
            'random_glucose' => $request->random_glucose,
        ]);

        // บันทึกข้อมูลในตาราง OralHealth
        $healthAssessment->oralHealth()->create([
            'brushing_frequency' => $request->brushing_frequency,
            'brushing_other' => $request->brushing_other,
            'uses_toothpaste' => $request->uses_toothpaste,
            'cleans_between_teeth' => $request->cleans_between_teeth,
            'cleaning_tool' => $request->cleaning_tool,
            'smokes_more_than_10' => $request->smokes_more_than_10,
            'chews_areca' => $request->chews_areca,
        ]);

        // บันทึกข้อมูลในตาราง EyeHealth
        $healthAssessment->eyeHealth()->create([
            'has_eye_issue' => $request->has_eye_issue,
            'distance_vision_issue' => $request->distance_vision_issue,
            'near_vision_issue' => $request->near_vision_issue,
            'cataract_risk_left' => $request->cataract_risk_left,
            'cataract_risk_right' => $request->cataract_risk_right,
            'glaucoma_risk_left' => $request->glaucoma_risk_left,
            'glaucoma_risk_right' => $request->glaucoma_risk_right,
            'macular_degeneration_left' => $request->macular_degeneration_left,
            'macular_degeneration_right' => $request->macular_degeneration_right,
        ]);

        // คืนค่าผลลัพธ์ที่บันทึกเสร็จแล้ว
        return redirect()->route('surveys.health_assessment.index')->with('success', 'บันทึกผลการประเมินสำเร็จ');
    }

}

