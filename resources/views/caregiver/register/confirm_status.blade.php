@extends('layouts.app')

@section('title', 'ยืนยันสถานะการสมัครของคุณ')

@section('content')
<div class="container mt-5">
    <div class="row g-5">
        <!-- คอลัมน์ซ้าย: สถานะการสมัคร -->
        <div class="col-md-6">
            <h2 class="fw-bold text-primary mb-4">สถานะการสมัคร</h2>
            <p class="text-muted">การสมัครของคุณได้รับการตรวจสอบแล้ว นี่คือผลลัพธ์ของการสมัครของคุณ:</p>

            <!-- แสดงสถานะการสมัคร -->
            @if($status == 'Approved')
                <div class="alert alert-success rounded-4 shadow-sm">
                    <h5 class="fw-bold">🎉 อนุมัติแล้ว!</h5>
                    <p>ขอแสดงความยินดี! การสมัครของคุณได้รับการอนุมัติ ยินดีต้อนรับ!</p>
                </div>
            @elseif($status == 'Rejected')
                <div class="alert alert-danger rounded-4 shadow-sm">
                    <h5 class="fw-bold">❌ ปฏิเสธ</h5>
                    <p>เราขอแสดงความเสียใจที่แจ้งให้คุณทราบว่า การสมัครของคุณได้รับการปฏิเสธ กรุณาติดต่อเราหากต้องการข้อมูลเพิ่มเติม</p>
                </div>
            @else
                <div class="alert alert-info rounded-4 shadow-sm">
                    <h5 class="fw-bold">⏳ กำลังตรวจสอบ</h5>
                    <p>การสมัครของคุณยังอยู่ในระหว่างการตรวจสอบ กรุณาตรวจสอบอีกครั้งในภายหลังสำหรับข้อมูลอัปเดต</p>
                </div>
            @endif
        </div>

        <!-- คอลัมน์ขวา: ส่วนแสดงความคืบหน้า -->
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white text-center">
                    <h4 class="fw-bold mb-0">ความคืบหน้าของการสมัคร</h4>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item {{ $status ? 'text-primary fw-bold' : '' }}">
                            <i class="bi bi-check-circle-fill me-2 text-success"></i> ขั้นตอนที่ 1: กรอกแบบฟอร์มการสมัคร
                        </li>
                        <li class="list-group-item {{ $status ? 'text-primary fw-bold' : '' }}">
                            <i class="bi bi-check-circle-fill me-2 text-success"></i> ขั้นตอนที่ 2: รอการตรวจสอบและอนุมัติ
                        </li>
                        <li class="list-group-item {{ $status ? 'text-primary fw-bold' : '' }}">
                            <i class="bi bi-check-circle-fill me-2 text-success"></i> ขั้นตอนที่ 3: ยืนยันสถานะของคุณ
                        </li>
                    </ul>

                    <div class="mt-4">
                        <div class="progress" style="height: 30px;">
                            <div 
                                class="progress-bar progress-bar-striped progress-bar-animated bg-success" 
                                role="progressbar" 
                                style="width: 100%;" 
                                aria-valuenow="100" 
                                aria-valuemin="0" 
                                aria-valuemax="100">
                                100%
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
