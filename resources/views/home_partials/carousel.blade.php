<div class="container-fluid" style="max-width: 1320px;">
        <div class="row justify-content-center" style="margin-bottom: 72px;">
            <!-- Mobile Device (Small Screens) -->
            <div class="col-12 d-md-none">
                <!-- Carousel for Mobile -->
                <div id="carouselIndicator1" class="carousel slide mt-4" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselIndicator1" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselIndicator1" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselIndicator1" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner" style="border-radius: 24px;">
                        <div class="carousel-item active">
                            <img src="{{ asset('images/banner/care7.png') }}" loading="lazy" class="d-block w-100" alt="Banner 1" style="height: 275px; object-fit: cover; border-radius: 24px;">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('images/banner/care8.png') }}" loading="lazy" class="d-block w-100" alt="Banner 2" style="height: 275px; object-fit: cover; border-radius: 24px;">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('images/banner/care9.png') }}" loading="lazy" class="d-block w-100" alt="Banner 3" style="height: 275px; object-fit: cover; border-radius: 24px;">
                        </div>
                    </div>
                </div>

                <!-- Text Section for Mobile -->
                <div class="mt-5 text-center">
                    <span class="text-primary fs-5">CareBridge</span>
                    <h1 class="display-4 fw-bold">สะพานเชื่อมโยงสู่สังคมผู้สูงอายุ</h1>
                    <p class="lead fs-5 my-3">พื้นที่ที่ใส่ใจคุณและคนที่คุณรัก แหล่งรวมคำแนะนำทางการแพทย์ การพูดคุยอย่างอบอุ่น และค้นหาผู้ดูแลที่เหมาะสมสำหรับผู้สูงอายุของคุณ</p>
                    <div class="d-flex justify-content-center pt-3">
                        <a href="{{ route('login') }}" class="btn btn-join shadow-sm btn-lg">เข้าร่วมชุมชน</a>
                        <a href="{{ route('login') }}" class="btn btn-light shadow-sm btn-lg ms-2">เรียนรู้เพิ่มเติม</a>
                    </div>
                </div>

                <!-- Statistics Cards -->
                <div class="row g-3 mt-4">
                    <!-- Member Count Card -->
                    <div class="col-6">
                        <div class="card p-0 border-0 shadow">
                            <div class="card-body d-flex align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor" class="bi bi-people" viewBox="0 0 16 16">
                                    <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1z"></path>
                                    <path d="M7.022 13H7a1 1 0 0 1 1-1h5a1 1 0 0 1 1 1H7zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"></path>
                                </svg>
                                <div class="ps-3">
                                    <span class="fw-bold">จำนวนสมาชิก:</span>
                                    <p class="mb-0">{{ $memberCount }} คน</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- View Count Card -->
                    <div class="col-6">
                        <div class="card p-0 border-0 shadow">
                            <div class="card-body d-flex align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
                                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                                </svg>
                                <div class="ps-3">
                                    <span class="fw-bold">สถิติการเข้าชม:</span>
                                    <p class="mb-0">{{ $visitCount }} วิว</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>




            <div class="col-md-6 d-none d-md-block pt-3" style="margin-top: 75px;">
                <span class="text-primary fs-5">CareBridge</span>
                <h1 class="display-3 fw-bold" style="color:#003e29"><span style="">สะพาน</span>เชื่อม<br>สู่สังคมผู้สูงอายุ</h1>
                <div class="row">
                    <div class="col">
                        <p class="lead fs-5 my-3" style="color: #333">พื้นที่ที่ใส่ใจคุณและคนที่คุณรัก แหล่งรวมคำแนะนำทางการแพทย์ การพูดคุยอย่างอบอุ่น และค้นหาผู้ดูแลที่เหมาะสมสำหรับผู้สูงอายุของคุณ</p>

                        <div class="d-flex align-items-center pt-3">
                            <a href="{{ route('login') }}" class="btn btn-join btn-lg shadow-sm" 
                                style="background: linear-gradient(135deg, #f39c12, #e67e22); color: #ffffff; border-radius: 8px; padding: 12px 24px; transition: all 0.3s ease;">
                                เข้าร่วมชุนชน
                            </a>
                            <a href="{{ route('login') }}" class="btn btn-light shadow-sm btn-lg ms-2">เรียนรู้เพิ่มเติม</a>
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-3">
                    <div class="row g-3">
                        <div class="col-6 col-md-5">
                            <div class="card border-0 shadow p-1" style="height: 110px;">
                                <div class="card-body">
                                    <!-- Content for card 1 -->
                                    <div class="d-flex">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor" class="mt-1 bi bi-people" viewBox="0 0 16 16">
                                                <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1zm-7.978-1L7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002-.014.002zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0M6.936 9.28a6 6 0 0 0-1.23-.247A7 7 0 0 0 5 9c-4 0-5 3-5 4q0 1 1 1h4.216A2.24 2.24 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816M4.92 10A5.5 5.5 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0m3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4"/>
                                            </svg>
                                        </div>
                                        <div class="d-flex flex-column justify-content-center ps-2">
                                            <span class="fs-5" style="font-weight: 600;">จำนวนสมาชิก:</span>
                                            <span class="" style="font-size: 18px;">{{ $memberCount }} คน</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-5">
                            <div class="card border-0 shadow p-1" style="height: 110px;">
                                <div class="card-body">
                                    <!-- Content for card 2 -->
                                    <div class="d-flex">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor" class="mt-1 bi bi-eye" viewBox="0 0 16 16">
                                                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
                                                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                                            </svg>
                                        </div>
                                        <div class="d-flex flex-column justify-content-center ps-2">
                                            <span class="fs-5" style="font-weight: 600;">สถิติการเข้าชม:</span>
                                            <span class="" style="font-size: 18px;">{{ $visitCount }} วิว</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 d-none d-md-block mt-2">
                <div class="mt-4">
                    <div id="carouselIndicator2" class="carousel slide poistion-relative" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselIndicator2" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselIndicator2" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carouselIndicator2" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner" style="border-radius: 24px;">
                            <div class="carousel-item active" >
                                <img src="{{ asset('images/banner/care7.png') }}" loading="lazy" class="d-block w-100" alt="" style="height: 570px; object-fit: cover; border-radius: 24px;">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('images/banner/care8.png') }}" loading="lazy" class="d-block w-100" alt="" style="height: 570px; object-fit: cover; border-radius: 24px;">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('images/banner/care9.png') }}" loading="lazy" class="d-block w-100" alt="" style="height: 570px; object-fit: cover; border-radius: 24px;">
                            </div>
                        </div>
                        <div class="w-100 h-100 position-absolute top-0" style="border-radius: 24px; background-color: rgba(0, 123, 255, 0.1);">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<style>
    /* Specific styles for the Join button */
    .btn-join {
        background: linear-gradient(135deg, #f39c12, #e67e22);
        color: #ffffff;
        border-radius: 8px;
        padding: 12px 24px;
        transition: all 0.3s ease;
    }
    .btn-join:hover {
        background: linear-gradient(135deg, #e67e22, #f39c12);
        color: #ffffff;
        transform: scale(1.05);
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
    }
</style>