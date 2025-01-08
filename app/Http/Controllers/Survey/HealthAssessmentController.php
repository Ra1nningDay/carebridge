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
use Illuminate\Support\Facades\Log;

class HealthAssessmentController extends Controller
{
    public function dashboard()
    {
        // ดึงข้อมูลจำนวนผู้สูงอายุที่มีความเสี่ยงจากการตรวจสุขภาพ
        $hypertensionRiskCount = HealthAssessment::whereHas('hypertensionHealth', function ($query) {
            $query->where('hypertension_status', 'treated')
                ->orWhere('hypertension_status', 'untreated');
        })->distinct('user_id') // ตรวจสอบให้แสดงแค่ครั้งแรกของ user
        ->count();

        $diabetesRiskCount = HealthAssessment::whereHas('diabetesHealth', function ($query) {
            $query->where('diabetes_status', 'treated')
                ->orWhere('diabetes_status', 'untreated');
        })->distinct('user_id') // ตรวจสอบให้แสดงแค่ครั้งแรกของ user
        ->count();

        $oralHealthRiskCount = HealthAssessment::whereHas('oralHealth', function ($query) {
            $query->where('brushing_frequency', 'not sufficient');
        })->distinct('user_id') // ตรวจสอบให้แสดงแค่ครั้งแรกของ user
        ->count();

        $eyeHealthRiskCount = HealthAssessment::whereHas('eyeHealth', function ($query) {
            $query->where('has_eye_issue', true);
        })->distinct('user_id') // ตรวจสอบให้แสดงแค่ครั้งแรกของ user
        ->count();

        return view('dashboard.risks.bgs.summary', compact(
            'hypertensionRiskCount',
            'diabetesRiskCount',
            'oralHealthRiskCount',
            'eyeHealthRiskCount'
        ));
    }


   public function showRisk($type)
{
    switch ($type) {
        case 'hypertension':
            $riskCount = HealthAssessment::whereHas('hypertensionHealth', function ($query) {
                $query->where('hypertension_status', 'treated')
                    ->orWhere('hypertension_status', 'untreated');
            })
            ->distinct('user_id')
            ->count();

            // ดึงข้อมูลการเปลี่ยนแปลงความเสี่ยงตามเดือน
            $riskStatsMonth = HealthAssessment::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, count(distinct user_id) as risk_count')
                ->whereHas('hypertensionHealth', function ($query) {
                    $query->where('hypertension_status', 'treated')
                        ->orWhere('hypertension_status', 'untreated');
                })
                ->groupBy('month')
                ->orderBy('month')
                ->get();

            // ดึงข้อมูลการเปลี่ยนแปลงความเสี่ยงตามวัน
            $riskStatsDay = HealthAssessment::selectRaw('DATE_FORMAT(created_at, "%Y-%m-%d") as day, count(distinct user_id) as risk_count')
                ->whereHas('hypertensionHealth', function ($query) {
                    $query->where('hypertension_status', 'treated')
                        ->orWhere('hypertension_status', 'untreated');
                })
                ->groupBy('day')
                ->orderBy('day')
                ->get();

            $riskDetails = HealthAssessment::whereHas('hypertensionHealth', function ($query) {
                $query->where('hypertension_status', 'treated')
                    ->orWhere('hypertension_status', 'untreated');
            })
            ->get()
            ->unique('user_id');

            break;

        case 'diabetes':
            $riskCount = HealthAssessment::whereHas('diabetesHealth', function ($query) {
                $query->where('diabetes_status', 'treated')
                    ->orWhere('diabetes_status', 'untreated');
            })
            ->distinct('user_id')
            ->count();

            // ดึงข้อมูลการเปลี่ยนแปลงความเสี่ยงตามเดือน
            $riskStatsMonth = HealthAssessment::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, count(distinct user_id) as risk_count')
                ->whereHas('diabetesHealth', function ($query) {
                    $query->where('diabetes_status', 'treated')
                        ->orWhere('diabetes_status', 'untreated');
                })
                ->groupBy('month')
                ->orderBy('month')
                ->get();

            // ดึงข้อมูลการเปลี่ยนแปลงความเสี่ยงตามวัน
            $riskStatsDay = HealthAssessment::selectRaw('DATE_FORMAT(created_at, "%Y-%m-%d") as day, count(distinct user_id) as risk_count')
                ->whereHas('diabetesHealth', function ($query) {
                    $query->where('diabetes_status', 'treated')
                        ->orWhere('diabetes_status', 'untreated');
                })
                ->groupBy('day')
                ->orderBy('day')
                ->get();

            $riskDetails = HealthAssessment::whereHas('diabetesHealth', function ($query) {
                $query->where('diabetes_status', 'treated')
                    ->orWhere('diabetes_status', 'untreated');
            })
            ->get()
            ->unique('user_id');

            break;

        case 'oralHealth':
            $riskCount = HealthAssessment::whereHas('oralHealth', function ($query) {
                $query->where('brushing_frequency', 'not sufficient');
            })
            ->count();

            // ดึงข้อมูลการเปลี่ยนแปลงความเสี่ยงตามเดือน
            $riskStatsMonth = HealthAssessment::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, count(distinct user_id) as risk_count')
                ->whereHas('oralHealth', function ($query) {
                    $query->where('brushing_frequency', 'not sufficient');
                })
                ->groupBy('month')
                ->orderBy('month')
                ->get();

            // ดึงข้อมูลการเปลี่ยนแปลงความเสี่ยงตามวัน
            $riskStatsDay = HealthAssessment::selectRaw('DATE_FORMAT(created_at, "%Y-%m-%d") as day, count(distinct user_id) as risk_count')
                ->whereHas('oralHealth', function ($query) {
                    $query->where('brushing_frequency', 'not sufficient');
                })
                ->groupBy('day')
                ->orderBy('day')
                ->get();

            $riskDetails = HealthAssessment::whereHas('oralHealth', function ($query) {
                $query->where('brushing_frequency', 'not sufficient');
            })
            ->get()
            ->unique('user_id');

            break;

        case 'eyeHealth':
            $riskCount = HealthAssessment::whereHas('eyeHealth', function ($query) {
                $query->where('has_eye_issue', true);
            })
            ->distinct('user_id')
            ->count();

            // ดึงข้อมูลการเปลี่ยนแปลงความเสี่ยงตามเดือน
            $riskStatsMonth = HealthAssessment::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, count(distinct user_id) as risk_count')
                ->whereHas('eyeHealth', function ($query) {
                    $query->where('has_eye_issue', true);
                })
                ->groupBy('month')
                ->orderBy('month')
                ->get();

            // ดึงข้อมูลการเปลี่ยนแปลงความเสี่ยงตามวัน
            $riskStatsDay = HealthAssessment::selectRaw('DATE_FORMAT(created_at, "%Y-%m-%d") as day, count(distinct user_id) as risk_count')
                ->whereHas('eyeHealth', function ($query) {
                    $query->where('has_eye_issue', true);
                })
                ->groupBy('day')
                ->orderBy('day')
                ->get();

            $riskDetails = HealthAssessment::whereHas('eyeHealth', function ($query) {
                $query->where('has_eye_issue', true);
            })
            ->get()
            ->unique('user_id');

            break;

        default:
            $riskCount = 0;
            $riskStatsMonth = collect();
            $riskStatsDay = collect();
            $riskDetails = collect();
            break;
    }

    return view('dashboard.risks.bgs.details', compact('riskCount', 'type', 'riskStatsMonth', 'riskStatsDay', 'riskDetails'));
}





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
        try {
            // การตรวจสอบข้อมูลที่ได้รับ
            $validatedData = $request->validate([
                'user_id' => 'required|exists:users,id', // ID ผู้ใช้
                'recorded_by' => 'required|exists:users,id', // ID ของผู้บันทึก

                // ข้อมูลที่เกี่ยวข้องกับ HypertensionHealth
                'sbp' => 'nullable|integer',
                'dbp' => 'nullable|integer',

                // ข้อมูลที่เกี่ยวข้องกับ DiabetesHealth
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

            // Calculate hypertension status based on SBP and DBP values
            $hypertensionStatus = 'undiagnosed'; // Default status

            if ($request->sbp >= 140 || $request->dbp >= 90) {
                $hypertensionStatus = 'untreated';
            } elseif ($request->sbp < 140 && $request->dbp < 90) {
                if ($request->hypertension_status === 'treated') {
                    $hypertensionStatus = 'treated';
                }
            }

            // Calculate diabetes status based on FPG and Random Glucose values
            $diabetesStatus = 'normal'; // Default status

            if ($request->fpg >= 126 || $request->random_glucose >= 200) {
                $diabetesStatus = 'diabetes';
            } elseif (($request->fpg >= 100 && $request->fpg < 126) || ($request->random_glucose >= 140 && $request->random_glucose < 200)) {
                $diabetesStatus = 'pre-diabetes';
            }

            // บันทึกข้อมูลในตาราง HealthAssessment
            $healthAssessment = HealthAssessment::create([
                'user_id' => $request->user_id,
                'recorded_by' => $request->recorded_by,
            ]);

            // บันทึกข้อมูลในตาราง HypertensionHealth
            $healthAssessment->hypertensionHealth()->create([
                'status' => $hypertensionStatus, // ใช้ค่าสถานะที่คำนวณ
                'sbp' => $request->sbp,
                'dbp' => $request->dbp,
            ]);

            // บันทึกข้อมูลในตาราง DiabetesHealth
            $healthAssessment->diabetesHealth()->create([
                'status' => $diabetesStatus, // ใช้ค่าสถานะที่คำนวณ
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

            // รีไดเร็กไปหน้า survey.show พร้อม user_id
            return redirect()->route('health_assessments.show', ['healthAssessment' => $healthAssessment->id])
                            ->with('success', 'บันทึกผลการประเมินสำเร็จ');
        } catch (\Exception $e) {
            Log::error('Error saving health assessment: ' . $e->getMessage(), [
                'error' => $e->getTraceAsString(),
                'request' => $request->all()
            ]);
            return back()->withErrors(['error' => 'เกิดข้อผิดพลาด: ' . $e->getMessage()]);
        }
    }

    // SurveyController.php
    public function show(HealthAssessment $healthAssessment)
    {
        try {
            // ส่งข้อมูลไปยังหน้า view
            return view('surveys.health_assessment.show', compact('healthAssessment')); // ส่ง healthAssessment ไปยัง view
        } catch (\Exception $e) {
            Log::error('Error displaying health assessment: ' . $e->getMessage());
            return back()->withErrors(['error' => 'เกิดข้อผิดพลาดในการแสดงผล']);
        }
    }
}

