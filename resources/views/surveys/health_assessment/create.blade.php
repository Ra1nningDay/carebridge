@extends('layouts.app')

@section('title', 'แบบประเมินการคัดกรองสุขภาพทั่วไป')
@section('content')
<div class="container-fluid pb-5 mb-5" style="max-width: 960px;">
    <div class="assessment-header text-center my-5">
        <h1 class="fw-bold text-primary position-relative">
            แบบประเมินการคัดกรองสุขภาพทั่วไป
            <span class="d-block position-absolute top-100 start-50 translate-middle w-50 border-primary border-bottom"></span>
        </h1>
        <p class="text-muted fs-5">กรุณากรอกข้อมูลและตอบคำถามเพื่อประเมินเบื้องต้น</p>
    </div>

    <!-- ฟอร์มการกรอกข้อมูลทั้งหมด -->
    <form action="{{ route('health_assessments.store') }}" method="POST">
        @csrf
        <div class="card mb-4 shadow-sm border-light rounded">
            <div class="card-header bg-primary text-white font-weight-bold rounded-top">
                <h4 class="mb-0">ข้อมูลการประเมินสุขภาพ</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-8">
                        <!-- Recorded By -->
                        <input type="hidden" name="recorded_by" value="{{ Auth::id() }}">

                        <!-- Hypertension Section -->
                        <div id="hypertensionSection" class="hidden-section visible-section">
                            @include('surveys.health_assessment.partials.hypertension')

                            <div class="d-flex justify-content-end mt-4">
                                <button type="button" id="nextToDiabetes" class="btn btn-outline-primary d-flex align-items-center">
                                    <i class="bi bi-arrow-right-circle me-2"></i> ถัดไป
                                </button>
                            </div>
                        </div>

                
                        <!-- โรคเบาหวาน Section -->
                        <div id="diabetesSection" class="hidden-section">
                            @include('surveys.health_assessment.partials.diabetes')
                            <!-- ปุ่มก่อนหน้าและถัดไป -->
                            <div class="d-flex justify-content-between mt-4">
                                <button type="button" id="prevToHypertension" class="btn btn-outline-secondary d-flex align-items-center">
                                    <i class="bi bi-arrow-left-circle me-2"></i> กลับ
                                </button>
                                <button type="button" id="nextToOralHealth" class="btn btn-outline-primary d-flex align-items-center">
                                    <i class="bi bi-arrow-right-circle me-2"></i> ถัดไป
                                </button>
                            </div>
                        </div>

                        <!-- สุขภาพช่องปาก Section -->
                        <div id="oralHealthSection" class="hidden-section">
                            @include('surveys.health_assessment.partials.oral_health')

                            <!-- ปุ่มก่อนหน้าและถัดไป -->
                            <div class="d-flex justify-content-between mt-4">
                                <button type="button" id="prevToDiabetes" class="btn btn-outline-secondary d-flex align-items-center">
                                    <i class="bi bi-arrow-left-circle me-2"></i> กลับ
                                </button>
                                <button type="button" id="nextToEyeHealth" class="btn btn-outline-primary d-flex align-items-center">
                                    <i class="bi bi-arrow-right-circle me-2"></i> ถัดไป
                                </button>
                            </div>
                        </div>


                        <!-- สุขภาพตา Section -->
                        <div id="eyeHealthSection" class="hidden-section">
                            @include('surveys.health_assessment.partials.eye_health')

                            <!-- ปุ่มกลับและส่งแบบประเมิน -->
                            <div class="d-flex justify-content-between align-items-center mt-4">
                                <!-- ปุ่มกลับ -->
                                <button type="button" id="prevToOral" class="btn btn-outline-secondary d-flex align-items-center">
                                    <i class="bi bi-arrow-left-circle me-2"></i> กลับ
                                </button>

                                <!-- ปุ่มบันทึกข้อมูล -->
                                <button type="submit" class="btn btn-outline-success d-flex align-items-center">
                                    <i class="bi bi-check-circle me-2"></i> ส่งแบบประเมิน
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4" style="padding-top: 20px;">
                        <div class="d-flex flex-column h-100">
                            <div class="form-group mb-4" >
                                <label for="elder_id" class="form-label">ผู้สูงอายุที่ต้องการประเมิน:</label>
                                <select name="elder_id" id="elder_id" class="form-select" required>
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
                                                            @endif">
                                            {{ $elder->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- ที่จะแสดงรูปโปรไฟล์ -->
                            <div id="elderProfileImage" class="mt-3 mb-4" style="display:none; text-align: center;">
                                <img id="profileImage" src="" alt="Profile Image" class="img-fluid rounded-circle" style="max-width: 150px; height: auto;" />
                            </div>

                            <!-- ข้อมูลผู้สูงอายุ -->
                            <div id="elderDetails" class="mt-3" style="display:none;">
                                <p><strong>ชื่อ:</strong> <span id="elderName"></span></p>
                                <p><strong>อายุ:</strong> <span id="elderAge"></span> ปี</p>
                                <p><strong>เพศ:</strong> <span id="elderGender"></span></p>
                            </div>

                            <!-- Progress Bar -->
                            <div class="progress my-4">
                                <div id="progressBar" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>

                            <!-- ปุ่มสำหรับแสดงคำแนะนำ -->
                            <div class="d-flex justify-content-end mt-auto">
                                <button type="button" id="showHealthTipsBtn" class="btn btn-outline-success d-flex align-items-center">
                                    <i class="bi bi-info-circle me-2"></i> ดูคำแนะนำในการดูแล
                                </button>
                            </div>

                            <!-- Popup คำแนะนำ -->
                            <div id="healthTipsPopup" class="popup-container">
                                <div class="popup-content bg-light p-4 border rounded shadow-sm">
                                    <h6 class="fw-semibold text-success">
                                        <i class="bi bi-person-check me-2"></i> คำแนะนำเบื้องต้นในการดูแลผู้สูงอายุที่มีความดันโลหิตสูง
                                    </h6>

                                    <p>การดูแลความดันโลหิตในผู้สูงอายุถือเป็นสิ่งสำคัญในการป้องกันปัญหาสุขภาพจากโรคหัวใจ หรือโรคหลอดเลือดสมอง ข้อแนะนำหลักๆ คือ:</p>

                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">
                                            <i class="bi bi-heart me-2"></i><strong>ตรวจวัดความดันโลหิตสม่ำเสมอ</strong> ทุก 1-2 สัปดาห์
                                        </li>
                                        <li class="list-group-item">
                                            <i class="bi bi-heart me-2"></i><strong>ควบคุมน้ำหนัก</strong> การลดน้ำหนักสามารถช่วยควบคุมความดันได้
                                        </li>
                                        <li class="list-group-item">
                                            <i class="bi bi-heart me-2"></i><strong>ควบคุมอาหาร</strong> หลีกเลี่ยงอาหารโซเดียมสูง และอาหารที่ทำให้ความดันสูง
                                        </li>
                                        <li class="list-group-item">
                                            <i class="bi bi-heart me-2"></i><strong>ออกกำลังกายสม่ำเสมอ</strong> อย่างน้อย 30 นาที 5 วัน/สัปดาห์
                                        </li>
                                        <li class="list-group-item">
                                            <i class="bi bi-heart me-2"></i><strong>ผ่อนคลายความเครียด</strong> โดยการทำสมาธิหรือการพักผ่อน
                                        </li>
                                    </ul>

                                    <p class="mt-3 text-muted"><strong>หมายเหตุ:</strong> ติดตามคำแนะนำของแพทย์และดูแลความดันโลหิตเพื่อลดความเสี่ยงในอนาคต</p>

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
</div>

<style>
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
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .popup-container.show {
        display: flex;
        opacity: 1;
    }

    .popup-content {
        width: 80%;
        max-width: 500px;
        margin: auto;
        transform: translateY(100px);
        animation: slideUp 0.5s forwards;
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
    document.getElementById('showHealthTipsBtn').addEventListener('click', function() {
        document.getElementById('healthTipsPopup').classList.add('show');
    });

    document.getElementById('closeHealthTipsPopup').addEventListener('click', function() {
        document.getElementById('healthTipsPopup').classList.remove('show');
    });

    // เมื่อมีการเลือกผู้สูงอายุ
    document.getElementById('elder_id').addEventListener('change', function () {
        var selectedOption = this.options[this.selectedIndex];
        var elderName = selectedOption.getAttribute('data-name');
        var elderAge = selectedOption.getAttribute('data-age');
        var elderGender = selectedOption.getAttribute('data-gender');
        var elderImage = selectedOption.getAttribute('data-image');

        // แสดงข้อมูลผู้สูงอายุ
        document.getElementById('elderName').textContent = elderName;
        document.getElementById('elderAge').textContent = elderAge;
        document.getElementById('elderGender').textContent = elderGender;

        // แสดงรูปโปรไฟล์
        document.getElementById('profileImage').src = elderImage;
        document.getElementById('elderProfileImage').style.display = 'block';
        document.getElementById('elderDetails').style.display = 'block';
    });

    function showNextSection(currentSection, nextSection, progressValue) {
        currentSection.classList.remove('visible-section');
        currentSection.classList.add('hidden-section');
            
        setTimeout(function() {
            nextSection.classList.remove('hidden-section');
            nextSection.classList.add('visible-section');

            // อัพเดต Progress Bar
            let progressBar = document.getElementById('progressBar');
            progressBar.style.transition = 'width 0.5s ease'; // ทำให้การเคลื่อนไหวของ ProgressBar นุ่มขึ้น
            progressBar.style.width = progressValue + '%';
            progressBar.setAttribute('aria-valuenow', progressValue);
        }, 500);
    }

    function showPrevSection(currentSection, prevSection, progressValue) {
        currentSection.classList.remove('visible-section');
        currentSection.classList.add('hidden-section');
            
        setTimeout(function() {
            prevSection.classList.remove('hidden-section');
            prevSection.classList.add('visible-section');

            let progressBar = document.getElementById('progressBar');
            progressBar.style.transition = 'width 0.5s ease';
            progressBar.style.width = progressValue + '%';
            progressBar.setAttribute('aria-valuenow', progressValue);
        }, 500);
    }

    // เมื่อคลิก "ถัดไป" ในแต่ละส่วน
    document.getElementById('nextToDiabetes').addEventListener('click', function() {
        var hypertensionSection = document.getElementById('hypertensionSection');
        var diabetesSection = document.getElementById('diabetesSection');
        showNextSection(hypertensionSection, diabetesSection, 50);  // 50% Progress
    });

    document.getElementById('nextToOralHealth').addEventListener('click', function() {
        var diabetesSection = document.getElementById('diabetesSection');
        var oralHealthSection = document.getElementById('oralHealthSection');
        showNextSection(diabetesSection, oralHealthSection, 75);  // 75% Progress
    });

    document.getElementById('nextToEyeHealth').addEventListener('click', function() {
        var oralHealthSection = document.getElementById('oralHealthSection');
        var eyeHealthSection = document.getElementById('eyeHealthSection');
        showNextSection(oralHealthSection, eyeHealthSection, 100);  // 100% Progress
    });

    // เมื่อคลิก "กลับ" ในแต่ละส่วน
    document.getElementById('prevToHypertension').addEventListener('click', function() {
        var diabetesSection = document.getElementById('diabetesSection');
        var hypertensionSection = document.getElementById('hypertensionSection');
        showPrevSection(diabetesSection, hypertensionSection, 25);  // 25% Progress
    });

    document.getElementById('prevToDiabetes').addEventListener('click', function() {
        var oralHealthSection = document.getElementById('oralHealthSection');
        var diabetesSection = document.getElementById('diabetesSection');
        showPrevSection(oralHealthSection, diabetesSection, 50);  // 50% Progress
    });

    // ฟังก์ชั่นการแสดงการกลับไปยังส่วน Oral Health
    document.getElementById('prevToOral').addEventListener('click', function() {
        var eyeHealthSection = document.getElementById('eyeHealthSection');
        var oralHealthSection = document.getElementById('oralHealthSection');
        
        // ซ่อน Eye Health section
        eyeHealthSection.classList.remove('visible-section');
        eyeHealthSection.classList.add('hidden-section');
        
        // แสดง Oral Health section
        oralHealthSection.classList.remove('hidden-section');
        oralHealthSection.classList.add('visible-section');

        // อัพเดต progress bar ให้แสดงที่ 75%
        let progressBar = document.getElementById('progressBar');
        progressBar.style.width = '75%';
        progressBar.setAttribute('aria-valuenow', 75);
        updateProgress(75);  // ฟังก์ชั่นช่วยอัพเดต Progress Bar เมื่อทำการเปลี่ยนหน้า
    });

    // ฟังก์ชันสำหรับแสดงการไปยังส่วนถัดไป
    function showNextSection(currentSection, nextSection, progressValue) {
        currentSection.classList.remove('visible-section');
        currentSection.classList.add('hidden-section');
        
        nextSection.classList.remove('hidden-section');
        nextSection.classList.add('visible-section');

        // อัพเดต progress bar
        let progressBar = document.getElementById('progressBar');
        progressBar.style.width = progressValue + '%';
        progressBar.setAttribute('aria-valuenow', progressValue);
        updateProgress(progressValue);
    }

    // ฟังก์ชันสำหรับแสดงการกลับไปยังส่วนก่อนหน้า
    function showPrevSection(currentSection, prevSection, progressValue) {
        currentSection.classList.remove('visible-section');
        currentSection.classList.add('hidden-section');
        
        prevSection.classList.remove('hidden-section');
        prevSection.classList.add('visible-section');

        // อัพเดต progress bar
        let progressBar = document.getElementById('progressBar');
        progressBar.style.width = progressValue + '%';
        progressBar.setAttribute('aria-valuenow', progressValue);
        updateProgress(progressValue);
    }

    // ฟังก์ชันอัพเดต progress bar
    function updateProgress(progressValue) {
        let progressBar = document.getElementById('progressBar');
        progressBar.style.width = progressValue + '%';
        progressBar.setAttribute('aria-valuenow', progressValue);
    }

</script>
@endsection
