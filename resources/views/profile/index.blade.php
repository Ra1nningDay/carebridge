@extends('layouts.app')

@section('title', $user->name)

@section('content')
<!-- ส่วนแบนเนอร์ -->
<div class="banner" style="background-color: #0056b3; height: 250px; position: relative;">
</div>

<div class="container mb-5" style="margin-top: -150px; position: relative; z-index: 2;">    
    <div class="row">
        <!-- ส่วนโปรไฟล์ผู้สูงอายุ (ฝั่งซ้าย) -->
        <!-- ถ้าเป็น caregiver ให้แสดงข้อมูลของผู้สูงอายุที่ดูแล -->
        <div class="col-md-8">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    @if ($user->roles->contains('name', 'caregiver'))
                        <!-- ส่วนหัวของผู้สูงอายุ -->
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="d-flex align-items-center">
                                <!-- ตรวจสอบว่า avatar_url มีอยู่จริงหรือไม่ -->
                                <img src="{{ $user->elderly->first()->avatar_url ?? asset('default-avatar.jpg') }}" alt="รูปโปรไฟล์ผู้สูงอายุ" class="rounded-circle" width="100" height="100">
                                <div class="ms-3">
                                    <small>ผู้สูงอายุของคุณ</small>
                                    <h2 class="mb-0">{{ $user->elderly->first()->name ?? 'ไม่ระบุชื่อ' }}</h2>
                                    <p class="text-muted">
                                        เข้าร่วมเมื่อ: 
                                        @if ($user && $user->elderly->first()->created_at)
                                            {{ $user->elderly->first()->created_at->format('F Y') }}
                                        @else
                                            ไม่ระบุ
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <div class="d-flex">
                                <!-- ปุ่มติดต่อผู้สู่งอายุ -->
                                <a href="{{ route('chat.start', $user->elderly->first()->id)}}" class="btn btn-sm btn-outline-primary d-flex align-items-center p-2 rounded-3 me-2" style="transition: transform 0.3s ease;">
                                    <i class="bi bi-chat-dots me-2"></i>
                                    <span>ติดต่อผู้สู่งอายุ</span>
                                </a>
                                <!-- เพิ่มลิงก์สำหรับการนัดแพทย์ พร้อมแนบ ID ของผู้สูงอายุ -->
                                <a href="{{ route('appointments.create', ['elderly_id' => $user->elderly->first()->id]) }}" class="btn btn-warning">ติดต่อแพทย์</a>
                            </div>
                        </div>


                        <!-- แท็บนำทาง -->
                        <ul class="nav nav-pills mb-3">
                            <li class="nav-item">
                                <a class="nav-link active" href="#overview" data-bs-toggle="tab">ข้อมูลทั่วไป</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#health" data-bs-toggle="tab">สุขภาพ</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#healthchecks" data-bs-toggle="tab">ประวัติการตรวจสุขภาพ</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#saved" data-bs-toggle="tab">ที่บันทึกไว้</a>
                            </li>
                        </ul>

                        <!-- เนื้อหาภายในแท็บ -->
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="overview">
                                <h6 class="mb-4">ข้อมูลโดยรวมของผู้สูงอายุ</h6>
                                
                                <div class="row">
                                    <!-- ข้อมูลส่วนบุคคล -->
                                    <div class="col-md-6">
                                        <ul class="list-group">
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <strong>ชื่อ:</strong>
                                                <span>{{ $user->elderly->first()->name ?? 'ไม่ระบุ' }}</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <strong>วันเกิด:</strong>
                                                <span>{{ $user->elderly->first()->personalInfo->date_of_birth ?? 'ไม่ระบุ' }}</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <strong>เพศ:</strong>
                                                <span>
                                                    @if ($user->elderly->first()->personalInfo && $user->elderly->first()->personalInfo->gender)
                                                        @if ($user->elderly->first()->personalInfo->gender === 'male')
                                                            ชาย
                                                        @elseif ($user->elderly->first()->personalInfo->gender === 'female')
                                                            หญิง
                                                        @else
                                                            ไม่ระบุ
                                                        @endif
                                                    @else
                                                        N/A
                                                    @endif
                                                </span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <strong>เบอร์โทรศัพท์:</strong>
                                                <span>{{ $user->elderly->first()->personalInfo->phone ?? 'ไม่ระบุ' }}</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <strong>ที่อยู่:</strong>
                                                <span>{{ $user->elderly->first()->personalInfo->address ?? 'ไม่ระบุ' }}</span>
                                            </li>
                                        </ul>
                                    </div>

                                    <!-- ข้อมูลทางการแพทย์ -->
                                    <div class="col-md-6">
                                        <ul class="list-group">
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <strong>ประวัติการแพ้:</strong>
                                                <span>{{ $user->elderly->first()->personalInfo->allergies ?? 'ไม่ระบุ' }}</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <strong>ประวัติการแพทย์:</strong>
                                                <span>{{ $user->elderly->first()->personalInfo->medical_history ?? 'ไม่ระบุ' }}</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <strong>ประวัติการใช้ยา:</strong>
                                                <span>{{ $user->elderly->first()->personalInfo->medications ?? 'ไม่ระบุ' }}</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <strong>ประเภทการดูแล:</strong>
                                                <span>{{ $user->elderly->first()->care_type ?? 'ไม่ระบุ' }}</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <strong>เวลาที่ต้องการการดูแล:</strong>
                                                <span>{{ $user->elderly->first()->preferred_time ?? 'ไม่ระบุ' }}</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <hr class="my-4">

                                <!-- กราฟน้ำหนักและส่วนสูง -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <h6>ข้อมูลสุขภาพ</h6>
                                        <canvas id="healthChart"></canvas>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="healths">
                                <!-- ข้อมูลโพสต์ที่เกี่ยวข้อง -->
                                <p>ข้อมูลกระทู้ของผู้สูงอายุจะปรากฏที่นี่</p>
                            </div>
                            <div class="tab-pane fade" id="healthchecks">
                                <p>ข้อมูลการตรวจสุขภาพล่าสุด</p>
                                @if ($user->elderly->first()->healthAssessments->count() > 0)
                                    <div class="accordion" id="healthCheckAccordion">
                                        @foreach ($user->elderly->first()->healthAssessments as $index => $assessment)
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingHealthCheck{{ $index }}">
                                                <button class="accordion-button {{ $index !== 0 ? 'collapsed' : '' }}" type="button" 
                                                        data-bs-toggle="collapse" 
                                                        data-bs-target="#collapseHealthCheck{{ $index }}" 
                                                        aria-expanded="{{ $index === 0 ? 'true' : 'false' }}" 
                                                        aria-controls="collapseHealthCheck{{ $index }}">
                                                    <strong>การตรวจสุขภาพครั้งที่ {{ $index + 1 }} - {{ $assessment->created_at->format('d/m/Y') }}</strong>
                                                </button>
                                            </h2>
                                            <div id="collapseHealthCheck{{ $index }}" 
                                                class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}" 
                                                aria-labelledby="headingHealthCheck{{ $index }}">
                                                <div class="accordion-body">
                                                    <div class="accordion" id="healthDetailAccordion{{ $index }}">
                                                        <!-- ความดันโลหิต -->
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header" id="bpHeading{{ $index }}">
                                                                <button class="accordion-button" type="button" 
                                                                        data-bs-toggle="collapse" 
                                                                        data-bs-target="#bpCollapse{{ $index }}">
                                                                    ความดันโลหิต
                                                                </button>
                                                            </h2>
                                                            <div id="bpCollapse{{ $index }}" 
                                                                class="accordion-collapse collapse show" 
                                                                aria-labelledby="bpHeading{{ $index }}">
                                                                <div class="accordion-body">
                                                                    <p><strong>สถานะ:</strong>
                                                                        @switch($assessment->hypertensionHealth->status)
                                                                            @case('undiagnosed')
                                                                                <span class="badge bg-success">ไม่มีประวัติโรคความดัน</span>
                                                                                @break
                                                                            @case('treated')
                                                                                <span class="badge bg-warning">อยู่ระหว่างการรักษา</span>
                                                                                @break
                                                                            @case('untreated')
                                                                                <span class="badge bg-danger">ยังไม่ได้รับการรักษา</span>
                                                                                @break
                                                                        @endswitch
                                                                    </p>
                                                                    <p><strong>SBP:</strong> {{ $assessment->hypertensionHealth->sbp ?? 'N/A' }} mmHg</p>
                                                                    <p><strong>DBP:</strong> {{ $assessment->hypertensionHealth->dbp ?? 'N/A' }} mmHg</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- เบาหวาน -->
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header" id="diabetesHeading{{ $index }}">
                                                                <button class="accordion-button collapsed" type="button" 
                                                                        data-bs-toggle="collapse" 
                                                                        data-bs-target="#diabetesCollapse{{ $index }}">
                                                                    เบาหวาน
                                                                </button>
                                                            </h2>
                                                            <div id="diabetesCollapse{{ $index }}" 
                                                                class="accordion-collapse collapse" 
                                                                aria-labelledby="diabetesHeading{{ $index }}">
                                                                <div class="accordion-body">
                                                                    <p><strong>สถานะ:</strong>
                                                                        @switch($assessment->diabetesHealth->status)
                                                                            @case('undiagnosed')
                                                                                <span class="badge bg-success">ไม่มีประวัติโรคเบาหวาน</span>
                                                                                @break
                                                                            @case('treated')
                                                                                <span class="badge bg-warning">อยู่ระหว่างการรักษา</span>
                                                                                @break
                                                                            @case('untreated')
                                                                                <span class="badge bg-danger">ยังไม่ได้รับการรักษา</span>
                                                                                @break
                                                                        @endswitch
                                                                    </p>
                                                                    <p><strong>FPG:</strong> {{ $assessment->diabetesHealth->fpg ?? 'N/A' }} mg/dL</p>
                                                                    <p><strong>ระดับน้ำตาลสุ่ม:</strong> {{ $assessment->diabetesHealth->random_glucose ?? 'N/A' }} mg/dL</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- สุขภาพช่องปาก -->
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header" id="oralHeading{{ $index }}">
                                                                <button class="accordion-button collapsed" type="button" 
                                                                        data-bs-toggle="collapse" 
                                                                        data-bs-target="#oralCollapse{{ $index }}">
                                                                    สุขภาพช่องปาก
                                                                </button>
                                                            </h2>
                                                            <div id="oralCollapse{{ $index }}" 
                                                                class="accordion-collapse collapse" 
                                                                aria-labelledby="oralHeading{{ $index }}">
                                                                <div class="accordion-body">
                                                                    <p><strong>ความถี่ในการแปรงฟัน:</strong> {{ $assessment->oralHealth->brushing_frequency }}</p>
                                                                    <p><strong>การใช้ยาสีฟัน:</strong> {{ $assessment->oralHealth->uses_toothpaste ? 'ใช่' : 'ไม่ใช่' }}</p>
                                                                    <p><strong>ทำความสะอาดระหว่างฟัน:</strong> {{ $assessment->oralHealth->cleans_between_teeth ? 'ใช่' : 'ไม่ใช่' }}</p>
                                                                    <p><strong>อุปกรณ์ทำความสะอาด:</strong> {{ $assessment->oralHealth->cleaning_tool }}</p>
                                                                    <p><strong>สูบบุหรี่มากกว่า 10 มวน:</strong> {{ $assessment->oralHealth->smokes_more_than_10 ? 'ใช่' : 'ไม่ใช่' }}</p>
                                                                    <p><strong>เคี้ยวหมาก:</strong> {{ $assessment->oralHealth->chews_areca ? 'ใช่' : 'ไม่ใช่' }}</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- สุขภาพตา -->
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header" id="eyeHeading{{ $index }}">
                                                                <button class="accordion-button collapsed" type="button" 
                                                                        data-bs-toggle="collapse" 
                                                                        data-bs-target="#eyeCollapse{{ $index }}">
                                                                    สุขภาพตา
                                                                </button>
                                                            </h2>
                                                            <div id="eyeCollapse{{ $index }}" 
                                                                class="accordion-collapse collapse" 
                                                                aria-labelledby="eyeHeading{{ $index }}">
                                                                <div class="accordion-body">
                                                                    <p><strong>มีปัญหาด้านสายตา:</strong> {{ $assessment->eyeHealth->has_eye_issue ? 'มี' : 'ไม่มี' }}</p>
                                                                    <p><strong>ปัญหาสายตาไกล:</strong> {{ $assessment->eyeHealth->distance_vision_issue ? 'มี' : 'ไม่มี' }}</p>
                                                                    <p><strong>ปัญหาสายตาใกล้:</strong> {{ $assessment->eyeHealth->near_vision_issue ? 'มี' : 'ไม่มี' }}</p>
                                                                    <h6 class="mt-3">ความเสี่ยงต้อกระจก:</h6>
                                                                    <p><strong>ตาซ้าย:</strong> {{ $assessment->eyeHealth->cataract_risk_left ? 'มี' : 'ไม่มี' }}</p>
                                                                    <p><strong>ตาขวา:</strong> {{ $assessment->eyeHealth->cataract_risk_right ? 'มี' : 'ไม่มี' }}</p>
                                                                    <h6 class="mt-3">ความเสี่ยงต้อหิน:</h6>
                                                                    <p><strong>ตาซ้าย:</strong> {{ $assessment->eyeHealth->glaucoma_risk_left ? 'มี' : 'ไม่มี' }}</p>
                                                                    <p><strong>ตาขวา:</strong> {{ $assessment->eyeHealth->glaucoma_risk_right ? 'มี' : 'ไม่มี' }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                @else
                                    <p class="text-muted"><i class="fas fa-info-circle"></i> ยังไม่มีข้อมูลการตรวจสุขภาพ</p>
                                @endif
                            </div>
                        </div>
                    @else 
                        <!-- ส่วนหัวของผู้สูงอายุ -->
                        <div class="d-flex align-items-center mb-4">
                            <img src="{{ $user->avatar_url }}" alt="รูปโปรไฟล์ผู้สูงอายุ" class="rounded-circle" width="100" height="100">
                            <div class="ms-3">
                                <h2 class="mb-0">{{ $user->name ?? 'ไม่ระบุชื่อ' }}</h2>
                                <p class="text-muted">
                                    เข้าร่วมเมื่อ: 
                                    @if ($user && $user->created_at)
                                        {{ $user->created_at->format('F Y') }}
                                    @else
                                        ไม่ระบุ
                                    @endif
                                </p>
                            </div>
                        </div>

                        <!-- แท็บนำทาง -->
                        <ul class="nav nav-pills mb-3">
                            <li class="nav-item">
                                <a class="nav-link active" href="#overview" data-bs-toggle="tab">ข้อมูลทั่วไป</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#health" data-bs-toggle="tab">สุขภาพ</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#healthchecks" data-bs-toggle="tab">ประวัติการตรวจสุขภาพ</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#saved" data-bs-toggle="tab">ที่บันทึกไว้</a>
                            </li>
                        </ul>

                        <!-- เนื้อหาภายในแท็บ -->
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="overview">
                                <h6 class="mb-4">ข้อมูลโดยรวมของผู้สูงอายุ</h6>
                                
                                <div class="row">
                                    <!-- ข้อมูลส่วนบุคคล -->
                                    <div class="col-md-6">
                                        <ul class="list-group">
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <strong>ชื่อ:</strong>
                                                <span>{{ $user->name ?? 'ไม่ระบุ' }}</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <strong>วันเกิด:</strong>
                                                <span>{{ $user->personalInfo->date_of_birth ?? 'ไม่ระบุ' }}</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <strong>เพศ:</strong>
                                                <span>
                                                    @if ($user->personalInfo && $user->personalInfo->gender)
                                                        @if ($user->personalInfo->gender === 'male')
                                                            ชาย
                                                        @elseif ($user->personalInfo->gender === 'female')
                                                            หญิง
                                                        @else
                                                            ไม่ระบุ
                                                        @endif
                                                    @else
                                                        N/A
                                                    @endif
                                                </span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <strong>เบอร์โทรศัพท์:</strong>
                                                <span>{{ $user->personalInfo->phone ?? 'ไม่ระบุ' }}</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <strong>ที่อยู่:</strong>
                                                <span>{{ $user->personalInfo->address ?? 'ไม่ระบุ' }}</span>
                                            </li>
                                        </ul>
                                    </div>

                                    <!-- ข้อมูลทางการแพทย์ -->
                                    <div class="col-md-6">
                                        <ul class="list-group">
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <strong>ประวัติการแพ้:</strong>
                                                <span>{{ $user->personalInfo->allergies ?? 'ไม่ระบุ' }}</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <strong>ประวัติการแพทย์:</strong>
                                                <span>{{ $user->personalInfo->medical_history ?? 'ไม่ระบุ' }}</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <strong>ประวัติการใช้ยา:</strong>
                                                <span>{{ $user->personalInfo->medications ?? 'ไม่ระบุ' }}</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <strong>ประเภทการดูแล:</strong>
                                                <span>{{ $user->care_type ?? 'ไม่ระบุ' }}</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <strong>เวลาที่ต้องการการดูแล:</strong>
                                                <span>{{ $user->preferred_time ?? 'ไม่ระบุ' }}</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <hr class="my-4">

                                <!-- กราฟน้ำหนักและส่วนสูง -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <h6>ข้อมูลสุขภาพ</h6>
                                        <canvas id="healthChart"></canvas>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="healths">
                                <!-- ข้อมูลโพสต์ที่เกี่ยวข้อง -->
                                <p>ข้อมูลกระทู้ของผู้สูงอายุจะปรากฏที่นี่</p>
                            </div>
                            <div class="tab-pane fade" id="healthchecks">
                                <!-- ข้อมูลความคิดเห็น -->
                                <p>ข้อมูลการตรวจสุขภาพล่าสุด</p>
                                @if ($user->healthAssessments->count() > 0)
                                    <div class="accordion" id="healthCheckAccordion">
                                        @foreach ($user->healthAssessments as $index => $check)
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingHealthCheck{{ $index }}">
                                                <button class="accordion-button {{ $index !== 0 ? 'collapsed' : '' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapseHealthCheck{{ $index }}" aria-expanded="true" aria-controls="collapseHealthCheck{{ $index }}">
                                                    <strong>การตรวจสุขภาพครั้งที่ {{ $index + 1 }} - {{ $check->check_date }}</strong>
                                                </button>
                                            </h2>
                                            <div id="collapseHealthCheck{{ $index }}" class="accordion-collapse collapse" aria-labelledby="headingHealthCheck{{ $index }}">
                                                <div class="accordion-body">
                                                    <div class="accordion" id="healthDetailAccordion{{ $index }}">
                                                        <!-- ความดันโลหิต -->
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header" id="bpHeading{{ $index }}">
                                                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#bpCollapse{{ $index }}" aria-expanded="false" aria-controls="bpCollapse{{ $index }}">
                                                                    ความดันโลหิต
                                                                </button>
                                                            </h2>
                                                            <div id="bpCollapse{{ $index }}" class="accordion-collapse collapse" aria-labelledby="bpHeading{{ $index }}">
                                                                <div class="accordion-body">
                                                                    <p><strong>SBP:</strong> {{ $check->blood_pressure_sbp ?? 'N/A' }} mmHg</p>
                                                                    <p><strong>DBP:</strong> {{ $check->blood_pressure_dbp ?? 'N/A' }} mmHg</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- FPG -->
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header" id="fpgHeading{{ $index }}">
                                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#fpgCollapse{{ $index }}" aria-expanded="false" aria-controls="fpgCollapse{{ $index }}">
                                                                    FPG
                                                                </button>
                                                            </h2>
                                                            <div id="fpgCollapse{{ $index }}" class="accordion-collapse collapse" aria-labelledby="fpgHeading{{ $index }}">
                                                                <div class="accordion-body">
                                                                    <p><strong>FPG:</strong> {{ $check->fpg ?? 'N/A' }} mg/dL</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- การได้ยิน -->
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header" id="hearingHeading{{ $index }}">
                                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#hearingCollapse{{ $index }}" aria-expanded="false" aria-controls="hearingCollapse{{ $index }}">
                                                                    การได้ยิน
                                                                </button>
                                                            </h2>
                                                            <div id="hearingCollapse{{ $index }}" class="accordion-collapse collapse" aria-labelledby="hearingHeading{{ $index }}">
                                                                <div class="accordion-body">
                                                                    <p><strong>หูซ้าย:</strong> {{ $check->hearing_left ?? 'N/A' }}</p>
                                                                    <p><strong>หูขวา:</strong> {{ $check->hearing_right ?? 'N/A' }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- กระดูกพรุน -->
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header" id="boneHeading{{ $index }}">
                                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#boneCollapse{{ $index }}" aria-expanded="false" aria-controls="boneCollapse{{ $index }}">
                                                                    กระดูกพรุน
                                                                </button>
                                                            </h2>
                                                            <div id="boneCollapse{{ $index }}" class="accordion-collapse collapse" aria-labelledby="boneHeading{{ $index }}">
                                                                <div class="accordion-body">
                                                                    <p><strong>อายุ:</strong> {{ $check->age ?? 'N/A' }} ปี</p>
                                                                    <p><strong>น้ำหนักตัว:</strong> {{ $check->weight ?? 'N/A' }} กิโลกรัม</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- หมายเหตุ -->
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header" id="noteHeading{{ $index }}">
                                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#noteCollapse{{ $index }}" aria-expanded="false" aria-controls="noteCollapse{{ $index }}">
                                                                    หมายเหตุ
                                                                </button>
                                                            </h2>
                                                            <div id="noteCollapse{{ $index }}" class="accordion-collapse collapse" aria-labelledby="noteHeading{{ $index }}">
                                                                <div class="accordion-body">
                                                                    <p>{{ $check->blood_test_results ?? 'ไม่มีข้อมูลเพิ่มเติม' }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                @else
                                    <p class="text-muted"><i class="fas fa-info-circle"></i> ยังไม่มีข้อมูลการตรวจสุขภาพ</p>
                                @endif
                            </div>
                            <div class="tab-pane fade" id="saved">
                                <p>ที่บันทึกของผู้สูงอายุจะปรากฏที่นี่</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        

        <!-- ส่วนโปรไฟล์ที่ด้านขวา -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 rounded-3 mb-4">
                <div class="card-body text-center">
                    @if($user->roles->contains('name', 'caregiver')) <!-- ถ้าเป็นผู้ดูแล -->
                        <!-- แสดงข้อมูลผู้ดูแล -->
                        <img src="{{ $user->avatar_url ?? asset('images/avatars/default-avatar.png') }}"
                            alt="รูปโปรไฟล์ผู้ดูแล" class="rounded-circle mb-3" width="120" height="120">
                        <h5 class="font-weight-bold text-primary">{{ $user->name ?? 'ไม่มีชื่อ' }}</h5>
                        <p class="text-muted mb-2">ผู้ดูแล (คุณ)</p>

                        <ul class="list-unstyled text-muted">
                            <li><strong>ความสัมพันธ์:</strong> {{ $user->relationship ?? 'ไม่มีข้อมูล' }}</li>
                            <li><strong>อายุ:</strong> {{ $user->age ?? 'ไม่มีข้อมูล' }}</li>
                            <li><strong>อาชีพ:</strong> {{ $user->occupation ?? 'ไม่มีข้อมูล' }}</li>
                        </ul>
                        <!-- ปุ่มติดต่อผู้ดูแล -->
                        <div class="d-flex justify-content-center">
                            <a href="{{ route('profile.edit', $user->id)}}" class="btn btn-sm btn-outline-primary d-flex align-items-center p-2 rounded-3" style="transition: transform 0.3s ease;">
                                <i class="bi bi-pencil-square me-2"></i>
                                <span>แก้ไขข้อมูลส่วนตัว</span>
                            </a>
                        </div>
                    @elseif($user->roles->contains('name', 'patient')) <!-- ถ้าเป็นผู้สูงอายุ -->
                        <!-- แสดงข้อมูลผู้ดูแล -->
                        <img src="{{ $user->caregiver->first()->avatar_url ?? asset('images/avatars/default-avatar.png') }}"
                            alt="รูปโปรไฟล์ผู้ดูแล" class="rounded-circle mb-3" width="120" height="120">
                        <h5 class="font-weight-bold text-primary">{{ $user->caregiver->first()->name ?? 'ไม่มีชื่อ' }}</h5>
                        <p class="text-muted mb-2">ผู้ดูแล (คุณ)</p>

                        <ul class="list-unstyled text-muted">
                            <li><strong>ความสัมพันธ์:</strong> {{ $user->caregiver->first()->relationship ?? 'ไม่มีข้อมูล' }}</li>
                            <li><strong>อายุ:</strong> {{ $user->caregiver->first()->age ?? 'ไม่มีข้อมูล' }}</li>
                            <li><strong>อาชีพ:</strong> {{ $user->caregiver->first()->occupation ?? 'ไม่มีข้อมูล' }}</li>
                        </ul>

                        <div class="d-flex justify-content-center">
                            <!-- ปุ่มติดต่อผู้ดูแล -->
                            <a href="{{ route('chat.start', $user->caregiver->first()->id)}}" class="btn btn-sm btn-outline-primary d-flex align-items-center p-2 rounded-3" style="transition: transform 0.3s ease;">
                                <i class="bi bi-chat-dots me-2"></i>
                                <span>ติดต่อผู้ดูแล</span>
                            </a>
                        </div>
                    @else
                        <div class="alert alert-warning">
                            <p class="mb-0">ข้อมูลผู้สูงอายุหรือผู้ดูแลไม่ถูกต้อง</p>
                        </div>
                    @endif
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-body">
                    <h6 class="font-weight-bold text-secondary">เกี่ยวกับ {{ $user->name ?? 'ไม่มีข้อมูล' }}</h6>
                    <p>{{ $user->bio ?? 'ยังไม่มีข้อมูลเกี่ยวกับตัวคุณ' }}</p>
                </div>
            </div>
        </div>

    </div>
</div>

<style>
    #healthChart {
        height: 400px; /* ตั้งค่าความสูงของกราฟ */
        width: 100%;    /* ตั้งค่าให้กราฟยืดเต็มขนาด width */
    }
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // ดึงข้อมูลจาก controller และแปลงเป็น JSON
        var measurements = @json($physicalInfo);

        // คำนวณข้อมูลแสดงในแกน X (Date) และแกน Y (Height, Weight)
        var dates = measurements.map(function(measurement) {
            return measurement.date; // ใช้วันที่ในการแสดงผลในแกน X
        });

        var heights = measurements.map(function(measurement) {
            return measurement.height; // ส่วนสูงจากแต่ละการวัด
        });

        var weights = measurements.map(function(measurement) {
            return measurement.weight; // น้ำหนักจากแต่ละการวัด
        });

        // ตรวจสอบว่า canvas มีอยู่จริง
        var ctx = document.getElementById('healthChart');
        if (!ctx) {
            console.error("ไม่พบ Canvas ที่มี id='healthChart'");
            return;
        }

        var chartCtx = ctx.getContext('2d');
        if (!chartCtx) {
            console.error("ไม่สามารถสร้าง context สำหรับ Canvas ได้");
            return;
        }

        // สร้างกราฟ
        var healthChart = new Chart(chartCtx, {
            type: 'line', // กราฟเส้น
            data: {
                labels: dates, // แกน X ใช้วันที่
                datasets: [{
                    label: 'ส่วนสูง (cm)',
                    data: heights,
                    borderColor: '#4CAF50', // สีกราฟส่วนสูง
                    backgroundColor: 'rgba(76, 175, 80, 0.2)', // สีพื้นหลัง
                    fill: true, // เติมสีพื้นหลังในกราฟ
                    pointStyle: 'circle', // รูปแบบจุดที่กราฟ
                    pointRadius: 6, // ขนาดของจุด
                    borderWidth: 3, // ความหนาของเส้น
                    tension: 0.4, // ความนุ่มของเส้น
                    cubicInterpolationMode: 'monotone', // โค้งกราฟให้ดูนุ่ม
                }, {
                    label: 'น้ำหนัก (kg)',
                    data: weights,
                    borderColor: '#FF5722', // สีกราฟน้ำหนัก
                    backgroundColor: 'rgba(255, 87, 34, 0.2)', // สีพื้นหลัง
                    fill: true, // เติมสีพื้นหลังในกราฟ
                    pointStyle: 'triangle', // รูปแบบจุดในกราฟ
                    pointRadius: 6, // ขนาดของจุด
                    borderWidth: 3, // ความหนาของเส้น
                    tension: 0.4, // ความนุ่มของเส้น
                    cubicInterpolationMode: 'monotone', // โค้งกราฟให้ดูนุ่ม
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                scales: {
                    y: {
                        beginAtZero: false, // ปรับค่าตั้งแต่ 0 หรือไม่ตามข้อมูลจริง
                        ticks: {
                            stepSize: 5, // ระยะห่างของแต่ละ tick
                        }
                    }
                },
                animation: {
                    duration: 1500,
                    easing: 'easeInOutCubic',
                },
                elements: {
                    line: {
                        borderWidth: 3, // ความหนาของเส้นกราฟ
                    },
                    point: {
                        radius: 5, // ขนาดจุดที่กราฟ
                        hoverRadius: 8, // ขนาดจุดตอน hover
                        backgroundColor: '#8BC34A', // สีของจุดที่ hover
                    }
                },
                plugins: {
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.7)', // สีพื้นหลังของ tooltip
                        titleFont: {
                            size: 16, // ขนาดฟอนต์ของ title ใน tooltip
                        },
                        bodyFont: {
                            size: 14, // ขนาดฟอนต์ของ body ใน tooltip
                        }
                    }
                }
            }
        });

        console.log("กราฟถูกสร้างแล้ว");
    });
</script>

@endsection
