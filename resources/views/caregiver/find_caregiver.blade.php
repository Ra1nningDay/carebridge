@extends('layouts.app')

@section('title', 'ค้นหาผู้ดูแล')

@section('content')
<div class="caregiver-banner position-relative d-flex justify-content-center align-items-center" style="margin-bottom: 128px; background-color:#003e29; height: 560px;">
    <div class="container text-center">
        <h1 class="fw-bold" style="color:#abe7bb;">ค้นหาผู้ดูแลที่เหมาะสมและเชื่อถือได้สำหรับคนที่คุณรัก</h1>
        <p style="color:#abe7bb;">ผู้ดูแลที่คุ้มค่าและไว้ใจได้ในมือคุณ</p>

        <!-- Dropdown และปุ่มค้นหา -->
        <div class="d-flex justify-content-center flex-wrap gap-3 mt-4">
            <select id="province-select" class="form-select rounded-pill" style="max-width: 250px;">
                <option value="">เลือกจังหวัด</option>
                <option value="13.7563,100.5018">กรุงเทพมหานคร</option>
                <option value="10.49560350,99.18476060">ชุมพร</option>
                <option value="7.8804,98.3923">ภูเก็ต</option>
            </select>
            <button id="search-province-btn" class="btn btn-light rounded-pill px-4">ค้นหาตามจังหวัด</button>
            <button id="search-gps-btn" class="btn btn-warning rounded-pill px-4">ค้นหาตามตำแหน่งปัจจุบัน (GPS)</button>
        </div>
    </div>

    <!-- ส่วนล่างของแบนเนอร์ -->
    <div class="position-absolute bg-light p-3 shadow-lg rounded-3 text-center" style="width: 90%; bottom: -30px; left: 50%; transform: translateX(-50%);">
        <div class="row text-dark fw-bold">
            <div class="col-md-6">เรามีผู้ดูแลที่เชื่อถือได้</div>
            <div class="col-md-6">ความพึงพอใจของคุณคือเป้าหมายของเรา</div>
        </div>
    </div>
</div>

<!-- รายชื่อผู้ดูแล -->
<section style="margin-bottom: 72px;">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold" style="color: #2c3e50;">ผู้ดูแลของเรา</h2>
            <div style="height: 4px; width: 60px; background-color: #f39c12; margin: 8px auto;"></div>
        </div>

        <div class="row gy-4">
            @foreach ($caregivers as $caregiver)
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="card shadow-sm border-0 rounded-3 h-100 text-center align-items-center">
                        <!-- รูปโปรไฟล์ -->
                        <div class="mt-4 bg-light rounded-circle" 
                            style="width: 90px; height: 90px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);">
                            <img class="img-fluid rounded-circle text-center" 
                                src="{{ $caregiver->user->avatar ? asset('uploads/avatars/' . $caregiver->user->avatar) : asset('images/avatars/default-avatar.png') }}"  
                                alt="{{ $caregiver->user->name ?? 'Caregiver' }}" 
                                style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        
                        <!-- ข้อมูลภายในการ์ด -->
                        <div class="card-body">
                            <h5 class="card-title fw-bold mb-2">{{ $caregiver->user->name ?? 'ชื่อไม่ระบุ' }}</h5>
                            <p class="text-muted small"><i class="bi bi-geo-alt-fill me-1"></i>{{ $caregiver->personalInfo->address ?? 'สถานที่ไม่ระบุ' }}</p>
                            <h6 class="fw-bold">เหตุผลที่คุณควรเลือกฉัน</h6>
                            <p class="text-muted small">{{ $caregiver->specialization ?? 'ความเชี่ยวชาญไม่ระบุ' }}</p>
                            <hr>
                            <p class="fw-bold text-muted">เริ่มต้นที่:</p>
                            <p class="text-success fs-5 fw-bold">24 บาท/ชั่วโมง</p>
                            <a href="{{ route('profile.profile', ['id' => $caregiver->id]) }}" class="btn btn-outline-primary rounded-pill w-100">ดูโปรไฟล์</a>
                            
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

    </div>
</section>

<script>
    // ตรวจสอบสถานะการเข้าสู่ระบบ
    const isAuthenticated = @json(auth()->check());

    // ค้นหาตามจังหวัด
    document.getElementById('search-province-btn').addEventListener('click', function () {
        if (!isAuthenticated) {
            alert('โปรดเข้าสู่ระบบเพื่อใช้ฟังก์ชันนี้');
            window.location.href = '{{ route("login") }}';
            return;
        }

        const provinceSelect = document.getElementById('province-select');
        const selectedProvince = provinceSelect.value;

        if (selectedProvince) {
            const [latitude, longitude] = selectedProvince.split(',');
            alert(`กำลังค้นหาผู้ดูแลในจังหวัด: ${provinceSelect.options[provinceSelect.selectedIndex].text}`);
            window.location.href = `/caregiver/search?latitude=${latitude}&longitude=${longitude}`;
        } else {
            alert('โปรดเลือกจังหวัดก่อนค้นหา');
        }
    });

    // ค้นหาตามตำแหน่งปัจจุบัน (GPS)
    document.getElementById('search-gps-btn').addEventListener('click', function () {
        if (!isAuthenticated) {
            alert('โปรดเข้าสู่ระบบเพื่อใช้ฟังก์ชันนี้');
            window.location.href = '{{ route("login") }}';
            return;
        }

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                const latitude = position.coords.latitude;
                const longitude = position.coords.longitude;
                alert(`กำลังค้นหาผู้ดูแลใกล้ตำแหน่งของคุณ`);
                window.location.href = `/caregiver/search?latitude=${latitude}&longitude=${longitude}`;
            }, function () {
                alert('ไม่สามารถดึงตำแหน่งของคุณได้ กรุณาลองอีกครั้ง');
            });
        } else {
            alert('เบราว์เซอร์ของคุณไม่รองรับการระบุตำแหน่ง');
        }
    });
</script>
@endsection


<style>
  /* การออกแบบแบนเนอร์ */
  .caregiver-banner {
    position: relative;
    height: 560px;
    background-color: #003e29;
    color: #abe7bb;
  }

  /* การออกแบบส่วนผู้ดูแล */
  .card:hover {
      transform: scale(1.05);
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
      transition: transform 0.3s, box-shadow 0.3s;
  }

    #search-gps-btn:hover {
      background-color: #f39c12 !important;
      color: #fff !important;
  }
</style>
