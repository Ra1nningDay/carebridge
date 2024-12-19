<div class="mt-4">
            <div id="carouselIndicator1" class="carousel slide poistion-relative" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselIndicator1" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselIndicator1" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselIndicator1" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner" style="border-radius: 24px;">
                    <div class="carousel-item active" >
                        <img src="{{ asset('images/carousels/older1.png') }}" class="d-block w-100" alt="" style="height: 275px; object-fit: cover; border-radius: 24px;">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('images/carousels/older2.png') }}" class="d-block w-100" alt="" style="height: 275px; object-fit: cover; border-radius: 24px;">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('images/carousels/older3.png') }}" class="d-block w-100" alt="" style="height: 275px; object-fit: cover; border-radius: 24px;">
                    </div>
                </div>
                <div class="w-100 h-100 position-absolute top-0" style="border-radius: 24px; background-color: rgba(0, 123, 255, 0.1);">

                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 d-md-none mt-5">
        <span class="text-primary fs-5">CareBridge</span>
        <h1 class="display-3 fw-bold">Bridging Health <br> Advice with Trust</h1>
        <div class="row">
            <div class="col">
                <p class="lead fs-5 my-3">Your space for medical advice, discussions, and finding caregivers for the elderly.</p>

                <div class="d-flex pt-3">
                    <a href="{{ route('login') }}" class="btn btn-success shadow-sm btn-lg ">Join the Community</a>
                    <a href="{{ route('login') }}" class="btn btn-light shadow-sm btn-lg ms-2">More</a>
                </div>
            </div>
        </div>  
        <section class="mt-4 pt-3">
            <div class="row g-3">
                <div class="col-6 col-md-5">
                    <div class="card border-0 shadow" style="height: 110px;">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="d-flex justify-content-center align-items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor" class="mt-1 bi bi-people" viewBox="0 0 16 16">
                                        <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1zm-7.978-1L7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002-.014.002zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0M6.936 9.28a6 6 0 0 0-1.23-.247A7 7 0 0 0 5 9c-4 0-5 3-5 4q0 1 1 1h4.216A2.24 2.24 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816M4.92 10A5.5 5.5 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0m3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4"/>
                                    </svg>
                                </div>
                                <div class="d-flex flex-column justify-content-center ps-2">
                                    <span class="" style="font-weight: 600;">Our Members:</span>
                                    <span class="" style="font-size: 18px;">XXX Users</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-5">
                    <div class="card border-0 shadow" style="height: 110px;">
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
                                    <span class="" style="font-weight: 600;">Engagement:</span>
                                    <span class="" style="font-size: 18px;">XXX Views</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>