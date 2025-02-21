@extends('layouts.app')

@section('title', 'Health Assessment Dashboard')

@section('content')
<div class="container">
    <div class="text-center my-5">
        <h1 class="fw-bold">แบบประเมินสุขภาพ</h1>
        <p class="text-muted fs-5">เลือกแบบประเมินที่เหมาะสมกับคุณ</p>
    </div>

    <!-- Search Bar -->
    <form method="GET" action="{{ route('survey.index') }}" class="mb-5">
        <div class="input-group shadow-sm">
            <input 
                type="text" 
                name="search" 
                class="form-control form-control-lg" 
                placeholder="ค้นหาแบบประเมิน..." 
                value="{{ $search ?? '' }}" 
                aria-label="Search">
            <button class="btn btn-primary btn-lg px-4" type="submit">
                <i class="bi bi-search"></i> ค้นหา
            </button>
        </div>
    </form>

    <!-- Main Content -->
    <div class="row g-4">
        <!-- Physical Health Assessments -->
        <div class="col-lg-8 col-md-7 mb-5">
            <h2 class="fw-bold text-success mb-4">คัดกรองโรคสำคัญและภาวะสุขภาพ</h2>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card shadow-sm h-100">
                        <div class="card-body text-center">
                            <i class="bi bi-heart fs-1 text-danger"></i>
                            <h5 class="card-title mt-3">ประเมินความเสี่ยงโรคทั่วไป</h5>
                            <p class="text-muted">วิเคราะห์สุขภาพในด้านต่างๆ เช่น ระดับน้ำตาลในเลือด, ความดันโลหิต, สุขภาพช่องปาก, และสุขภาพทางตา พร้อมรับคำแนะนำดูแลสุขภาพ</p>
                            <a href="{{ route('health_assessments.create') }}" class="btn btn-danger mt-2">
                                เริ่มประเมินทันที <i class="bi bi-arrow-right-circle ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-md-6">
                    <div class="card shadow-sm h-100">
                        <div class="card-body text-center">
                            <i class="bi bi-heart-pulse fs-1 text-primary"></i>
                            <h5 class="card-title mt-3">แบบประเมินโรคหัวใจและหลอดเลือด</h5>
                            <p class="text-muted">ประเมินการทำงานของหัวใจและหลอดเลือด</p>
                            <a href="" class="btn btn-primary mt-2">
                                เริ่มประเมินทันที <i class="bi bi-arrow-right-circle ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div> --}}
            </div>

            <h2 class="fw-bold text-primary mt-5 mb-4">ประเมินความเสี่ยงสุขภาพจากฝุ่น PM 2.5</h2>
            <div class="row g-4">
                <!-- แบบประเมินความเสี่ยงฝุ่น PM 2.5 -->
                <div class="col-md-6">
                    <div class="card shadow-sm h-100">
                        <div class="card-body text-center">
                            <i class="bi bi-cloud-drizzle fs-1 text-danger"></i>
                            <h5 class="card-title mt-3">แบบประเมินความเสี่ยงจากฝุ่น PM 2.5</h5>
                            <p class="text-muted">ตรวจสอบว่าคุณอยู่ในพื้นที่เสี่ยงหรือไม่ และดูแลสุขภาพของคุณได้อย่างไร</p>
                            <a href="{{ route('pm25_assessments.create') }}" class="btn btn-danger mt-2">
                                เริ่มประเมินทันที <i class="bi bi-arrow-right-circle ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <h2 class="fw-bold text-secondary mt-5 mb-4">การประเมินความสามารถในการทำกิจวัตรประจำวัน (Activities of Daily Living)</h2>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card shadow-sm h-100">
                        <div class="card-body text-center">
                            <i class="bi bi-ear fs-1 text-secondary"></i>
                            <h5 class="card-title mt-3">แบบประเมินการได้ยิน</h5>
                            <p class="text-muted">ตรวจสอบการได้ยินและความเสี่ยงต่อการสูญเสียการได้ยิน</p>
                            <a href="" class="btn btn-secondary mt-2">
                                เริ่มประเมินทันที <i class="bi bi-arrow-right-circle ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-md-6">
                    <div class="card shadow-sm h-100">
                        <div class="card-body text-center">
                            <i class="bi bi-emoji-grimace fs-1 text-secondary"></i>
                            <h5 class="card-title mt-3">แบบประเมินสุขภาพช่องปาก</h5>
                            <p class="text-muted">ตรวจสอบปัญหาสุขภาพช่องปากและฟัน</p>
                            <a href="" class="btn btn-secondary mt-2">
                                เริ่มประเมินทันที <i class="bi bi-arrow-right-circle ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
	<!-- Aside Content -->
        <aside class="col-lg-4 col-md-5">
            <div class="" style="top: 20px;">
                <!-- Section 1: วิธีการประเมิน -->
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">วิธีการประเมินสุขภาพ</h5>
                        <p class="text-muted">แบบประเมินนี้ถูกออกแบบเพื่อช่วยประเมินสถานะสุขภาพในปัจจุบันของคุณ กรุณา:</p>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item small">✔ ตอบคำถามตามความเป็นจริง</li>
                            <li class="list-group-item small">✔ ใช้เวลาอ่านคำถามให้ละเอียด</li>
                            <li class="list-group-item small">✔ อย่ากังวลหากไม่แน่ใจ สามารถขอคำแนะนำได้</li>
                        </ul>
                        <p class="text-muted mt-3">การประเมินใช้เวลาโดยประมาณ 10-15 นาที</p>
                    </div>
                </div>

                <!-- Section 2: คำแนะนำและข้อควรระวัง -->
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">คำแนะนำและข้อควรระวัง</h5>
                        <p class="text-muted">กรุณาตรวจสอบข้อมูลที่เกี่ยวข้องก่อนเริ่ม:</p>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item small">🔹 คำตอบของคุณจะถูกเก็บเป็นความลับ</li>
                            <li class="list-group-item small">🔹 หากมีอาการเร่งด่วน ควรติดต่อแพทย์ทันที</li>
                            <li class="list-group-item small">🔹 ติดต่อทีมสนับสนุนหากพบปัญหา</li>
                        </ul>
                        <p class="text-muted mt-3">ผลการประเมินเป็นเพียงคำแนะนำเบื้องต้น ไม่สามารถใช้แทนการวินิจฉัยทางการแพทย์ได้</p>
                    </div>
                </div>

                <!-- Section 3: ติดต่อเรา -->
                <div class="card shadow-sm mb-5">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">ติดต่อเรา</h5>
                        <p class="text-muted mb-2">หากคุณต้องการความช่วยเหลือเพิ่มเติม กรุณาติดต่อเราได้ที่:</p>
                        <p class="text-muted mb-2">โทร: <a href="tel:123456789">+077511218</a></p>
                        <p class="text-muted">อีเมล: <a href="mailto:support@example.com">support@example.com</a></p>
                    </div>
                </div>
            </div>
        </aside>
    </div>
</div>

@include('layouts.footer')

<style>
    .hover-zoom:hover {
        transform: scale(1.05);
        transition: all 0.3s ease-in-out;
    }
    .icon-wrapper {
        background-color: #eef6fc;
        width: 80px;
        height: 80px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        margin: 0 auto;
    }
    aside .card {
        border-radius: 8px;
    }

    .btn-success {
        position: relative;
        overflow: hidden;
        background-color: #198754;
        border: none;
        transition: background-color 0.3s ease-in-out;
        color: #fff; /* ฟอนต์เริ่มต้นเป็นสีขาว */
        z-index: 1; /* ฟอนต์อยู่บนสุด */
    }

    .btn-success::before {
        content: "";
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background-color: #145c43;
        transition: left 0.3s ease-in-out;
        z-index: -1; /* พื้นหลังอยู่ข้างล่างของฟอนต์ */
    }

    .btn-success:hover::before {
        left: 0;
    }

    .btn-success:hover {
        background-color: #145c43;
        color: #fff; /* ฟอนต์สีขาวเมื่อ hover */
    }


</style>
@endsection

