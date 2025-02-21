@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="text-center text-primary fw-bold mb-4">รายการนัดหมาย</h2>
     <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success mb-4">{{ session('success') }}</div>
    @endif

    {{-- <!-- Error Message -->
    @if(session('error'))
        <div class="alert alert-danger mb-4">{{ session('error') }}</div>
    @endif --}}

    @if($appointments->isEmpty())
        <div class="alert alert-info text-center py-4 rounded-lg shadow-sm">
            <strong>ยังไม่มีการนัดหมาย</strong>
        </div>
    @else
        <div class="row justify-content-center">
            @foreach($appointments as $appointment)
                @if($appointment->status !== 'expired') {{-- ซ่อนนัดหมายที่หมดอายุ --}}
                    <div class="col-md-4 mb-4">
                        <div class="card shadow border-0 rounded-lg">
                            <div class="card-body p-4">
                                {{-- Header: Doctor Name and Date --}}
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="card-title mb-0 text-primary fw-bold">
                                        แพทย์: {{ $appointment->doctor->name ?? 'ไม่พบข้อมูลแพทย์' }}
                                    </h5>
                                    <span class="badge bg-secondary text-white rounded-pill">
                                        {{ Carbon\Carbon::parse($appointment->scheduled_at)->format('d M Y') ?? 'N/A' }}
                                    </span>
                                </div>

                                {{-- Appointment Details --}}
                                <p class="mb-1"><strong>เวลา:</strong> {{ Carbon\Carbon::parse($appointment->scheduled_at)->format('H:i') ?? 'N/A' }}</p>
                                <p class="mb-1"><strong>ผู้สูงอายุ:</strong> {{ $appointment->elderly->name ?? 'ไม่พบข้อมูลผู้สูงอายุ' }}</p>
                                <p class="mb-3"><strong>ผู้ดูแล:</strong> {{ $appointment->caregiver->name ?? 'ไม่พบข้อมูลผู้ดูแล' }}</p>

                                {{-- Status Indicator --}}
                                <div class="mb-3">
                                    <span class="badge rounded-pill px-3 py-2 text-white {{
                                        $appointment->status == 'confirmed' ? 'bg-success' : 
                                        ($appointment->status == 'pending' ? 'bg-warning text-dark' : 
                                        ($appointment->status == 'canceled' ? 'bg-danger' : 'bg-secondary'))
                                    }}">
                                        {{
                                            $appointment->status == 'confirmed' ? 'ยืนยันแล้ว' : 
                                            ($appointment->status == 'pending' ? 'กำลังรอการยืนยัน' : 
                                            ($appointment->status == 'canceled' ? 'ยกเลิกการนัดหมาย' : 'ไม่ทราบสถานะ'))
                                        }}
                                    </span>
                                </div>

                                {{-- Zoom Functionality --}}
                                <div class="mb-3">
                                    @if($appointment->status === 'confirmed')
                                        @if(Carbon\Carbon::parse($appointment->scheduled_at)->isPast())
                                            @if($appointment->elderly_id == auth()->id() || $appointment->caregiver_id == auth()->id() || $appointment->doctor_id == auth()->id())
                                                {{-- หากมี Zoom Link --}}
                                                @if($appointment->zoom_link)
                                                    <div class="d-flex justify-content-between">
                                                        {{-- ปุ่มเข้าผ่านแอป --}}
                                                        <a href="{{ $appointment->zoom_link }}" class="btn btn-success w-50 me-2" target="_blank">
                                                            เข้าผ่านแอป
                                                        </a>
                                                        {{-- ปุ่มเข้าผ่านเบราว์เซอร์ --}}
                                                        <a href="{{ $appointment->zoom_link }}?browser=1" class="btn btn-secondary w-50" target="_blank">
                                                            เข้าผ่านเบราว์เซอร์
                                                        </a>
                                                    </div>
                                                {{-- หากยังไม่มี Zoom Link --}}
                                                @else
                                                    <form action="{{ route('appointments.createZoom', $appointment->id) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-primary w-100">สร้างห้องประชุม Zoom</button>
                                                    </form>
                                                @endif
                                            @else
                                                <p class="text-muted">คุณไม่มีสิทธิ์เข้า Zoom ในการนัดหมายนี้</p>
                                            @endif
                                        @else
                                            <p class="text-muted">กรุณารอถึงเวลานัดหมายก่อนเข้าสู่ห้อง Zoom</p>
                                        @endif
                                    @else
                                        <p class="text-muted">การนัดหมายยังไม่ยืนยัน</p>
                                    @endif
                                </div>

                                {{-- Role-Specific Actions --}}
                                <div class="d-flex justify-content-between">
                                    {{-- Admin Actions --}}
                                    @if(auth()->user()->roles->contains('name', 'admin') && $appointment->doctor_id == auth()->id())
                                        <a href="{{ route('appointments.show', $appointment->id) }}" class="btn btn-outline-primary btn-sm">ดูรายละเอียด</a>
                                        <a href="{{ route('appointments.create', ['elderly_id' => $appointment->elderly_id]) }}" class="btn btn-outline-success btn-sm">สร้างนัดหมายใหม่</a>
                                    @endif

                                    {{-- Caregiver Actions --}}
                                    @if(auth()->user()->roles->contains('name', 'caregiver') && $appointment->caregiver_id == auth()->id())
                                        <a href="{{ route('appointments.show', $appointment->id) }}" class="btn btn-outline-primary btn-sm">ดูรายละเอียด</a>
                                        @if($appointment->status == 'pending')
                                            <form action="{{ route('appointments.update', $appointment->id) }}" method="POST" class="d-inline-block">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="confirmed">
                                                <button type="submit" class="btn btn-outline-success btn-sm">ยืนยัน</button>
                                            </form>
                                            <form action="{{ route('appointments.update', $appointment->id) }}" method="POST" class="d-inline-block ms-2">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="canceled">
                                                <button type="submit" class="btn btn-outline-danger btn-sm">ปฏิเสธ</button>
                                            </form>
                                        @endif
                                    @endif

                                    {{-- Elderly Actions --}}
                                    @if(auth()->user()->roles->contains('name', 'patient') && $appointment->elderly_id == auth()->id())
                                        <a href="{{ route('appointments.show', $appointment->id) }}" class="btn btn-outline-primary btn-sm">ดูรายละเอียด</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endif {{-- จบเงื่อนไขซ่อนนัดหมายที่หมดอายุ --}}
            @endforeach
        </div>
    @endif
    
   <!-- ประวัติการนัดหมาย -->
    <h3 class="text-center text-secondary fw-bold mt-5">
        <i class="bi bi-clock-history me-2"></i>ประวัติการนัดหมาย
    </h3>
    @if($expiredAppointments->isEmpty())
        <div class="text-center py-5">
            <i class="bi bi-journal-x text-secondary display-4"></i>
            <p class="text-secondary fw-bold mt-3">ไม่มีประวัติการนัดหมาย</p>
        </div>
    @else
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 mt-4">
            @foreach($expiredAppointments as $appointment)
                <div class="col">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body">
                            <h5 class="card-title text-primary fw-bold">
                                <i class="bi bi-person-badge-fill me-2"></i>แพทย์: {{ $appointment->doctor->name ?? 'ไม่พบข้อมูล' }}
                            </h5>
                            <p class="mb-1">
                                <i class="bi bi-calendar-event me-2 text-primary"></i>
                                <strong>เวลา:</strong> {{ Carbon\Carbon::parse($appointment->scheduled_at)->format('d M Y H:i') }}
                            </p>
                            <p class="mb-1">
                                <i class="bi bi-people-fill me-2 text-primary"></i>
                                <strong>ผู้สูงอายุ:</strong> {{ $appointment->elderly->name ?? 'ไม่พบข้อมูล' }}
                            </p>
                            <p class="mb-1">
                                <i class="bi bi-person-fill me-2 text-primary"></i>
                                <strong>ผู้ดูแล:</strong> {{ $appointment->caregiver->name ?? 'ไม่พบข้อมูล' }}
                            </p>
                            <p class="mb-1">
                                <i class="bi bi-exclamation-circle-fill me-2 text-danger"></i>
                                <strong>สถานะ:</strong> <span class="badge bg-danger">หมดอายุ</span>
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

</div>
@endsection
