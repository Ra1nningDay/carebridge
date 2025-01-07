@extends('layouts.app')

@section('title', 'ผลการประเมินสุขภาพ')

@section('content')
<div class="container my-5">
    <div class="text-center mb-5">
        <h1 class="fw-bold text-primary">ผลการประเมินสุขภาพของ {{ $healthAssessment->user->name }}</h1>
        <p class="fs-5 text-muted">ข้อมูลจากการประเมินสุขภาพประจำปีของคุณ</p>
    </div>

    <div class="result-card shadow-sm p-4 rounded bg-white">
        <div class="text-center mb-4">
            <h2 class="fw-bold text-primary">
                ผู้ทำการประเมิน: {{ optional($healthAssessment->recordedBy)->name ?? 'ไม่พบข้อมูล' }}
            </h2>
        </div>

        <!-- ข้อมูลสุขภาพ -->
        <div class="result-section my-4">
            <h3 class="fw-bold text-primary mb-3">ข้อมูลสุขภาพ</h3>
            <div class="alert alert-light">
                <p class="mb-2">
                    <strong>สถานะความดันโลหิต:</strong> 
                    @switch($healthAssessment->hypertensionHealth->hypertension_status)
                        @case('undiagnosed')
                            <span class="badge bg-success">ไม่มีความเสี่ยงโรคความดัน</span>
                            @break
                        @case('treated')
                            <span class="badge bg-danger">มีความเสี่ยง</span>
                            @break
                        @case('untreated')
                            <span class="badge bg-warning">เสี่ยงูง</span>
                            @break
                        @default
                            <span class="badge bg-secondary">ไม่ระบุ</span>
                    @endswitch
                </p>
                <p><strong>ความดันโลหิต (SBP / DBP):</strong> {{ $healthAssessment->hypertensionHealth->sbp }} / {{ $healthAssessment->hypertensionHealth->dbp }} mmHg</p>
            </div>
        </div>

        <!-- ข้อมูลเบาหวาน -->
        <div class="result-section my-4">
            <h3 class="fw-bold text-primary mb-3">ข้อมูลเบาหวาน</h3>
            <div class="alert alert-light">
                <p class="mb-2">
                    <strong>สถานะเบาหวาน:</strong>
                    @switch($healthAssessment->diabetesHealth->diabetes_status)
                        @case('undiagnosed')
                            <span class="badge bg-success">ไม่มีความเสี่ยงโรคเบาหวาน</span>
                            @break
                        @case('treated')
                            <span class="badge bg-danger">มีความเสี่ยง</span>
                            @break
                        @case('untreated')
                            <span class="badge bg-warning">เสี่ยงสูง</span>
                            @break
                        @default
                            <span class="badge bg-secondary">ไม่ระบุ</span>
                    @endswitch
                </p>
                <p class="mb-2"><strong>ระดับน้ำตาลในเลือด (FPG):</strong> {{ $healthAssessment->diabetesHealth->fpg }} mg/dL</p>
                <p><strong>ระดับน้ำตาลสุ่ม:</strong> {{ $healthAssessment->diabetesHealth->random_glucose }} mg/dL</p>
            </div>
        </div>

        <!-- ข้อมูลสุขภาพช่องปาก -->
        <div class="result-section my-4">
            <h3 class="fw-bold text-primary mb-3">ข้อมูลสุขภาพช่องปาก</h3>
            <div class="alert alert-light">
                <p class="mb-2"><strong>ความถี่ในการแปรงฟัน:</strong> {{ $healthAssessment->oralHealth->brushing_frequency }}</p>
                <p class="mb-2"><strong>การใช้ยาสีฟัน:</strong> {{ $healthAssessment->oralHealth->uses_toothpaste ? 'ใช่' : 'ไม่ใช่' }}</p>
                <p><strong>ทำความสะอาดระหว่างฟัน:</strong> {{ $healthAssessment->oralHealth->cleans_between_teeth ? 'ใช่' : 'ไม่ใช่' }}</p>
            </div>
        </div>

        <!-- ข้อมูลสุขภาพตา -->
        <div class="result-section my-4">
            <h3 class="fw-bold text-primary mb-3">ข้อมูลสุขภาพตา</h3>
            <div class="alert alert-light">
                <p class="mb-2"><strong>มีปัญหาสุขภาพตาหรือไม่:</strong> {{ $healthAssessment->eyeHealth->has_eye_issue ? 'มี' : 'ไม่มี' }}</p>
                <p class="mb-2"><strong>ปัญหาสายตาไกล:</strong> {{ $healthAssessment->eyeHealth->distance_vision_issue ? 'มี' : 'ไม่มี' }}</p>
                <p><strong>ปัญหาสายตามองใกล้:</strong> {{ $healthAssessment->eyeHealth->near_vision_issue ? 'มี' : 'ไม่มี' }}</p>
            </div>
        </div>

        <div class="text-center mt-5">
            <a href="{{ route('survey.index') }}" class="btn btn-primary btn-lg px-5">
                กลับไปที่รายการการประเมิน
            </a>
        </div>
    </div>
</div>
@endsection

<style>
    /* การ์ดผลลัพธ์ */
    .result-card {
        background: #f9f9f9;
        border: 1px solid #e3e3e3;
        animation: fadeIn 1s ease-out;
        max-width: 800px;
        margin: 0 auto;
    }

    /* สีข้อความ */
    .text-primary {
        color: #0d6efd !important;
    }

    /* กล่องข้อมูล */
    .alert-light {
        background: #ffffff;
        border: 1px solid #e3e3e3;
        padding: 1.5rem;
        border-radius: 8px;
        animation: slideIn 1s ease-out;
    }

    /* ปุ่ม */
    .btn-primary {
        background-color: #0d6efd;
        border-color: #0d6efd;
    }

    .btn-primary:hover {
        transform: scale(1.05);
        transition: transform 0.3s ease;
        background-color: #0b5ed7;
        border-color: #0a58ca;
    }

    /* อนิเมชัน */
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes slideIn {
        from {
            transform: translateY(-20px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    /* อนิเมชันหัวข้อ */
    h1, h2, h3 {
        animation: bounceIn 1s ease-out;
    }

    @keyframes bounceIn {
        0% {
            transform: scale(0.8);
            opacity: 0;
        }
        50% {
            transform: scale(1.1);
            opacity: 0.5;
        }
        100% {
            transform: scale(1);
            opacity: 1;
        }
    }

    .result-section {
        animation: slideIn 1s ease-out;
    }
</style>