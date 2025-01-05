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
                <div class="col-md-6">
                    <div class="card shadow-sm h-100 hover-zoom">
                        <div class="card-body d-flex flex-column text-center">
                            <div class="icon-wrapper mb-3">
                                <i class="bi bi-clipboard-heart fs-1 text-primary"></i>
                            </div>
                            <h5 class="card-title fw-bold">แบบประเมินสุขภาพทั่วไป</h5>
                            <a href="{{ route('diabetes.survey.index') }}" class="btn btn-primary mt-auto">
                                เริ่มแบบประเมิน <i class="bi bi-arrow-right-circle ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card shadow-sm h-100 hover-zoom">
                        <div class="card-body d-flex flex-column text-center">
                            <div class="icon-wrapper mb-3">
                                <i class="bi bi-clipboard-heart fs-1 text-primary"></i>
                            </div>
                            <h5 class="card-title fw-bold">แบบประเมินสุขภาพจิต</h5>
                            <a href="{{ route('hypertension.survey.index') }}" class="btn btn-primary mt-auto">
                                เริ่มแบบประเมิน <i class="bi bi-arrow-right-circle ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card shadow-sm h-100 hover-zoom">
                        <div class="card-body d-flex flex-column text-center">
                            <div class="icon-wrapper mb-3">
                                <i class="bi bi-clipboard-heart fs-1 text-primary"></i>
                            </div>
                            <h5 class="card-title fw-bold">แบบประเมินสุขภาพการทำงาน</h5>
                            <a href="{{ route('hearing.survey.index')}}" class="btn btn-primary mt-auto">
                                เริ่มแบบประเมิน <i class="bi bi-arrow-right-circle ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card shadow-sm h-100 hover-zoom">
                        <div class="card-body d-flex flex-column text-center">
                            <div class="icon-wrapper mb-3">
                                <i class="bi bi-clipboard-heart fs-1 text-primary"></i>
                            </div>
                            <h5 class="card-title fw-bold">แบบประเมินสุขภาพการนอนหลับ</h5>
                            <a href="{{ route('oral-health.survey.index') }}" class="btn btn-primary mt-auto">
                                เริ่มแบบประเมิน <i class="bi bi-arrow-right-circle ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card shadow-sm h-100 hover-zoom">
                        <div class="card-body d-flex flex-column text-center">
                            <div class="icon-wrapper mb-3">
                                <i class="bi bi-clipboard-heart fs-1 text-primary"></i>
                            </div>
                            <h5 class="card-title fw-bold">แบบประเมินสุขภาพด้านโภชนาการ</h5>
                            <a href="{{ route('vision.survey.index')}}" class="btn btn-primary mt-auto">
                                เริ่มแบบประเมิน <i class="bi bi-arrow-right-circle ms-1"></i>
                            </a>
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
@endsection

@section('styles')
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
    .btn-primary {
        background-color: #0d6efd;
        border: none;
    }
    .btn-primary:hover {
        background-color: #084298;
    }
    aside .card {
        border-radius: 8px;
    }
</style>
@endsection


@section('styles')
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
    .btn-primary {
        background-color: #0d6efd;
        border: none;
    }
    .btn-primary:hover {
        background-color: #084298;
    }
    aside .card {
        border-radius: 8px;
    }
</style>
@endsection
