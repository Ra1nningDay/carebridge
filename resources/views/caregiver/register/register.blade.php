@extends('layouts.app')

@section('title', 'สมัครเป็นผู้ดูแล')

@section('content')
<div class="container mt-5">
    <div class="row g-5">
        <!-- คอลัมน์ซ้าย: ฟอร์ม -->
        <div class="col-md-6">
            <h2 class="fw-bold text-primary mb-4">สมัครเป็นผู้ดูแล</h2>
            <p class="text-muted">กรอกข้อมูลด้านล่างเพื่อเข้าร่วมทีมผู้ดูแลของเรา โปรดตรวจสอบความถูกต้องของข้อมูลเพื่อให้การดำเนินการราบรื่น</p>

            @if(session('message'))
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    {{ session('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @else
                <form action="{{ route('caregiver.apply') }}" method="POST" class="needs-validation" novalidate>
                    @csrf
                    
                    <input type="hidden" id="user_id" name="user_id" value="{{ auth()->user()->id ?? '' }}">

                    <div class="mb-4">
                        <label for="specialization" class="form-label fw-semibold">ความเชี่ยวชาญ</label>
                        <input type="text" id="specialization" name="specialization" class="form-control rounded-4" placeholder="เช่น พยาบาล, กายภาพบำบัด" required>
                    </div>

                    <div class="mb-4">
                        <label for="experience_years" class="form-label fw-semibold">ประสบการณ์ (ปี)</label>
                        <input type="number" id="experience_years" name="experience_years" class="form-control rounded-4" placeholder="กรอกจำนวนปีประสบการณ์ของคุณ" required>
                    </div>

                    <input type="hidden" id="latitude" name="latitude">
                    <input type="hidden" id="longitude" name="longitude">

                    <div class="d-flex justify-content-between gap-2 mt-4">
                        <button type="button" onclick="getLocation()" class="btn btn-info rounded-pill px-4">
                            <i class="bi bi-geo-alt"></i> รับตำแหน่งปัจจุบัน
                        </button>
                        <button type="submit" class="btn btn-primary rounded-pill px-4">
                            <i class="bi bi-send"></i> ส่งใบสมัคร
                        </button>
                    </div>

                    <!-- แผนที่ -->
                    <div id="map-container" class="mt-4 border rounded-3 overflow-hidden" style="height: 300px;">
                        <iframe 
                            id="googleMap" 
                            width="100%" 
                            height="100%" 
                            frameborder="0" 
                            style="border:0;" 
                            allowfullscreen 
                            src="https://www.google.com/maps/embed/v1/place?key=AIzaSyC9jFNX78kT7vUPMaWDcxTYCFMT1XgWdGs&q=0,0">
                        </iframe>
                    </div>
                </form>
            @endif
        </div>

        <!-- คอลัมน์ขวา: ความคืบหน้าของการสมัคร -->
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white text-center">
                    <h4 class="mb-0 fw-bold">ความคืบหน้าของการสมัคร</h4>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item {{ $currentStep >= 1 ? 'text-primary fw-bold' : '' }}">
                            <i class="bi bi-check-circle-fill me-2"></i> ขั้นตอนที่ 1: กรอกแบบฟอร์มสมัคร
                        </li>
                        <li class="list-group-item {{ $currentStep >= 2 ? 'text-primary fw-bold' : '' }}">
                            <i class="bi bi-clock-history me-2"></i> ขั้นตอนที่ 2: รอการตรวจสอบและอนุมัติ
                        </li>
                        <li class="list-group-item {{ $currentStep >= 3 ? 'text-primary fw-bold' : '' }}">
                            <i class="bi bi-check-circle-fill me-2"></i> ขั้นตอนที่ 3: ยืนยันสถานะของคุณ
                        </li>
                    </ul>

                    <div class="mt-4">
                        <div class="progress" style="height: 30px;">
                            <div 
                                class="progress-bar progress-bar-striped progress-bar-animated bg-success" 
                                role="progressbar" 
                                style="width: {{ ($currentStep / 3) * 100 }}%;" 
                                aria-valuenow="{{ ($currentStep / 3) * 100 }}" 
                                aria-valuemin="0" 
                                aria-valuemax="100">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(setPosition, showError, { enableHighAccuracy: true });
        } else {
            alert("เบราว์เซอร์ของคุณไม่รองรับ Geolocation");
        }
    }

    function setPosition(position) {
        const latitude = position.coords.latitude;
        const longitude = position.coords.longitude;
        
        document.getElementById("latitude").value = latitude;
        document.getElementById("longitude").value = longitude;

        // อัปเดต URL ของ Google Maps
        const mapIframe = document.getElementById("googleMap");
        mapIframe.src = `https://www.google.com/maps/embed/v1/place?key=AIzaSyC9jFNX78kT7vUPMaWDcxTYCFMT1XgWdGs&q=${latitude},${longitude}`;

        alert("บันทึกตำแหน่งสำเร็จ!");
    }

    function showError(error) {
        switch(error.code) {
            case error.PERMISSION_DENIED:
                alert("ผู้ใช้งานปฏิเสธการให้สิทธิ์ตำแหน่งที่ตั้ง");
                break;
            case error.POSITION_UNAVAILABLE:
                alert("ไม่สามารถรับข้อมูลตำแหน่งได้");
                break;
            case error.TIMEOUT:
                alert("คำขอรับตำแหน่งหมดเวลา");
                break;
            case error.UNKNOWN_ERROR:
                alert("เกิดข้อผิดพลาดที่ไม่ทราบสาเหตุ");
                break;
        }
    }
</script>
@endsection
