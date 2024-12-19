@extends('layouts.app')

@section('title', 'ผู้ดูแลใกล้เคียง')

@section('content')
<div class="container mt-5">
    <div class="text-center mb-5">
        <h2 class="fw-bold" style="color: #2c3e50;">ผู้ดูแลใกล้เคียง</h2>
        <p class="text-muted">ตำแหน่งของคุณ: <strong>ละติจูด:</strong> {{ $latitude }}, <strong>ลองจิจูด:</strong> {{ $longitude }}</p>
        <div style="height: 4px; width: 60px; background-color: #f39c12; margin: 8px auto;"></div>
    </div>

    @if ($caregivers->isEmpty())
        <div class="alert alert-warning text-center py-5 shadow-sm rounded">
            <h4 class="mb-3" style="color: #2c3e50;">ไม่พบผู้ดูแลในพื้นที่ของคุณ</h4>
            <p>ลองขยายระยะการค้นหาหรือกลับมาตรวจสอบอีกครั้งในภายหลัง</p>
            <a href="{{ route('welcome') }}" class="btn btn-primary mt-3">กลับไปหน้าหลัก</a>
        </div>
    @else
        <div class="row gy-4">
            @foreach ($caregivers as $caregiver)
                <div class="col-lg-4 col-md-6">
                    <div class="card shadow-sm border-0 rounded-3 h-100 text-center">
                        <div class="card-body">
                            <div class="mx-auto mb-3" style="width: 90px; height: 90px;">
                                <img class="img-fluid rounded-circle text-center" 
                                src="{{ $caregiver->user->avatar ? asset('uploads/avatars/' . $caregiver->user->avatar) : asset('images/avatars/default-avatar.png') }}"  
                                alt="{{ $caregiver->user->name ?? 'Caregiver' }}" 
                                style="width: 100%; height: 100%; object-fit: cover;">
                            </div>
                            <h5 class="card-title fw-bold mb-2" style="color: #2c3e50;">{{ $caregiver->user->name ?? 'ไม่ระบุชื่อ' }}</h5>
                            <p class="text-muted small mb-2"><strong>ความเชี่ยวชาญ:</strong> {{ $caregiver->specialization ?? 'ไม่ระบุ' }}</p>
                            <p class="text-muted small mb-2"><strong>ระยะทาง:</strong> {{ round($caregiver->distance, 2) }} กม.</p>
                            <a href="{{ route('profile.profile', ['id' => $caregiver->id]) }}" class="btn btn-outline-primary rounded-pill mt-3 w-100">ดูโปรไฟล์</a>
                            <!-- ปุ่ม Send Message -->
                            @if ($caregiver->user->id != auth()->id())
                                <a href="{{ route('chat.start', $caregiver->user->id) }}" class="btn btn-success rounded-pill w-100 mt-2">
                                    <i class="bi bi-chat-dots me-1"></i> ส่งข้อความ
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection

<style>
    .card:hover {
        transform: scale(1.05);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .btn-outline-primary:hover {
        background-color: #f39c12;
        color: #fff;
    }
</style>
