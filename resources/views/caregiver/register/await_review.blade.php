@extends('layouts.app')

@section('title', 'รอการตรวจสอบและอนุมัติ')

@section('content')
<div class="container mt-5">
    <div class="row g-5">
        <!-- คอลัมน์ซ้าย: สถานะการตรวจสอบ -->
        <div class="col-md-6">
            <h2 class="fw-bold text-primary mb-4">รอการตรวจสอบและอนุมัติ</h2>
            <p class="text-muted">
                การสมัครของคุณกำลังอยู่ในระหว่างการตรวจสอบ ทีมงานของเรากำลังประเมินข้อมูลของคุณ
                เมื่อกระบวนการตรวจสอบเสร็จสมบูรณ์ คุณจะได้รับการแจ้งเตือนเกี่ยวกับผลการตรวจสอบ
            </p>

            <!-- การแจ้งเตือนข้อมูล -->
            <div class="alert alert-info rounded-4 shadow-sm">
                <h5 class="fw-bold">⏳ กำลังตรวจสอบ</h5>
                <p>
                    ขอบคุณสำหรับความอดทนของคุณ! หากคุณมีคำถามใด ๆ กรุณาติดต่อทีมสนับสนุนของเรา
                </p>
            </div>
        </div>
        
        <!-- คอลัมน์ขวา: ส่วนแสดงความคืบหน้า -->
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white text-center">
                    <h4 class="fw-bold mb-0">ความคืบหน้าของการสมัคร</h4>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <i class="bi bi-check-circle-fill me-2 text-success"></i> ขั้นตอนที่ 1: กรอกแบบฟอร์มการสมัคร
                        </li>
                        <li class="list-group-item">
                            <i class="bi bi-clock-history me-2 text-warning"></i> ขั้นตอนที่ 2: รอการตรวจสอบและอนุมัติ
                        </li>
                        <li class="list-group-item text-muted">
                            <i class="bi bi-circle me-2"></i> ขั้นตอนที่ 3: ยืนยันสถานะของคุณ
                        </li>
                    </ul>

                    <div class="mt-4">
                        <div class="progress" style="height: 30px;">
                            <div 
                                class="progress-bar progress-bar-striped progress-bar-animated bg-warning" 
                                role="progressbar" 
                                style="width: 75%;" 
                                aria-valuenow="75" 
                                aria-valuemin="0" 
                                aria-valuemax="100">
                                75% เสร็จสมบูรณ์
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
