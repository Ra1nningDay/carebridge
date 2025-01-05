@extends('layouts.app')

@section('title', 'แบบประเมินการคัดกรองโรคเบาหวาน')

@section('content')
<div class="container pb-5 mb-5">
    <div class="assessment-header text-center my-5">
        <h1 class="fw-bold text-primary position-relative">
            แบบประเมินการคัดกรองโรคเบาหวาน
            <span class="d-block position-absolute top-100 start-50 translate-middle w-50 border-primary border-bottom"></span>
        </h1>
        <p class="text-muted fs-5">กรุณากรอกข้อมูลและตอบคำถามเพื่อประเมินเบื้องต้น</p>
    </div>

    @if (session('error'))
        <div class="toast-container position-fixed start-50 translate-middle-x p-3" style="z-index: 2000; top: 10%;">
            <div class="toast align-items-center text-bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ session('error') }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif

    <!-- Section: การให้คำแนะนำ -->
    <div class="advice-section bg-light px-4 rounded">
        <h3 class="fw-bold text-primary text-center mb-4">
            คำแนะนำสำหรับการตรวจเลือดและการประเมิน
        </h3>

        <!-- Icon Section -->
        <div class="row text-center g-4">
            <div class="col-md-4 d-flex">
                <div class="card border-0 shadow-sm p-3 h-100">
                    <img src="/images/fasting-icon.png" alt="Fasting Icon" class="mb-3 img-fluid" style="width: 50px;">
                    <h5 class="fw-bold">เตรียมตัวก่อนตรวจ</h5>
                    <p class="text-muted small">
                        เพื่อให้ผลตรวจมีความแม่นยำ ควรงดอาหารและเครื่องดื่มที่มีน้ำตาลอย่างน้อย 8 ชั่วโมงก่อนการตรวจ คำแนะนำ: การอดอาหารที่ถูกต้องคือการหลีกเลี่ยงทั้งอาหารมื้อหลักและของว่างในช่วงเวลาดังกล่าว
                    </p>
                </div>
            </div>
            <div class="col-md-4 d-flex">
                <div class="card border-0 shadow-sm p-3 h-100">
                    <img src="/images/device-icon.png" alt="Device Icon" class="mb-3 img-fluid" style="width: 50px;">
                    <h5 class="fw-bold">ตรวจสอบเครื่อง</h5>
                    <p class="text-muted small">
                        ใช้เครื่องตรวจน้ำตาลที่ได้รับการรับรองจากหน่วยงานที่เชื่อถือได้ เช่น ใช้เครื่องที่มีการตรวจสอบคุณภาพ (Calibrated) และตรวจสอบระดับพลังงานของแบตเตอรี่ก่อนการใช้งาน
                    </p>
                </div>
            </div>
            <div class="col-md-4 d-flex">
                <div class="card border-0 shadow-sm p-3 h-100">
                    <img src="/images/handwash-icon.png" alt="Handwash Icon" class="mb-3 img-fluid" style="width: 50px;">
                    <h5 class="fw-bold">ล้างมือ</h5>
                    <p class="text-muted small">
                        ควรล้างมือให้สะอาดก่อนการเจาะเลือดเพื่อป้องกันการปนเปื้อนของเชื้อโรคที่อาจส่งผลต่อผลการตรวจ หากสามารถใช้น้ำอุ่นและสบู่อ่อนๆ ก็จะยิ่งดี
                    </p>
                </div>
            </div>
        </div>


       <div class="timeline mt-5 mx-auto">
            <div class="timeline-item">
                <div class="timeline-icon">
                    <i class="bi bi-droplet-fill"></i>
                </div>
                <div class="timeline-content shadow-sm">
                    <h5>ใช้เข็มเจาะปลายนิ้ว</h5>
                    <p class="text-muted">
                        ให้ใช้เข็มที่ได้รับการฆ่าเชื้อใหม่ทุกครั้ง และหลีกเลี่ยงการเจาะซ้ำในตำแหน่งเดียวกันเพื่อป้องกันการติดเชื้อและผลกระทบต่อการตรวจเลือด
                    </p>
                    <img src="/images/finger-prick-example.jpg" alt="Finger Prick Example" class="img-fluid mt-3">
                </div>
            </div>
            <div class="timeline-item">
                <div class="timeline-icon">
                    <i class="bi bi-pencil-fill"></i>
                </div>
                <div class="timeline-content shadow-sm">
                    <h5>บันทึกค่าการตรวจผ่านเว็บไซต์</h5>
                    <p class="text-muted">
                        หลังจากที่คุณได้ทำการตรวจเลือดแล้ว ให้บันทึกค่าและผลการตรวจในระบบของเรา เพื่อเก็บข้อมูลอย่างปลอดภัยและสามารถติดตามผลได้ง่าย
                    </p>
                    <ul class="text-muted">
                        <li>ทำการล็อกอินในระบบของเราเพื่อเข้าถึงส่วนการบันทึกค่า</li>
                        <li>กรอกข้อมูลที่ได้จากการตรวจเลือด เช่น ค่าเฉพาะหรือระดับน้ำตาลในเลือด</li>
                        <li>ตรวจสอบผลตรวจผ่านแผง Dashboard และกราฟการเปรียบเทียบผลตรวจที่ผ่านมา</li>
                    </ul>
                    <p class="text-muted mt-2">
                        การบันทึกค่าในระบบนี้จะช่วยให้คุณสามารถดูประวัติผลตรวจและปรึกษาแพทย์เกี่ยวกับสภาวะสุขภาพของคุณได้
                    </p>
                    <img src="/images/record-reading-example.jpg" alt="Record Reading Example" class="img-fluid mt-3">
                </div>
            </div>
        </div>


    </div>


    <form method="POST" action="" class="assessment-form shadow-sm p-4 rounded bg-white">
        @csrf

        <!-- การตรวจน้ำตาลในเลือด -->
        <div class="question-block mb-5">
            <h5 class="fw-bold mb-3">การตรวจน้ำตาลในเลือดโดยวิธีเจาะจากปลายนิ้ว</h5>
            <label for="fcbg" class="form-label fs-5">ค่าน้ำตาลในเลือด (มก./ดล.)</label>
            <input type="number" id="fcbg" name="answers[fcbg]" class="form-control form-control-lg mb-3" placeholder="กรอกค่าน้ำตาลในเลือด" required>
            <div class="text-center mb-3">
                <img src="/images/blood-drop.gif" alt="Blood Drop Animation" style="width: 100px; height: auto;">
            </div>
            <p class="text-muted small">
                การตรวจน้ำตาลในเลือดโดยวิธีเจาะจากปลายนิ้ว (fasting capillary blood glucose, FCBG): <br>
                - หากระดับ FPG ≥ 126 มก./ดล. ให้ตรวจยืนยันอีกครั้ง <br>
                - หาก FPG อยู่ระหว่าง 100-125 มก./ดล. ถือเป็น "ภาวะระดับน้ำตาลในเลือดขณะอดอาหารผิดปกติ" <br>
                คำแนะนำ: ปรับพฤติกรรมโดยควบคุมอาหารและออกกำลังกายสม่ำเสมอ
            </p>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary btn-lg px-5">
                ส่งแบบประเมิน
            </button>
        </div>
    </form>
</div>

@include('layouts.footer')

<!-- Custom Styles -->
<style>
    .timeline {
        position: relative;
        margin: 2rem auto;
        padding: 2rem 0;
        max-width: 800px;
    }

    .timeline-item {
        position: relative;
        margin-bottom: 2rem;
        display: flex;
        align-items: center;
    }

    .timeline-icon {
        background-color: #0d6efd;
        color: white;
        font-size: 1.5rem;
        border-radius: 50%;
        height: 50px;
        width: 65px;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-right: 1rem;
    }

    .timeline-content {
        background-color: white;
        padding: 1rem;
        border-radius: 10px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .card {
        border: none;
        transition: all 0.3s ease-in-out;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .card img {
        animation: bounce 1.5s infinite;
    }

    @keyframes bounce {
        0%, 20%, 50%, 80%, 100% {
            transform: translateY(0);
        }
        40% {
            transform: translateY(-10px);
        }
        60% {
            transform: translateY(-5px);
        }
    }

    .assessment-header h1 {
        color: #0d6efd;
    }

    .assessment-header h1 span {
        display: block;
        position: absolute;
        bottom: -5px;
        left: 50%;
        transform: translateX(-50%);
        height: 4px;
        width: 80%;
        background-color: #0d6efd;
    }

    .advice-section {
        max-width: 900px;
        margin: 0 auto;
    }

    .assessment-form {
        max-width: 900px;
        margin: 0 auto;
    }

    .question-block h5 {
        color: #343a40;
    }

    .btn-primary {
        background-color: #0d6efd;
        border-color: #0d6efd;
    }

    .btn-primary:hover {
        background-color: #0b5ed7;
        border-color: #0a58ca;
    }
</style>
@endsection
