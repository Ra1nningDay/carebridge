@extends('layouts.app')

@section('content')
<style>
    /* Container Styling */
    .container {
        max-width: 900px; 
    }

    /* Card Styling */
    .card {
        border-radius: 10px;
        transition: all 0.3s ease;
        margin-bottom: 1.25rem;
    }

    .card:hover {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .card img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border: 2px solid #007bff;
        transition: transform 0.3s ease;
    }

    .card img:hover {
        transform: scale(1.1);
    }

    /* Text styles */
    .card-title {
        font-size: 1.2rem;
        font-weight: 600;
        color: #333;
    }

    .card p {
        font-size: 1.05rem;
        color: #333;
        margin-bottom: 5px;
    }

    .card p strong {
        font-weight: 700;
        color: #007bff;
    }

    /* Button Styling */
    .btn-outline-primary {
        border-radius: 30px;
        font-weight: 600;
    }

    .btn-success {
        background-color: #28a745;
        border-color: #28a745;
        color: #fff;
    }

    .btn-select-doctor {
        padding: 8px 16px;
        font-weight: bold;
        border-radius: 30px;
        transition: background-color 0.3s ease, border 0.3s ease;
    }

    .btn-select-doctor:hover {
        background-color: #007bff;
        color: #fff;
    }

    button[type="submit"] {
        padding: 12px;
        font-size: 1.1rem;
        border-radius: 50px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        transition: background-color 0.3s ease, transform 0.3s ease;
    }

    button[type="submit"]:hover {
        background-color: #0069d9;
    }

    /* Layout Styles */
    h5 {
        font-weight: 700;
        color: #007bff;
    }

    /* Success Message Styling */
    .alert-success {
        border-left: 4px solid #28a745;
        background-color: #e2f9e1;
        color: #28a745;
    }

    .mb-4 {
        margin-bottom: 1.5rem;
    }

    /* Additional Styles for Flex Layout */
    .d-flex {
        display: flex;
    }

    .ms-3 {
        margin-left: 15px;
    }

    /* Adding Padding for Visual Focus */
    .p-4 {
        padding: 1.5rem;
    }

    /* Icon Styling */
    .icon {
        color: #007bff;
        font-size: 1.25rem;
    }
</style>

<div class="container py-5">
    <h1 class="text-center mb-5 text-primary">รายละเอียดนัดหมาย</h1>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success mb-4">{{ session('success') }}</div>
    @endif

    <!-- Appointment Details Card -->
    <div class="card p-4 shadow-lg rounded-4 border-info mb-4">
        <h3 class="card-title text-dark">ข้อมูลนัดหมาย</h3>

        <!-- Elderly Information -->
        <div class="row">
            <div class="col-md-6">
                <div class="card bg-light border-primary shadow-sm rounded-3 p-3">
                    <div class="d-flex align-items-center">
                        <img src="{{ $appointment->elderly->avatar_url }}" alt="Elderly Avatar" class="rounded-circle">
                        <div class="ms-3 d-flex flex-column">
                            <h5 class="text-dark">{{ $appointment->elderly->name }}</h5>
                            <p><i class="fas fa-calendar-alt icon"></i> อายุ: {{ $appointment->elderly->age ?? 'ไม่ระบุ' }} ปี</p>
                            <p><i class="fas fa-phone-alt icon"></i> เบอร์โทร: {{ $appointment->elderly->phone ?? 'ไม่ระบุ' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Caregiver Information -->
            <div class="col-md-6">
                <div class="card bg-light border-primary shadow-sm rounded-3 p-3">
                    <div class="d-flex align-items-center">
                        <img src="{{ $appointment->caregiver->avatar_url }}" alt="Caregiver Avatar" class="rounded-circle">
                        <div class="ms-3 d-flex flex-column">
                            <h5 class="text-dark">{{ $appointment->caregiver->name }}</h5>
                            <p><i class="fas fa-phone-alt icon"></i> เบอร์โทร: {{ $appointment->caregiver->phone ?? 'ไม่ระบุ' }}</p>
                            <p><i class="fas fa-envelope icon"></i> อีเมล: {{ $appointment->caregiver->email ?? 'ไม่ระบุ' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Doctor Information -->
        <div class="mb-4">
            <h5>ข้อมูลแพทย์</h5>
            <div class="card bg-light border-primary shadow-sm rounded-3 p-4">
                <div class="d-flex align-items-center">
                    <img src="{{ $appointment->doctor->avatar_url }}" alt="Doctor Avatar" class="rounded-circle" style="width: 90px; height: 90px;">
                    <div class="ms-3">
                        <h5>{{ $appointment->doctor->name }}</h5>
                        <p class="text-muted mb-1"><strong>ความเชี่ยวชาญ:</strong> {{ $appointment->doctor->specialization ?? 'ไม่ระบุ' }}</p>
                        <p class="text-muted mb-0"><strong>เบอร์โทร:</strong> {{ $appointment->doctor->phone ?? 'ไม่ระบุ' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Appointment Details -->
        <div class="mb-4">
            <h5>เวลานัดหมาย</h5>
            <p><strong>วันที่และเวลา: </strong>{{ $appointment->scheduled_at }}</p>
        </div>

        <!-- Notes Section -->
        <div class="mb-4">
            <h5>ข้อความเพิ่มเติม</h5>
            <p>{{ $appointment->notes ?? 'ไม่มีข้อความเพิ่มเติม' }}</p>
        </div>

        <!-- Status Section -->
        <div class="mb-4">
            <h5 class="text-primary">สถานะการยืนยัน</h5>
            <p>
                @switch($appointment->status)
                    @case('pending')
                        <span class="badge bg-warning text-dark">รอการยืนยัน</span>
                        @break
                    @case('confirmed')
                        <span class="badge bg-success">ยืนยันนัดหมายเรียบร้อย</span>
                        @break
                    @case('canceled')
                        <span class="badge bg-danger">การนัดหมายถูกยกเลิก</span>
                        @break
                    @case('reschedule')
                        <span class="badge bg-info">ปรับเปลี่ยนเวลานัดหมาย</span>
                        @break
                    @default
                        <span class="badge bg-secondary">สถานะไม่ได้ระบุ</span>
                @endswitch
            </p>
        </div>


        <!-- Action Button -->
        <a href="{{ route('appointments.index') }}" class="btn btn-secondary">กลับไปที่รายการนัดหมาย</a>
    </div>
</div>

@endsection
