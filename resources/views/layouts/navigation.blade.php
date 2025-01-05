<nav class="navbar navbar-expand-lg border bg-white sticky-top shadow-sm caregiver-navbar">
    <div class="container-fluid px-4">
        <!-- โลโก้และชื่อแบรนด์ -->
        <a class="navbar-brand d-flex align-items-center text-black fs-4 logo-animation" href="{{ route('welcome') }}">
            <img src="{{ asset('images/logos/logo-brand.png') }}" width="50" height="50" alt="โลโก้แบรนด์" class="img-fluid">
            <span class="fw-bold ps-1" style="font-size: 28px; color: #003e29;">CareBridge</span>
        </a>

        <!-- แถบค้นหา -->
        <form class="m-0 d-none d-lg-block px-2 search-bar-animation" action="" method="get">
            <div class="input-group">
                <div class="position-relative">
                    <input type="text" class="form-control border rounded-pill py-2" placeholder="ค้นหา" aria-label="ค้นหา" style="border-radius: 20px; padding-left: 35px; width:400px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search position-absolute" viewBox="0 0 16 16" style="top: 50%; left: 10px; transform: translateY(-50%);">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                    </svg>
                </div>
            </div>              
        </form>

        <!-- ปุ่ม Navbar Toggler -->
        <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- เมนู Collapse -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link text-black px-3 py-0 " href="{{ route('welcome') }}">สำรวจ</a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link text-black px-3 py-0 " href="{{ route('caregiver') }}">ค้นหาผู้ดูแล</a>
                </li> --}}
                @if(auth()->check() && auth()->user()->roles->where('name', 'patient')->isEmpty()) 
                    <a class="nav-link text-black px-3 py-0" href="{{ route('survey.index') }}">ประเมินสุขภาพ</a>
                @endif


                <li class="nav-item">
                    <a class="nav-link text-black px-3 py-0 " href="{{ route('posts.index') }}">บทความ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-black px-3 py-0 " href="{{ route('contact') }}">ติดต่อเรา</a>
                </li>
            </ul>

            <!-- เมนูผู้ใช้ -->
            <div class="d-flex justify-content-center align-items-center">
            @auth
                @if(auth()->check() && auth()->user()->roles->pluck('name')->contains('admin'))
                    <a href="{{ route('posts.create') }}" class="btn btn-outline-success me-3">สร้างโพสต์</a>
                @endif
                <div class="dropdown position-relative me-3 notification-dropdown">
                    <button class="btn btn-light rounded-circle border-0 position-relative" type="button" id="notificationDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="32" fill="currentColor" class="bi bi-chat-dots" viewBox="0 0 16 16">
                            <path d="M2 3a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H5.414l-3.707 3.707a1 1 0 0 1-1.707-.707V3zm2-1a2 2 0 0 0-2 2v9.586l3-3H13a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2H4z" />
                            <path d="M7.066 5.993a.5.5 0 1 0-.933-.357 3.002 3.002 0 0 0 5.734 0 .5.5 0 1 0-.933.357 2.002 2.002 0 0 1-3.868 0z" />
                            <path d="M4.066 8.993a.5.5 0 1 0-.933-.357 3.002 3.002 0 0 0 5.734 0 .5.5 0 1 0-.933.357 2.002 2.002 0 0 1-3.868 0z" />
                        </svg>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="notificationCount">
                            {{ isset($unreadMessages) ? $unreadMessages : 0 }}
                        </span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end notification-menu" aria-labelledby="notificationDropdown">
                        @if (isset($conversations) && $conversations->isNotEmpty())
                            @foreach ($conversations->sortByDesc(fn($conversation) => $conversation->messages->last()?->created_at) as $conversation)
                                <li>
                                    <a href="{{ route('chat.show', $conversation->id) }}" class="dropdown-item">
                                        <!-- รูปโปรไฟล์คู่สนทนา -->
                                        <div class="me-3">
                                            <img src="{{ $conversation->users->firstWhere('id', '!=', Auth::id())->avatar_url ?? asset('images/default-avatar.png') }}" 
                                                alt="{{ $conversation->users->firstWhere('id', '!=', Auth::id())->name ?? 'Unknown User' }}" 
                                                class="chat-list-profile-image">
                                        </div>

                                        <!-- ชื่อ, ข้อความล่าสุด, และเวลา -->
                                        <div class="flex-grow-1">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <strong>{{ $conversation->users->firstWhere('id', '!=', Auth::id())->name ?? 'Unknown User' }}</strong>
                                                <small class="text-muted">
                                                    {{ $conversation->messages->sortByDesc('created_at')->first()?->created_at->diffForHumans() ?? '' }}
                                                </small>
                                            </div>
                                            <p class="mb-0 text-truncate">
                                                {{ $conversation->messages->sortByDesc('created_at')->first()?->content ?? 'No messages yet' }}
                                            </p>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        @else
                            <li>
                                <span class="dropdown-item text-muted text-center">No Conversations</span>
                            </li>
                        @endif
                    </ul>

                </div>

                <!-- User Profile Dropdown -->
                <div class="dropdown">
                    <button class="btn bg-light rounded-circle p-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img class="rounded-circle" src="{{ auth()->user()->avatar_url }}" width="40" height="40" alt="Profile Picture">
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end p-3 shadow rounded-3" style="width: 250px;">
                        <!-- ส่วนข้อมูลโปรไฟล์ -->
                        <div class="text-center mb-3">
                            <img class="rounded-circle border border-secondary" 
                                src="{{ auth()->user()->avatar_url }}" width="80" height="80" alt="Profile Picture">
                            <h6 class="mt-2 mb-0">{{ auth()->user()->name ?? 'ไม่ระบุชื่อ' }}</h6>
                            <small class="text-muted">{{ auth()->user()->email ?? 'ไม่ระบุ' }}</small>
                        </div>
                        <hr class="my-2">
                        {{-- <!-- แสดงข้อมูลผู้ดูแลหากผู้ใช้มีบทบาทเป็นผู้สูงอายุ -->
                        @if(auth()->user()->roles->contains('name', 'patient'))
                            @if(auth()->user()->caregiver->isNotEmpty())
                                <div class="my-3">
                                    <div class="row g-3 align-items-center">
                                        <!-- รูปภาพผู้ดูแล -->
                                        <div class="col-4">
                                            <img src="{{ auth()->user()->caregiver->first()->avatar_url ?? asset('images/avatars/default-avatar.png') }}"
                                                alt="Caregiver Profile Picture" class="rounded-circle" width="60" height="60">
                                        </div>

                                        <!-- ข้อมูลผู้ดูแล -->
                                        <div class="col-8">
                                            <h6 class="mt-2 mb-0">{{ auth()->user()->caregiver->first()->name ?? 'ไม่มีชื่อ' }}</h6>
                                            <small class="text-muted">ผู้ดูแลของคุณ</small>
                                        </div>
                                    </div>
                                </div>
                                <hr class="my-2">
                            @else
                                <div class="text-center mt-3">
                                    <p class="text-muted">ไม่มีข้อมูลผู้ดูแลที่เชื่อมโยง</p>
                                </div>
                            @endif
                        @endif --}}



                        <!-- ลิงก์เมนู -->
                        <li>
                            <a class="dropdown-item d-flex align-items-center py-2" href="{{ route('profile.index') }}">
                                <i class="bi bi-person-circle me-2"></i> ข้อมูลสุขภาพ
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center py-2" href="{{ route('profile.edit') }}">
                                <i class="bi bi-pencil-square me-2"></i> แก้ไขข้อมูลส่วนตัว
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center py-2" href="{{ route('evaluations.form') }}">
                                <i class="bi bi-star-fill me-2"></i> ให้คะแนนเว็บไซต์ของเรา
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center py-2 text-danger" 
                                href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="bi bi-box-arrow-right me-2"></i> ออกจากระบบ
                            </a>
                        </li>

                        <!-- ฟอร์ม Logout -->
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </ul>
                </div>



            @else
                <div class="d-flex">
                    <a href="{{ route('register') }}" class="btn ms-2 d-none d-md-block">สมัครสมาชิก</a>
                    <a href="{{ route('login') }}" class="btn btn-login rounded-5 ms-2" style="background-color: #003e29">เข้าสู่ระบบ</a>
                </div>
            @endauth
            </div>
        </div>
    </div>
</nav>

<style>
    @media (max-width: 1024px) {
        .search-bar-animation {
            display: none !important;
        }
    }

    @media (max-width: 1500px) {
        .search-bar-animation {
            display: none !important;
        }
    }

    /* กำหนดสีไอคอนและข้อความในเมนู */
    .text-menu-icon {
        color: #467061; /* ใช้โทนสีเขียวให้เข้ากับธีม */
        font-size: 1.2rem;
    }

    .dropdown-menu .dropdown-item {
        font-size: 1rem;
        color: #467061; /* สีข้อความ */
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .dropdown-menu .dropdown-item:hover {
        background-color: #e6f5ed; /* พื้นหลังสีอ่อนเมื่อ hover */
        color: #003e29; /* สีข้อความเข้มเมื่อ hover */
    }

    .dropdown-menu .dropdown-item i {
        transition: color 0.3s ease;
    }

    .dropdown-menu .dropdown-item:hover i {
        color: #003e29; /* สีไอคอนเมื่อ hover */
    }

    .navbar-nav {
        margin-top: 10px; /* เพิ่มระยะห่างระหว่างเมนูกับด้านบน */
    }

    .btn-login {
        color: #f1f1f1
    }

    /* รูปโปรไฟล์ในรายการสนทนา */
    .chat-list-profile-image {
        width: 40px; /* ขนาดรูปภาพ */
        height: 40px;
        object-fit: cover; /* ปรับให้รูปภาพเต็มพื้นที่โดยไม่บิดเบี้ยว */
        border-radius: 50%; /* ทำให้รูปเป็นวงกลม */
        border: 2px solid #ffffff; /* ขอบสีขาว */
        background-color: #f1f1f1; /* กรณีไม่มีรูป */
    }

    /* Dropdown Item Styling */
    .notification-menu .dropdown-item {
        display: flex;
        align-items: center;
        padding: 10px;
        transition: background-color 0.3s ease;
    }

    .notification-menu .dropdown-item:hover {
        background-color: #f8f8f8;
    }

    .notification-menu .text-truncate {
        max-width: calc(100% - 50px); /* เว้นที่ให้รูปโปรไฟล์ */
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
    }
    .navbar .nav-link {
        color: #000; /* สีปกติ */
        transition: color 0.3s ease-in-out, background-color 0.3s ease-in-out; /* เพิ่ม Transition */
    }

    .navbar .nav-link:hover {
        color: #467061 !important; /* สีตอน hover */
        border-radius: 5px; /* เพิ่มขอบมนเล็กน้อย */
        transition: color 0.3s ease;
    }


    .caregiver-navbar {
        background-color: #ffffff;
        border-bottom: 2px solid #f0f0f0;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.05);
    }

    .notification-menu {
        width: 350px;
        border-radius: 10px;
        box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.1);
    }

    .dropdown-menu {
        padding: 10px;
    }

    .notification-menu .dropdown-item:hover {
        background-color: #f0f0f0;
        padding: 10px;
    }

    .btn-outline-success {
        color: #467061;
        border-color: #467061;
    }

    .btn-outline-success:hover {
        background-color: #467061;
        color: #ffffff;
    }


    /* Responsive Styling */
    @media (max-width: 768px) {
        .navbar-nav {
            display: flex;
            flex-direction: column; 
            text-align: center;
        }
        
        .btn-login {
            margin: auto;
        }

        .nav-item {
            margin: 5px 0px 5 0px;
        }

        .navbar-toggler {
            border: none;
        }

        .btn-primary, .btn-outline-primary {
            width: 100%;
        }

        .dropdown-menu {
            transform: translate(50%, 0%);
        }
    }
</style>

