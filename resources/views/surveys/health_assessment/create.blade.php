@extends('layouts.app')

@section('title', 'แบบประเมินการคัดกรองสุขภาพทั่วไป')
@section('content')
<div class="container-fluid pb-5 mb-5" style="max-width: 960px;">
    <div class="assessment-header text-center my-5">
        <h1 class="fw-bold text-primary position-relative">
            แบบประเมินความเสี่ยงสุขภาพจากฝุ่น PM 2.5
            <span class="d-block position-absolute top-100 start-50 translate-middle w-50 border-primary border-bottom"></span>
        </h1>
        <p class="text-muted fs-5">กรุณากรอกข้อมูลและตอบคำถามเพื่อประเมินความเสี่ยงสุขภาพจากฝุ่น PM 2.5</p>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->has('error'))
        <div class="alert alert-danger">
            {{ $errors->first('error') }}
        </div>
    @endif

    <!-- ฟอร์มการกรอกข้อมูลทั้งหมด -->
    <form action="{{ route('health_assessments.store') }}" method="POST">
        @csrf
        <div class="card mb-4 shadow-sm border-light rounded">
            <div class="card-header bg-primary text-white font-weight-bold rounded-top">
                <h4 class="mb-0">ข้อมูลการประเมินสุขภาพ</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    {{-- แบบประเมิน  --}}
                    <div class="col-12 col-md-8 d-flex flex-column mx-auto" style="height: 100%;">
                        <!-- Recorded By -->
                        <input type="hidden" name="recorded_by" value="{{ Auth::id() }}">

                        <!-- Hypertension Section -->
                        <div id="pm25RiskSection" class="visible-section d-flex flex-column flex-grow-1">
                            <h4 class="fw-bold">1. คุณอยู่ในพื้นที่เสี่ยงแค่ไหน?</h4>
                            <p>คุณเคยต้องอยู่ในที่ที่มีฝุ่นหนาแน่น เช่น บริเวณถนนที่รถติด อาคารก่อสร้าง หรือโรงงานไหม?</p>
                            <div>
                                <label><input type="radio" name="question1" value="ไม่เคย" required> ไม่เคย</label><br>
                                <label><input type="radio" name="question1" value="บางครั้ง"> บางครั้ง</label><br>
                                <label><input type="radio" name="question1" value="บ่อยครั้ง"> บ่อยครั้ง</label><br>
                                <label><input type="radio" name="question1" value="เกือบทุกวัน"> เกือบทุกวัน</label>
                            </div>

                            <div class="d-flex justify-content-end mt-auto">
                                <button type="button" id="nextToHealthIssues" class="btn btn-outline-primary d-flex align-items-center">
                                    <i class="bi bi-arrow-right-circle me-2"></i> ถัดไป
                                </button>
                            </div>
                        </div>

                        <!-- โรคเบาหวาน Section -->
                        <div id="diabetesSection" class="hidden-section d-flex flex-column flex-grow-1">
                            @include('surveys.health_assessment.partials.diabetes')

                            <div class="d-flex justify-content-between mt-auto">
                                <button type="button" id="prevToHypertension" class="btn btn-outline-secondary d-flex align-items-center">
                                    <i class="bi bi-arrow-left-circle me-2"></i> กลับ
                                </button>
                                <button type="button" id="nextToOralHealth" class="btn btn-outline-primary d-flex align-items-center">
                                    <i class="bi bi-arrow-right-circle me-2"></i> ถัดไป
                                </button>
                            </div>
                        </div>

                        <!-- สุขภาพช่องปาก Section -->
                        <div id="healthIssuesSection" class="hidden-section d-flex flex-column flex-grow-1">
                            <h4 class="fw-bold">2. คุณมีโรคประจำตัวหรือเปล่า?</h4>
                            <p>คุณมีโรคเหล่านี้หรือไม่?</p>
                            <div>
                                <label><input type="checkbox" name="question2[]" value="ภูมิแพ้"> ภูมิแพ้</label><br>
                                <label><input type="checkbox" name="question2[]" value="หอบหืด"> หอบหืด</label><br>
                                <label><input type="checkbox" name="question2[]" value="ปอดอุดกั้นเรื้อรัง"> ปอดอุดกั้นเรื้อรัง</label><br>
                                <label><input type="checkbox" name="question2[]" value="โรคหัวใจ"> โรคหัวใจ</label><br>
                                <label><input type="checkbox" name="question2[]" value="ไม่มีโรคประจำตัว"> ไม่มีโรคประจำตัว</label>
                            </div>

                            <div class="d-flex justify-content-between mt-auto">
                                <button type="button" id="prevToPm25Risk" class="btn btn-outline-secondary d-flex align-items-center">
                                    <i class="bi bi-arrow-left-circle me-2"></i> กลับ
                                </button>
                                <button type="button" id="nextToSymptoms" class="btn btn-outline-primary d-flex align-items-center">
                                    <i class="bi bi-arrow-right-circle me-2"></i> ถัดไป
                                </button>
                            </div>
                        </div>

                        <!-- สุขภาพตา Section -->
                       <div id="symptomsSection" class="hidden-section d-flex flex-column flex-grow-1">
                            <h4 class="fw-bold">3. ร่างกายคุณส่งสัญญาณเตือนอะไรบ้าง?</h4>
                            <p>คุณมีอาการเหล่านี้หรือไม่?</p>
                            <div>
                                <label><input type="checkbox" name="question3[]" value="หายใจติดขัด"> หายใจติดขัด แน่นหน้าอก</label><br>
                                <label><input type="checkbox" name="question3[]" value="หอบ"> หอบ หายใจเสียงดังวี้ด</label><br>
                                <label><input type="checkbox" name="question3[]" value="ไม่มีอาการ"> ไม่มีอาการ</label>
                            </div>

                            <div class="d-flex justify-content-between mt-auto">
                                <button type="button" id="prevToHealthIssues" class="btn btn-outline-secondary d-flex align-items-center">
                                    <i class="bi bi-arrow-left-circle me-2"></i> กลับ
                                </button>
                                <button type="button" id="nextToSelfProtection" class="btn btn-outline-primary d-flex align-items-center">
                                    <i class="bi bi-arrow-right-circle me-2"></i> ถัดไป
                                </button>
                            </div>
                        </div>

                        <div id="selfProtectionSection" class="hidden-section d-flex flex-column flex-grow-1">
                            <h4 class="fw-bold">4. คุณป้องกันตัวเองดีแค่ไหน?</h4>
                            <p>เวลาคุณออกจากบ้าน คุณสวมหน้ากากไหม?</p>
                            <div>
                                <label><input type="radio" name="question4" value="สวมทุกครั้ง" required> สวมทุกครั้ง</label><br>
                                <label><input type="radio" name="question4" value="สวมบางครั้ง"> สวมบางครั้ง</label><br>
                                <label><input type="radio" name="question4" value="ไม่สวมเลย"> ไม่สวมเลย</label>
                            </div>

                            <div class="d-flex justify-content-between mt-auto">
                                <button type="button" id="prevToSymptoms" class="btn btn-outline-secondary d-flex align-items-center">
                                    <i class="bi bi-arrow-left-circle me-2"></i> กลับ
                                </button>
                                <button type="submit" class="btn btn-outline-success d-flex align-items-center">
                                    <i class="bi bi-check-circle me-2"></i> ส่งแบบประเมิน
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- ผู้สูงอายุ --}}
                    <div class="col-md-4" style="padding-top: 20px;">
                        <div class="d-flex flex-column h-100">
                            <div class="form-group mb-4" >
                                <label for="elder_id" class="form-label">ผู้สูงอายุที่ต้องการประเมิน:</label>
                                <select name="user_id" id="user_id" class="form-select" required>
                                    <option value="" selected disabled>กรุณาเลือกผู้สูงอายุ</option>
                                    @foreach ($elders as $elder)
                                        <option value="{{ $elder->id }}" 
                                                data-image="{{ $elder->avatar_url }}"
                                                data-name="{{ $elder->name }}"
                                                data-age="{{ \Carbon\Carbon::parse($elder->personalInfo->date_of_birth)->age }}"
                                                data-gender="@if ($elder->personalInfo && $elder->personalInfo->gender)
                                                                @if ($elder->personalInfo->gender === 'male')
                                                                    ชาย
                                                                @elseif ($elder->personalInfo->gender === 'female')
                                                                    หญิง
                                                                @else
                                                                    ไม่ระบุ
                                                                @endif
                                                            @else
                                                                N/A
                                                            @endif"
                                                data-last-assessment="@if ($elder->healthAssessment && $elder->healthAssessment->isNotEmpty()) 
                                                                        {{ $elder->healthAssessment->sortByDesc('created_at')->first()->created_at }}
                                                                    @else
                                                                        ยังไม่ได้ตรวจ
                                                                    @endif">
                                            {{ $elder->name }}  
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- ที่จะแสดงรูปโปรไฟล์ -->
                            <div id="elderProfileImage" class="" style="display:none; text-align: center;">
                                <img id="profileImage" src="" alt="Profile Image" class="img-fluid rounded-circle" style="max-width: 150px; height: auto;" />
                            </div>

                            <!-- ข้อมูลผู้สูงอายุ -->
                            <div id="elderDetails" class="mt-3" style="display:none;">
                                <p><strong>ชื่อ:</strong> <span id="elderName"></span></p>
                                <p><strong>อายุ:</strong> <span id="elderAge"></span> ปี</p>
                                <p><strong>เพศ:</strong> <span id="elderGender"></span></p>
                                <p><strong>ครั้งที่ตรวจสุขภาพล่าสุด:</strong> <span id="lastAssessmentDate"></span></p>
                            </div>

                            <!-- Progress Bar -->
                            <div class="progress my-4">
                                <div id="progressBar" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>

                            <!-- ปุ่มสำหรับแสดงคำแนะนำ -->
                            <div class="d-flex justify-content-end mt-auto">
                                <button type="button" id="showHealthTipsBtn" class="btn btn-outline-warning d-flex align-items-center">
                                    <i class="bi bi-info-circle me-2"></i> คำแนะนำเบื้องต้น
                                </button>
                            </div>

                            <!-- Popup คำแนะนำ -->
                            <div id="healthTipsPopup" class="popup-container">
                                <div class="popup-content bg-light p-4 border rounded shadow-sm">
                                    <h6 class="fw-semibold text-success">
                                        <i class="bi bi-pencil-square me-2"></i> คำแนะนำเบื้องต้นในการทำแบบประเมินผู้สูงอายุ
                                    </h6>

                                    <p>การทำแบบประเมินสำหรับผู้สูงอายุช่วยให้คุณทราบถึงความต้องการในการดูแลและปัญหาสุขภาพที่อาจเกิดขึ้น เพื่อการให้คำแนะนำและการดูแลที่เหมาะสม ข้อแนะนำเบื้องต้นในการทำแบบประเมินมีดังนี้:</p>

                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">
                                            <i class="bi bi-check-circle me-2"></i><strong>เก็บข้อมูลเบื้องต้นของผู้สูงอายุ</strong> เช่น ชื่อ อายุ และประวัติสุขภาพ
                                        </li>
                                        <li class="list-group-item">
                                            <i class="bi bi-check-circle me-2"></i><strong>ทำความเข้าใจเกี่ยวกับสภาพสุขภาพในปัจจุบัน</strong> เช่น โรคประจำตัวหรือปัญหาสุขภาพที่สำคัญ
                                        </li>
                                        <li class="list-group-item">
                                            <i class="bi bi-check-circle me-2"></i><strong>ประเมินความสามารถในการทำกิจกรรมต่างๆ</strong> เช่น การเคลื่อนไหว การทานอาหาร หรือการออกกำลังกาย
                                        </li>
                                        <li class="list-group-item">
                                            <i class="bi bi-check-circle me-2"></i><strong>ดูแลเรื่องอารมณ์และจิตใจ</strong> สำรวจสภาวะจิตใจและความเครียดของผู้สูงอายุ
                                        </li>
                                        <li class="list-group-item">
                                            <i class="bi bi-check-circle me-2"></i><strong>ติดตามผลอย่างสม่ำเสมอ</strong> ควรมีการติดตามและประเมินผลการดูแลผู้สูงอายุเพื่อพัฒนาแผนการดูแลอย่างเหมาะสม
                                        </li>
                                    </ul>

                                    <p class="mt-3 text-muted"><strong>หมายเหตุ:</strong> โปรดปรึกษาผู้เชี่ยวชาญในการประเมินและการดูแลผู้สูงอายุเพื่อให้การดูแลดีที่สุด</p>

                                    <button type="button" id="closeHealthTipsPopup" class="btn btn-outline-danger mt-3 d-flex align-items-center">
                                        <i class="bi bi-x-circle me-2"></i> ปิด
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- Carousel with Health Tips -->
    <div id="healthTipsCarousel" class="carousel slide mt-4" data-bs-ride="carousel">
        <!-- Indicators -->
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#healthTipsCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#healthTipsCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#healthTipsCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
            <button type="button" data-bs-target="#healthTipsCarousel" data-bs-slide-to="3" aria-label="Slide 4"></button>
        </div>

        <div class="carousel-inner">
            <!-- Health Tips for Caregivers - Hypertension -->
            <div class="carousel-item active">
                <div class="d-flex justify-content-center align-items-center flex-column" style="min-height: 400px;">
                    <div class="card text-center bg-light p-5 mb-2 w-75 shadow rounded">
                        <h5 class="text-success fw-semibold mb-2">
                            <i class="fas fa-heartbeat"></i> การดูแลความดันโลหิตในผู้สูงอายุ
                        </h5>
                        <p>การรักษาความดันโลหิตในผู้สูงอายุเป็นเรื่องที่สำคัญ ควรตรวจสุขภาพสม่ำเสมอและหมั่นติดตามข้อมูลอย่างใกล้ชิด</p>
                        <ul class="text-start">
                            <li>แนะนำให้ควบคุมอาหารที่มีโซเดียมสูง</li>
                            <li>ออกกำลังกายเป็นประจำเพื่อช่วยปรับความดัน</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Health Tips for Caregivers - Heart Disease -->
            <div class="carousel-item">
                <div class="d-flex justify-content-center align-items-center flex-column" style="min-height: 400px;">
                    <div class="card text-center bg-light p-5 mb-2 w-75 shadow rounded">
                        <h5 class="text-danger fw-semibold mb-2">
                            <i class="fas fa-heart"></i> การดูแลสุขภาพโรคหัวใจ
                        </h5>
                        <p>โรคหัวใจเป็นโรคที่พบบ่อยในผู้สูงอายุ ต้องให้ความสำคัญกับการดูแลสุขภาพหัวใจอย่างต่อเนื่อง</p>
                        <ul class="text-start">
                            <li>ให้คำแนะนำเกี่ยวกับการควบคุมอาหารที่มีไขมันสูง</li>
                            <li>หลีกเลี่ยงการเครียด และสนับสนุนให้มีการพักผ่อนที่เพียงพอ</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Health Tips for Caregivers - Diabetes -->
            <div class="carousel-item">
                <div class="d-flex justify-content-center align-items-center flex-column" style="min-height: 400px;">
                    <div class="card text-center bg-light p-5 mb-2 w-75 shadow rounded">
                        <h5 class="text-primary fw-semibold mb-2">
                            <i class="fas fa-tint"></i> การดูแลโรคเบาหวานในผู้สูงอายุ
                        </h5>
                        <p>ควรตรวจวัดระดับน้ำตาลในเลือดอย่างสม่ำเสมอและการควบคุมอาหารที่เป็นประโยชน์</p>
                        <ul class="text-start">
                            <li>การรับประทานอาหารที่มีกากใยสูงและน้ำตาลต่ำ</li>
                            <li>การออกกำลังกายที่สม่ำเสมอและเหมาะสม</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Health Tips for Caregivers - Oral and Eye Health -->
            <div class="carousel-item">
                <div class="d-flex justify-content-center align-items-center flex-column" style="min-height: 400px;">
                    <div class="card text-center bg-light p-5 mb-2 w-75 shadow rounded">
                        <h5 class="text-info fw-semibold mb-2">
                            <i class="fas fa-eye"></i> การดูแลสุขภาพปากและตา
                        </h5>
                        <p>การรักษาสุขภาพช่องปากและตาเป็นส่วนสำคัญในผู้สูงอายุ เพื่อให้คุณภาพชีวิตดีขึ้น</p>
                        <ul class="text-start">
                            <li>แนะนำให้ทำความสะอาดช่องปากและฟันหลังมื้ออาหาร</li>
                            <li>หมั่นตรวจสุขภาพตาเพื่อป้องกันโรคตาที่พบบ่อยในผู้สูงอายุ</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Carousel Controls -->
        <button class="carousel-control-prev" type="button" data-bs-target="#healthTipsCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#healthTipsCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>

<style>
    
    /* Custom CSS for Carousel */
    #healthTipsCarousel .carousel-indicators button {
        background-color: #5b8c2a;
        border: none;
        opacity: 0.5;
        transition: opacity 0.3s;
    }

    #healthTipsCarousel .carousel-indicators .active {
        background-color: #1a7e34;
        opacity: 1; 
        margin-bottom: 20px;
    }

    /* Adjust Card styling for a cleaner look */
    #healthTipsCarousel .carousel-item .card {
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        transition: transform 0.3s ease-in-out;
    }

    /* #healthTipsCarousel .carousel-item .card:hover {
        transform: translateY(-5px);
    } */

    /* Responsive Design */
    @media (max-width: 768px) {
        #healthTipsCarousel .carousel-item .card {
            width: 90%;
        }

        #healthTipsCarousel .carousel-indicators button {
            width: 12px;
            height: 12px;
        }
    }

    @media (max-width: 576px) {
        #healthTipsCarousel .carousel-item .card {
            width: 95%;
        }
    }

    /* เพิ่ม margin ให้ระหว่างข้อความและไอคอน */
    .btn i, .list-group-item i {
        font-size: 1.2rem;
    }

    /* ปรับรูปแบบปุ่ม */
    .btn {
        display: flex;
        align-items: center;
    }

    .btn-outline-success {
        background-color: #e7f8e5;
        color: #5f9a74;
    }

    .btn-outline-warning {
        background-color: #ffc107; /* ตัวอย่าง: สีเหลืองสำหรับ background */
        color: #fff; /* ตัวอย่าง: สีขาวสำหรับข้อความ */
    }
/* 
    .btn-outline-warning:hover {
        background-color: #e0a800; 
        color: #fff;
    } */

    .btn-primary {
        background-color: #007bff;
        color: white;
    }
    .btn-outline-danger {
        color: #d9534f;
    }

    /* สไตล์สำหรับ list item */
    .list-group-item {
        display: flex;
        align-items: center;
        font-size: 1rem;
        padding: 10px;
    }

    .list-group-item i {
        font-size: 1.25rem;
        margin-right: 10px;
        color: #28a745; /* สำหรับการแสดงสีไอคอน */
    }
    
    .popup-container {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        align-items: center;
        justify-content: center;
        z-index: 1000;
        background-color: rgba(0, 0, 0, 0.5);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .popup-container.show {
        display: flex;
        opacity: 1;
    }

    .popup-content {
        width: 80%;
        max-width: 800px;
        margin: auto;
        transform: translateY(100px);
        animation: slideUp 0.5s forwards;
        overflow-y: auto;
        max-height: 70vh; /* กำหนดความสูงสูงสุด 80% ของหน้าจอ */
    }

    @keyframes slideUp {
        0% {
            transform: translateY(100px);
        }
        100% {
            transform: translateY(0);
        }
    }

    /* ซ่อนส่วน */
    .hidden-section {
        visibility: hidden; /* ซ่อนองค์ประกอบ */
        opacity: 0; /* ทำให้ไม่เห็น */
        pointer-events: none; /* ป้องกันไม่ให้โต้ตอบ */
        position: absolute; /* จัดให้อยู่ในตำแหน่งเดียวกัน */
        z-index: -1; /* ทำให้ซ่อนอยู่เบื้องหลัง */
        height: 0; /* กำหนดให้ความสูงเป็นศูนย์ในขณะที่ซ่อน */
        overflow: hidden; /* ป้องกันการ overflow */
        transition: height 0.3s ease, opacity 0.3s ease; /* เพิ่ม transition สำหรับอนิเมชั่น */
    }

    /* แสดงส่วน */
    .visible-section {
        visibility: visible; /* ทำให้แสดง */
        opacity: 1; /* กลับมาเห็น */
        pointer-events: auto; /* อนุญาตให้โต้ตอบ */
        position: relative; /* ให้แสดงตำแหน่งตามปกติ */
        z-index: 1; /* ให้อยู่ด้านหน้าของส่วนอื่น */
        height: auto; /* ให้ความสูงตามความสูงที่เนื้อหาต้องการ */
        transition: height 0.3s ease, opacity 0.3s ease; /* เพิ่ม transition สำหรับอนิเมชั่น */
    }



    /* CSS for smooth transitions */
    .visible-section, .hidden-section {
        transition: opacity 0.5s ease-in-out, visibility 0s linear 0.5s; /* เพิ่ม transition สำหรับ visibility ให้มันพร้อมกันกับ opacity */
    }

    .progress-bar {
        transition: width 0.5s ease-in-out;
    }

    .question-block {
        background-color: #f7f9fb;
        border-radius: 10px;
        padding: 20px;
    }

    .question-block h5 {
        font-size: 1.5rem;
    }

    .question-block p {
        font-size: 1rem;
    }

    .form-select, .form-control {
        font-size: 1.1rem;
        border-radius: 8px;
        padding: 12px;
    }

    .form-group label {
        font-weight: 500;
        font-size: 1rem;
        color: #555;
    }

    .form-control-lg {
        padding: 10px;
    }
    
    .form-control:focus, .form-select:focus {
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, .25);
        border-color: #007bff;
    }
</style>

<script>
    // Show and hide the health tips popup
    document.getElementById('showHealthTipsBtn').addEventListener('click', function() {
        document.getElementById('healthTipsPopup').classList.add('show');
    });

    document.getElementById('closeHealthTipsPopup').addEventListener('click', function() {
        document.getElementById('healthTipsPopup').classList.remove('show');
    });

    // Update elder information when selected
    document.getElementById('user_id').addEventListener('change', function () {
        const selectedOption = this.options[this.selectedIndex];
        document.getElementById('elderName').textContent = selectedOption.getAttribute('data-name');
        document.getElementById('elderAge').textContent = selectedOption.getAttribute('data-age');
        document.getElementById('elderGender').textContent = selectedOption.getAttribute('data-gender');
        document.getElementById('lastAssessmentDate').textContent = selectedOption.getAttribute('data-last-assessment');
        document.getElementById('profileImage').src = selectedOption.getAttribute('data-image');
        document.getElementById('elderProfileImage').style.display = 'block';
        document.getElementById('elderDetails').style.display = 'block';
    });

    // Functions to show and hide sections with transitions
    function showNextSection(currentSection, nextSection, progressValue) {
        currentSection.classList.remove('visible-section');
        currentSection.classList.add('hidden-section');
        setTimeout(() => {
            nextSection.classList.remove('hidden-section');
            nextSection.classList.add('visible-section');
            updateProgress(progressValue);
        }, 500);
    }

    function showPrevSection(currentSection, prevSection, progressValue) {
        currentSection.classList.remove('visible-section');
        currentSection.classList.add('hidden-section');
        setTimeout(() => {
            prevSection.classList.remove('hidden-section');
            prevSection.classList.add('visible-section');
            updateProgress(progressValue);
        }, 500);
    }

    // Update the progress bar
    function updateProgress(progressValue) {
        const progressBar = document.getElementById('progressBar');
        progressBar.style.transition = 'width 0.5s ease';
        progressBar.style.width = `${progressValue}%`;
        progressBar.setAttribute('aria-valuenow', progressValue);
    }

    // Section navigation for PM2.5 assessment
    document.getElementById('nextToHealthIssues').addEventListener('click', function() {
        const pm25RiskSection = document.getElementById('pm25RiskSection');
        const healthIssuesSection = document.getElementById('healthIssuesSection');
        showNextSection(pm25RiskSection, healthIssuesSection, 50); // 50% Progress
    });

    document.getElementById('nextToSymptoms').addEventListener('click', function() {
        const healthIssuesSection = document.getElementById('healthIssuesSection');
        const symptomsSection = document.getElementById('symptomsSection');
        showNextSection(healthIssuesSection, symptomsSection, 75); // 75% Progress
    });

    document.getElementById('nextToSelfProtection').addEventListener('click', function() {
        const symptomsSection = document.getElementById('symptomsSection');
        const selfProtectionSection = document.getElementById('selfProtectionSection');
        showNextSection(symptomsSection, selfProtectionSection, 100); // 100% Progress
    });

    document.getElementById('prevToPm25Risk').addEventListener('click', function() {
        const healthIssuesSection = document.getElementById('healthIssuesSection');
        const pm25RiskSection = document.getElementById('pm25RiskSection');
        showPrevSection(healthIssuesSection, pm25RiskSection, 25); // 25% Progress
    });

    document.getElementById('prevToHealthIssues').addEventListener('click', function() {
        const symptomsSection = document.getElementById('symptomsSection');
        const healthIssuesSection = document.getElementById('healthIssuesSection');
        showPrevSection(symptomsSection, healthIssuesSection, 50); // 50% Progress
    });

    document.getElementById('prevToSymptoms').addEventListener('click', function() {
        const selfProtectionSection = document.getElementById('selfProtectionSection');
        const symptomsSection = document.getElementById('symptomsSection');
        showPrevSection(selfProtectionSection, symptomsSection, 75); // 75% Progress
    });
</script>
@endsection
