<nav class="navbar navbar-expand-lg border bg-white sticky-top animated-navbar">
    <div class="container-fluid px-4">
        @php
            // Mapping ชื่อ Route กับชื่อหน้า
            $pageTitle = [
                'carefield.index' => 'ภาพรวมข้อมูลการลงพื้นที่',
                'carefield.patient' => 'รายชื่อผู้รับการตรวจสุขภาพ',
                'carefield.form' => 'แบบฟอร์มจัดการ',
            ][Route::currentRouteName()] ?? 'ไม่ระบุชื่อหน้า';
        @endphp

        <!-- โลโก้และชื่อหน้า -->
        <h3 class="py-3 m-0">{{ $pageTitle }}</h3>


        <!-- ปุ่ม Navbar Toggler -->
        <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- แถบค้นหา -->
            {{-- <form class="m-0 d-none d-md-flex px-2 search-bar-animation" action="" method="get">
                <div class="input-group">
                    <div class="position-relative">
                        <input type="text" class="form-control border rounded-pill py-2" placeholder="ค้นหา" aria-label="ค้นหา" style="border-radius: 20px; padding-left: 35px; width:400px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search position-absolute" viewBox="0 0 16 16" style="top: 50%; left: 10px; transform: translateY(-50%);">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                        </svg>
                    </div>
                </div>              
            </form> --}}

        <!-- เมนู Collapse -->
        <div class="collapse navbar-collapse" id="navbarNav">
            {{-- <!-- เมนู Navbar -->
            <ul class="navbar-nav text-center mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link text-black px-3 py-0 active nav-hover" href="{{route('welcome')}}">สำรวจ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-black px-3 py-0 nav-hover" href="{{route('caregiver')}}">ค้นหาผู้ดูแล</a> 
                </li>
                <li class="nav-item">
                    <a class="nav-link text-black px-3 py-0 nav-hover" href="{{route('posts.index')}}">บทความ</a>
                </li>
            </ul> --}}

            <!-- เมนูสำหรับผู้ใช้ที่ล็อกอิน -->
            @auth
            <div class="d-flex flex-column flex-lg-row align-items-center ms-lg-auto">
                {{-- <!-- ไอคอนสร้างโพสต์ -->
                <a class="text-black text-decoration-none d-flex align-items-center me-0 me-lg-3 mb-3 mb-lg-0" href="{{route('posts.create')}}">
                    <span class="me-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                        </svg>
                    </span>
                    <span>สร้างโพสต์</span>
                </a> --}}

                <!-- เมนูผู้ใช้ -->
                <img class="rounded-circle" src="{{ auth()->user()->avatar_url }}" width="32" height="32" alt="">
                
                <ul class="dropdown-menu dropdown-menu-end dropdown-animation">
                    <li><a class="dropdown-item" href="{{route('profile.index')}}">โปรไฟล์</a></li>
                    <li><a class="dropdown-item" href="{{route('profile.edit')}}">แก้ไขโปรไฟล์</a></li>
                    {{-- <li><a class="dropdown-item" href="{{route('caregiver.register')}}">สมัครเป็นผู้ดูแล</a></li> --}}
                    {{-- <li><a class="dropdown-item" href="#">จัดการการสมัครสมาชิก</a></li> --}}
                    <li><a class="dropdown-item" href="#">การตั้งค่า</a></li>
                    <li>    
                        <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">ออกจากระบบ</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
                <h5 class="m-0 mx-2" style="font-size: 18px;">{{ auth()->user()->name }}</h5>
                <button class="btn profile-animation mb-3 mb-lg-0 p-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-chevron-down"></i> 
                </button>
            </div>
            @else
            <!-- ปุ่มสมัครและเข้าสู่ระบบ -->
            <div class="d-flex flex-column flex-lg-row ms-auto">
                <a href="{{ route('register') }}" class="btn rounded-pill mb-2 mb-lg-0 me-lg-2">สมัครสมาชิก</a>
                <a href="{{ route('login') }}" class="btn rounded-pill text-white" style="background-color: #003d2b;">เข้าสู่ระบบ</a>
            </div>
            @endauth
        </div>
    </div>
</nav>

<style>
/* Animation for Navbar */
/* .animated-navbar {
    animation: fadeIn 1s ease-in-out;
} */

/* Animation for Hover Links */
.nav-hover:hover {
    color: #bcbdbc !important;
    transition: all 0.3s;
}

/* Animation for Logo
.logo-animation:hover {
    transform: scale(1.1);
    transition: transform 0.3s;
} */

/* Search Bar Animation */
.search-bar-animation input:hover {
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    transition: box-shadow 0.3s;
}

/* Dropdown Animation */
.dropdown-animation {
    animation: slideDown 0.5s ease;
}

/* Profile Button Animation
.profile-animation:hover {
    transform: rotate(360deg);
    transition: transform 0.8s;
} */

/* Auth Button Animation */
.auth-animation a:hover {
    background-color: #bcbdbc !important;
    color: #fff !important;
    transition: all 0.3s;
}

/* Keyframes */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>
