<section style="padding: 30px 0; margin-bottom: 72px; background-color: #f9f9f9;">
    <div class="container text-center">
        <h2 class="fw-bold mb-3" style="color: #003e29; font-size: 2rem;">เสียงจากผู้ใช้งาน</h2>
        <h2 class="text-muted fs-5 mb-4 pb-3" style="">ทุกความประทับใจและประสบการณ์ในการใช้งานของคุณ</h2>
        <div id="splide" class="splide">
            <div class="splide__track py-4">
                <ul class="splide__list">
                    @foreach ($testimonials as $testimonial)
                        <li class="splide__slide">
                            <div class="testimonial-card mx-auto">
                                <div class="testimonial-user">
                                    <img src="{{ $testimonial->user->avatar_url }}" alt="User Avatar" class="testimonial-avatar">
                                    <h4>{{ $testimonial->user->name }}</h4>
                                    {{-- <p class="text-muted small">{{ $testimonial->user->position }}</p> --}}
                                </div>
                               <p class="testimonial-feedback">
                                    <i class="fas fa-quote-left text-warning"></i>
                                    {{ Str::limit($testimonial->feedback, 100) }}
                                    <i class="fas fa-quote-right text-warning"></i>
                                </p>

                                <div class="testimonial-rating">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $testimonial->stars)
                                            <i class="fas fa-star text-warning"></i>
                                        @else
                                            <i class="far fa-star text-warning"></i>
                                        @endif
                                    @endfor
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</section>  

<section style="background-color: #f9f9f9; padding: 60px 0; margin-bottom: 30px; position: relative;">
    <div class="container text-center mb-5">
        <h2 class="fw-bold" style="font-size: 2.5rem; color: #003e29;">เกี่ยวกับเรา</h2>
        <div style="height: 4px; width: 80px; background-color: #467061; margin: 8px auto 24px;"></div>
    </div>
    <div class="container">
        <div class="row align-items-stretch gy-5">
            <!-- คอลัมน์ซ้าย: รูปภาพและประสบการณ์ -->
            <div class="col-12 d-none d-lg-block col-lg-6 d-flex">
                <div class="row g-4 flex-grow-1 h-100">
                    <!-- รูปภาพแรก -->
                    <div class="col-12 col-md-6">
                        <div class="position-relative h-100">
                            <img src="{{asset('images/banner/care11.png')}}" class="img-fluid rounded-3 w-100 h-100 shadow" alt="ภาพตัวอย่าง 1" style="object-fit: cover;">
                        </div>
                    </div>
                    <!-- รูปภาพที่สองและกล่องประสบการณ์ -->
                    <div class="col-12 col-md-6 d-flex flex-column gap-3 h-100">
                        <div class="position-relative flex-grow-1">
                            <img src="{{asset('images/banner/care12.png')}}" class="img-fluid rounded-3 w-100 h-100 shadow" alt="ภาพตัวอย่าง 2" style="object-fit: cover;">
                        </div>
                        <div class="position-relative bg-success text-white text-center rounded-3 shadow p-4 d-flex align-items-center justify-content-center" style="min-height: 150px; background-color: #467061;">
                            <div>
                                <h3 class="display-4 fw-bold mb-0">100%</h3>
                                <p class="fw-semibold">ความตั้งใจของทีมเรา</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- คอลัมน์ขวา: เนื้อหาและหัวข้อย่อย -->
            <div class="col-12 col-lg-6">
                <div class="card border-0 shadow-sm p-5 w-100 h-100" style="background-color: #f4f4f4;">
                    <div>
                        <h6 class="text-uppercase text-muted mb-2" style="color: #467061;">เกี่ยวกับโครงการนี้</h6>
                        <h2 class="mb-4" style="color: #003e29;">เว็บไซต์ที่สร้างขึ้นจากใจของนักศึกษา</h2>
                        <p class="text-muted mb-4" style="color: #6c757d;">
                            เราคือกลุ่มนักศึกษาที่ตั้งใจสร้างสรรค์เว็บไซต์นี้ด้วยความมุ่งมั่น เพื่อให้บริการแก่ชุมชนของเราและช่วยเหลือผู้ที่ต้องการข้อมูลและบริการที่เข้าถึงได้ง่าย เรายึดมั่นในการสร้างสรรค์เว็บไซต์ที่มีประสิทธิภาพและใช้งานง่าย
                        </p>
                    </div>
                    <ul class="list-unstyled">
                        <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-3" style="color: #467061;"></i> เน้นความง่ายในการใช้งาน</li>
                        <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-3" style="color: #467061;"></i> ออกแบบโดยใส่ใจผู้ใช้งาน</li>
                        <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-3" style="color: #467061;"></i> บริการที่ครอบคลุมและเชื่อถือได้</li>
                        <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-3" style="color: #467061;"></i> ให้ข้อมูลที่ทันสมัยและถูกต้อง</li>
                        <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-3" style="color: #467061;"></i> ส่งเสริมการศึกษาร่วมกับการให้บริการ</li>
                        <li><i class="bi bi-check-circle-fill text-success me-3" style="color: #467061;"></i> สนับสนุนชุมชนอย่างยั่งยืน</li>
                    </ul>
                    <a href="#" class="btn btn-primary text-white mt-4 py-2 fs-5" style="background: linear-gradient(135deg, #003e29, #467061); border: none;">เรียนรู้เพิ่มเติม</a>
                </div>
            </div>
        </div>
    </div>
</section>

<section style="padding: 80px 0; margin-bottom: 96px;">
    <div class="container">
        <div class="row gy-4 align-items-stretch">
            <!-- คอลัมน์ซ้าย: วิสัยทัศน์ พันธกิจ และประวัติ -->
            <div class="col-12 col-lg-6 d-flex flex-column justify-content-between">
                <div class="p-4 text-white rounded-3 shadow flex-grow-1 d-flex flex-column" style="background-color: #467061;">
                    <h5 class="mb-3"><span class="badge bg-light text-dark p-2">วิสัยทัศน์ของเรา</span></h5>
                    <p class="mb-0 mt-auto">สร้างแพลตฟอร์มที่นักศึกษาสามารถเรียนรู้และสร้างประโยชน์แก่ชุมชนของตน</p>
                </div>
                <div class="p-4 text-white rounded-3 shadow flex-grow-1 d-flex flex-column mt-4" style="background-color: #467061;">
                    <h5 class="mb-3"><span class="badge bg-light text-dark p-2">พันธกิจของเรา</span></h5>
                    <p class="mb-0 mt-auto">เรามุ่งมั่นที่จะให้บริการที่ครอบคลุมและเชื่อถือได้ และสร้างเว็บไซต์ที่เป็นประโยชน์แก่ชุมชน</p>
                </div>
                <div class="p-4 text-white rounded-3 shadow flex-grow-1 d-flex flex-column mt-4" style="background-color: #003e29;">
                    <h5 class="mb-3"><span class="badge bg-light text-dark p-2">ประวัติของเรา</span></h5>
                    <p class="mb-0 mt-auto">โครงการนี้เกิดขึ้นจากการทำงานร่วมกันของกลุ่มนักศึกษา ที่ต้องการช่วยเหลือและตอบแทนชุมชนผ่านการให้บริการที่เข้าถึงได้ง่ายและเชื่อถือได้</p>
                </div>
            </div>

            <!-- คอลัมน์ขวา: รูปภาพพร้อมข้อความซ้อน -->
            <div class="col-12 col-lg-6">
                <div class="position-relative rounded-3 overflow-hidden shadow" style="height: 550px;">
                    <img src="{{asset('images/banner/care5.png')}}" alt="ภาพตัวอย่าง" class="w-100 h-100" style="object-fit: cover;">
                    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0, 62, 41, 0.7);"></div>
                    <div class="position-absolute top-50 start-50 translate-middle text-center text-white px-4">
                        <h2>สัมผัสความสบายใจด้วยการบริการจากใจของพวกเรา</h2>
                        <p>เว็บไซต์นี้ถูกสร้างขึ้นด้วยความตั้งใจ เพื่อให้คุณได้รับประสบการณ์การใช้งานที่ดีที่สุด</p>
                        <a href="#" class="btn btn-warning text-white px-4 py-2" style="background-color: #e67e22;">ติดต่อเรา</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>







<script>
    document.addEventListener('DOMContentLoaded', function () {
        new Splide('#splide', {
            type       : 'loop',
            perPage    : 4,
            gap        : '1rem',
            speed      : 1000,         // Transition speed between slides (ms)
            interval   : 5000,         // Delay between auto scrolls (ms)
            pagination : true,
            arrows     : false,
            height     : 'auto',

            autoScroll : {
                speed: 0.5,           // Speed of scrolling (higher = slower scrolling)
                pauseOnHover: false,
                pauseOnFocus: false,
            },
            breakpoints: {
            1024: {
                perPage: 2, // จำนวน slides เมื่อหน้าจอเล็กลง
                gap    : '0.5rem',
            },
            768: {
                perPage: 1, // จำนวน slides สำหรับหน้าจอมือถือ
                gap    : '0.5rem',
                pagination: true, // ยังคงแสดงจุดกำกับ
            },
        },
        }).mount(window.splide.Extensions);
    });
</script>

<style>
    .splide__list {
        height: auto !important;
    }

    .testimonial-card {
        max-width: 400px;
        background: #ffffff;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        text-align: center;
        min-height: 256px; /* กำหนดความสูงขั้นต่ำ */
    }
    

    .testimonial-user {
        margin-bottom: 15px;
    }

    .testimonial-avatar {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        margin-bottom: 10px;
        object-fit: cover;
        border: 3px solid #467061;
    }

    .testimonial-avatar {
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* เพิ่มเงา */
    }

    .testimonial-feedback {
        font-size: 1rem;
        color: #555;
        margin: 15px 0;
        font-style: italic;
    }

    .testimonial-rating {
        margin-top: 10px;
    }

    .testimonial-rating i {
        font-size: 1.2rem;
    }

    h4 {
        font-size: 1.25rem;
        font-weight: bold;
        color: #333;
    }

    .text-muted {
        font-size: 0.9rem;
        color: #777;
    }
</style>
