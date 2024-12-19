@extends('layouts.app')

@section('title', 'ผลการประเมินสุขภาพ')

@section('content')
<div class="container my-5">
    <div class="text-center mb-5">
        <h1 class="fw-bold text-primary">ผลการประเมินสุขภาพ</h1>
        <p class="fs-5 text-muted">สรุปผลการประเมินของคุณ</p>
    </div>

    <div class="result-card shadow-sm p-4 rounded bg-white">
        <div class="text-center mb-4">
            <h2 class="fw-bold {{ $totalScore >= 13 ? 'text-danger' : 'text-success' }}">
                {{ $assessment->name }}
            </h2>
            <p class="fs-5 text-muted">{{ $assessment->description }}</p>
        </div>

        <div class="result-summary my-4 text-center">
            <h3 class="fw-bold {{ $totalScore >= 13 ? 'text-danger' : 'text-success' }}">
                ผลลัพธ์ของคุณ: {{ $result }}
            </h3>
            <p class="fs-5 text-muted">
                คะแนนรวมที่ได้: <span class="fw-bold">{{ $totalScore }}</span> คะแนน
            </p>
        </div>

        @if($totalScore >= 13)
        <!-- หากผลลัพธ์เสี่ยง -->
        <div class="alert alert-danger text-center">
            <h5 class="fw-bold">คำแนะนำ:</h5>
            <p>คุณอาจมีความเสี่ยงในเรื่องสุขภาพ โปรดพิจารณาเข้ารับคำปรึกษาจากแพทย์หรือผู้เชี่ยวชาญเพื่อการดูแลที่เหมาะสม</p>
        </div>
        <div class="text-center">
            <a href="tel:123456789" class="btn btn-danger btn-lg">
                ติดต่อแพทย์ทันที
            </a>
        </div>
        @else
        <!-- หากผลลัพธ์ไม่เสี่ยง -->
        <div class="alert alert-success text-center">
            <h5 class="fw-bold">คำแนะนำ:</h5>
            <p>คุณไม่มีความเสี่ยงในเรื่องสุขภาพ แต่อย่าลืมดูแลสุขภาพและรับการตรวจเป็นประจำเพื่อป้องกันปัญหาสุขภาพในอนาคต</p>
        </div>
        <div class="text-center">
            <a href="{{ route('survey.list') }}" class="btn btn-success btn-lg">
                สำรวจแบบประเมินอื่น
            </a>
        </div>
        @endif
    </div>
</div>
@endsection

<style>
    /* การ์ดผลลัพธ์ */
    .result-card {
        background: #f9f9f9;
        border: 1px solid #e3e3e3;
        animation: fadeIn 1s ease-out;
    }

    /* สีสำหรับผลลัพธ์ */
    .text-success {
        color: #28a745 !important;
    }

    .text-danger {
        color: #dc3545 !important;
    }

    /* กล่องคำแนะนำ */
    .alert-success {
        background: #d4edda;
        border: 1px solid #c3e6cb;
        color: #155724;
        animation: slideIn 1s ease-out;
    }

    .alert-danger {
        background: #f8d7da;
        border: 1px solid #f5c6cb;
        color: #721c24;
        animation: slideIn 1s ease-out;
    }

    /* ปุ่ม */
    .btn-success:hover,
    .btn-danger:hover {
        transform: scale(1.05);
        transition: transform 0.3s ease;
    }

    /* อนิเมชัน */
    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
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
    h1, h2 {
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
</style>


