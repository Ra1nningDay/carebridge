@extends('layouts.app')

@section('content')
<style>
    /* Container Styling */
    .container {
        max-width: 900px; /* Narrower width for content */
    }
    
    /* Card Styling: Hover effect, border-radius, box-shadow */
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
        border: 2px solid #007bff; /* Subtle border around images */
        transition: transform 0.3s ease;
    }

    .card img:hover {
        transform: scale(1.1);
    }

    /* Text styles for card titles, labels, and info */
    .card-title {
        font-size: 1.15rem;
        font-weight: 600;
        color: #333;
    }

    .card p {
        font-size: 1rem;
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

    /* Input Styling */
    input.form-control, textarea.form-control, input[type="datetime-local"] {
        border-radius: 8px;
        padding: 10px;
    }

    /* Section Titles */
    h5 {
        font-weight: 700;
        color: #007bff;
    }

    /* Additional Classes for Layout */
    .text-center {
        text-align: center;
    }

    .d-flex {
        display: flex;
    }

    .ms-3 {
        margin-left: 15px;
    }

    .text-primary {
        color: #007bff !important;
    }

    .mb-3 {
        margin-bottom: 1rem;
    }

    /* Alerts */
    .alert-success {
        border-left: 4px solid #28a745;
        background-color: #e2f9e1;
        color: #28a745;
    }

    .selected-doctor {
        background-color: #28a745 !important;  /* สีเขียวสำหรับปุ่มที่เลือก */
        color: white;  /* เปลี่ยนข้อความเป็นสีขาว */
    }
</style>

<div class="container py-5">
    <h1 class="text-center mb-5 text-primary">รายละเอียดนัดหมาย</h1>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success mb-4">{{ session('success') }}</div>
    @endif

    <!-- Appointment Details Card -->
    <div class="card p-5 shadow-lg rounded-4 border-info mb-4">
        <h3 class="card-title text-dark">ข้อมูลนัดหมาย</h3>
        <div class="row">
            <!-- Elderly Information -->
            <div class="col-md-6">
                <div class="card bg-light border-primary shadow-sm rounded-3">
                    <div class="card-body d-flex">
                        <img src="{{ $appointment->elderly->avatar_url }}" alt="Elderly Avatar" class="rounded-circle mb-3" style="width: 80px; height: 80px; object-fit: cover;">
                        <div class="ms-3 d-flex flex-column">
                            <h5 class="card-title text-dark mb-1">{{ $appointment->elderly->name }}</h5>
                            <p><strong>อายุ: </strong>{{ $appointment->elderly->age ?? 'ไม่ระบุ' }} ปี</p>
                            <p><strong>เบอร์โทร: </strong>{{ $appointment->elderly->phone ?? 'ไม่ระบุ' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Caregiver Information -->
            <div class="col-md-6">
                <div class="card bg-light border-primary shadow-sm rounded-3">
                    <div class="card-body d-flex">
                        <img src="{{ $appointment->caregiver->avatar_url }}" alt="Caregiver Avatar" class="rounded-circle mb-3" style="width: 80px; height: 80px; object-fit: cover;">
                        <div class="ms-3 d-flex flex-column">
                            <h5 class="card-title text-dark mb-1">{{ $appointment->caregiver->name }}</h5>
                            <p><strong>เบอร์โทร: </strong>{{ $appointment->caregiver->phone ?? 'ไม่ระบุ' }}</p>
                            <p><strong>อีเมล: </strong>{{ $appointment->caregiver->email ?? 'ไม่ระบุ' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Doctor Information -->
        <div class="mb-4">
            <h5 class="text-primary">ข้อมูลแพทย์</h5>
            <div class="card bg-light border-primary shadow-sm rounded-3 p-4">
                <div class="d-flex align-items-center">
                    <img src="{{ $appointment->doctor->avatar_url }}" alt="Caregiver Avatar" class="rounded-circle" style="width: 90px; height: 90px; object-fit: cover; border: 3px solid #007bff;">
                    <div class="ms-3">
                        <h5 class="card-title text-dark mb-1">{{ $appointment->doctor->name }}</h5>
                        <p class="text-muted mb-1"><strong>ความเชี่ยวชาญ:</strong> {{ $appointment->doctor->specialization ?? 'ไม่ระบุ' }}</p>
                        <p class="text-muted mb-0"><strong>เบอร์โทร:</strong> {{ $appointment->doctor->phone ?? 'ไม่ระบุ' }}</p>
                    </div>
                </div>
            </div>
        </div>


        <!-- Appointment Details -->
        <div class="mb-4">
            <h5 class="text-primary">เวลานัดหมาย</h5>
            <p><strong>วันที่และเวลา: </strong>{{ $appointment->scheduled_at }}</p>
        </div>

        <!-- Notes Section -->
        <div class="mb-4">
            <h5 class="text-primary">ข้อความเพิ่มเติม</h5>
            <p>{{ $appointment->notes ?? 'ไม่มีข้อความเพิ่มเติม' }}</p>
        </div>

        <!-- Status Section -->
        <div class="mb-4">
            <h5 class="text-primary">สถานะการยืนยัน</h5>
            <p>
                @switch($appointment->status)
                    @case('pending')
                        รอการยืนยัน
                        @break
                    @case('completed')
                        ยืนยันนัดหมายเรียบร้อย
                        @break
                    @case('canceled')
                        การนัดหมายถูกยกเลิก
                        @break
                    @case('reschedule')
                        ปรับเปลี่ยนเวลานัดหมาย
                        @break
                    @default
                        สถานะไม่ได้ระบุ
                @endswitch
            </p>
        </div>

        <!-- Action Buttons (Optional: Edit, Cancel, etc.) -->
        <a href="{{ route('appointments.index')}}" class="btn btn-secondary">กลับไปที่รายการนัดหมาย</a>
    </div>

</div>

@endsection
