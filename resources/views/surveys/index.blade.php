@extends('layouts.app')

@section('title', 'Health Assessment Dashboard')

@section('content')
<div class="container">
    <div class="text-center my-4">
        <h1 class="fw-bold">แบบประเมินสุขภาพ</h1>
        <p class="text-muted fs-5">เลือกแบบประเมินที่เหมาะสมกับคุณ</p>
    </div>

    <!-- Search Bar -->
    <form method="GET" action="{{ route('survey.index') }}" class="mb-4">
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

    <!-- Main Content with Aside -->
    <div class="row g-4">
        <!-- Cards Section -->
        <div class="col-lg-8 col-md-7">
            <div class="row g-4">
                <!-- ประเมินโรคเบาหวาน -->
                <div class="col-md-6">
                    <div class="card shadow-sm h-100 hover-zoom border-light">
                        <div class="card-body d-flex flex-column text-center">
                            <div class="icon-wrapper mb-3">
                                <i class="bi bi-heart fs-1 text-success"></i> <!-- ใช้ไอคอนรูปหัวใจ -->
                            </div>
                            <h5 class="card-title fw-semibold text-dark">แบบประเมินโรคเบาหวาน</h5>
                            <small class="text-muted mb-3">ตรวจสอบระดับน้ำตาลในเลือดและภาวะเสี่ยงเบาหวาน</small>
                            <a href="{{ route('diabetes.survey.index') }}" class="btn btn-success mt-auto">เริ่มประเมินทันที <i class="bi bi-arrow-right-circle ms-1"></i></a>
                        </div>
                    </div>
                </div>

                <!-- ประเมินโรคความดันโลหิตสูง -->
                <div class="col-md-6">
                    <div class="card shadow-sm h-100 hover-zoom border-light">
                        <div class="card-body d-flex flex-column text-center">
                            <div class="icon-wrapper mb-3">
                                <i class="bi bi-clipboard2-pulse fs-1 text-success"></i> <!-- ใช้ไอคอนการแสดงอารมณ์ -->
                            </div>
                            <h5 class="card-title fw-semibold text-dark">แบบประเมินโรคความดันโลหิตสูง</h5>
                            <small class="text-muted mb-3">ตรวจสุขภาพความดันโลหิตและผลกระทบด้านจิตใจ</small>
                            <a href="{{ route('hypertension.survey.index') }}" class="btn btn-success mt-auto">เริ่มประเมินทันที <i class="bi bi-arrow-right-circle ms-1"></i></a>
                        </div>
                    </div>
                </div>

                <!-- ประเมินโรคหัวใจและหลอดเลือด -->
                <div class="col-md-6">
                    <div class="card shadow-sm h-100 hover-zoom border-light">
                        <div class="card-body d-flex flex-column text-center">
                            <div class="icon-wrapper mb-3">
                                <i class="bi bi-heart-pulse fs-1 text-success"></i> <!-- ใช้ไอคอนการตรวจวัดการเต้นของหัวใจ -->
                            </div>
                            <h5 class="card-title fw-semibold text-dark">แบบประเมินโรคหัวใจและหลอดเลือด</h5>
                            <small class="text-muted mb-3">ตรวจประเมินการทำงานและผลกระทบต่อสุขภาพ</small>
                            <a href="" class="btn btn-success mt-auto">เริ่มประเมินทันที <i class="bi bi-arrow-right-circle ms-1"></i></a>
                        </div>
                    </div>
                </div>

                <!-- ประเมินการได้ยิน -->
                <div class="col-md-6">
                    <div class="card shadow-sm h-100 hover-zoom border-light">
                        <div class="card-body d-flex flex-column text-center">
                            <div class="icon-wrapper mb-3">
                                <i class="bi bi-ear fs-1 text-success"></i> <!-- ใช้ไอคอนเกี่ยวกับการฟัง -->
                            </div>
                            <h5 class="card-title fw-semibold text-dark">แบบประเมินการได้ยิน</h5>
                            <small class="text-muted mb-3">ตรวจสอบความสามารถในการได้ยินและความเสี่ยง</small>
                            <a href="{{ route('hearing.survey.index') }}" class="btn btn-success mt-auto">เริ่มประเมินทันที <i class="bi bi-arrow-right-circle ms-1"></i></a>
                        </div>
                    </div>
                </div>

                <!-- ประเมินสุขภาพช่องปาก -->
                <div class="col-md-6">
                    <div class="card shadow-sm h-100 hover-zoom border-light">
                        <div class="card-body d-flex flex-column text-center">
                            <div class="icon-wrapper mb-3">
                                <i class="bi bi-emoji-grimace fs-1 text-success"></i> <!-- ใช้ไอคอนฟัน -->
                            </div>
                            <h5 class="card-title fw-semibold text-dark">แบบประเมินสุขภาพช่องปากผู้สูงอาย</h5>
                            <small class="text-muted mb-3">ประเมินสุขภาพจากโภชนาการและอาหาร</small>
                            <a href="{{ route('oral-health.survey.index') }}" class="btn btn-success mt-auto">เริ่มประเมินทันที <i class="bi bi-arrow-right-circle ms-1"></i></a>
                        </div>
                    </div>
                </div>
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

