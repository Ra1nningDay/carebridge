@extends('layouts.carefield')

@section('title', 'CareField')

@section('content')
<div class="container-fluid my-3 mx-2">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('carefield.index') }}" class="text-decoration-none">หน้าหลัก</a></li>
            <li class="breadcrumb-item active" aria-current="page">รายชื่อผู้รับการตรวจสุขภาพ</li>
        </ol>
    </nav>
    <h1 class="mb-4">รายชื่อผู้รับการตรวจสุขภาพ</h1>
    <!-- Section: เครื่องมือค้นหา -->
    <div class="card mb-4 shadow-sm border-0">
        <div class="card-body">
            <h5 class="card-title"><i class="fas fa-search text-primary"></i> เครื่องมือค้นหา</h5>
            <form action="#" method="GET">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label for="search_name" class="form-label">ชื่อผู้รับการตรวจ</label>
                        <input type="text" id="search_name" class="form-control" name="search_name" placeholder="กรอกชื่อ">
                    </div>
                    <div class="col-md-4">
                        <label for="search_date" class="form-label">วันที่ตรวจ</label>
                        <input type="date" id="search_date" class="form-control" name="search_date">
                    </div>
                    <div class="col-md-4">
                        <label for="search_risk" class="form-label">ความเสี่ยง</label>
                        <select id="search_risk" class="form-select" name="search_risk">
                            <option value="">ทั้งหมด</option>
                            <option value="hypertension">ความดันโลหิตสูง</option>
                            <option value="diabetes">โรคเบาหวาน</option>
                            <option value="osteoporosis">กระดูกพรุน</option>
                        </select>
                    </div>
                </div>
                <div class="row g-3 mt-3">
                    <div class="col-md-4">
                        <label for="hearing_status" class="form-label">การได้ยิน</label>
                        <select id="hearing_status" class="form-select" name="hearing_status">
                            <option value="">ทั้งหมด</option>
                            <option value="normal">ปกติ</option>
                            <option value="impaired">มีปัญหา</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="age_range" class="form-label">ช่วงอายุ</label>
                        <div class="input-group">
                            <input type="number" id="age_min" class="form-control" name="age_min" placeholder="อายุต่ำสุด">
                            <span class="input-group-text">-</span>
                            <input type="number" id="age_max" class="form-control" name="age_max" placeholder="อายุมากสุด">
                        </div>
                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-filter"></i> ค้นหา
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- รายชื่อผู้ป่วย -->
    <div class="row g-4">
        @forelse ($users as $user)
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <i class="fas fa-user-md fa-3x text-primary mb-3"></i>
                    <h5 class="card-title"><strong>ผู้รับการตรวจ:</strong> {{ $user->id }}</h5>
                    <p class="card-text fs-5"><strong>ชื่อ:</strong> {{ $user->name }}</p>
                    <p class="card-text"><strong>วันเกิด:</strong> {{ $user->personalInfo->date_of_birth ?? 'N/A' }}</p>
                    <p class="card-text"><strong>วันที่ตรวจล่าสุด:</strong> 
                        {{ optional($user->healthChecks->sortByDesc('check_date')->first())->check_date ?? 'N/A' }}
                    </p>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#patientModal{{ $user->id }}">
                        ดูข้อมูล
                    </button>
                </div>
            </div>
        </div>

        <!-- Modal: ข้อมูลผู้ป่วย -->
        <div class="modal fade" id="patientModal{{ $user->id }}" tabindex="-1" aria-labelledby="patientModalLabel{{ $user->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title">
                            <i class="fas fa-user-md"></i> ข้อมูลผู้ป่วย: {{ $user->name }}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- ข้อมูลส่วนตัว -->
                        <h6 class="text-primary"><i class="fas fa-user"></i> ข้อมูลส่วนตัว</h6>
                        <div class="row">
                            <div class="col-md-4 text-center">
                                <img src="{{ asset('images/default-avatar.png') }}" class="rounded-circle img-fluid" alt="Patient Avatar" style="width: 120px; height: 120px;">
                                <p class="mt-2"><strong>รหัสผู้ป่วย:</strong> {{ $user->id }}</p>
                            </div>
                            <div class="col-md-8">
                                <table class="table table-sm table-bordered">
                                    <tbody>
                                        <tr>
                                            <th class="bg-light">ชื่อ:</th>
                                            <td>{{ $user->name }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-light">อีเมล:</th>
                                            <td>{{ $user->email }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-light">วันเกิด:</th>
                                            <td>{{ $user->personalInfo->date_of_birth ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-light">เพศ:</th>
                                            <td>{{ $user->personalInfo->gender ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-light">เบอร์โทร:</th>
                                            <td>{{ $user->personalInfo->phone ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-light">ที่อยู่:</th>
                                            <td>{{ $user->personalInfo->address ?? 'N/A' }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- ข้อมูลการตรวจสุขภาพ -->
                        <h6 class="text-primary mt-4"><i class="fas fa-heartbeat"></i> ข้อมูลการตรวจสุขภาพ</h6>
                        @if ($user->healthChecks->count() > 0)
                        <div class="accordion" id="healthCheckAccordion">
                            @foreach ($user->healthChecks as $index => $check)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading{{ $index }}">
                                    <button class="accordion-button {{ $index !== 0 ? 'collapsed' : '' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}" aria-expanded="{{ $index === 0 ? 'true' : 'false' }}" aria-controls="collapse{{ $index }}">
                                        <strong>การตรวจสุขภาพครั้งที่ {{ $index + 1 }} - {{ $check->check_date }}</strong>
                                    </button>
                                </h2>
                                <div id="collapse{{ $index }}" class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}" aria-labelledby="heading{{ $index }}" data-bs-parent="#healthCheckAccordion">
                                    <div class="accordion-body">
                                        <div class="row">
                                            <!-- ความดันโลหิต -->
                                            <div class="col-md-6">
                                                <p><strong><i class="fas fa-heartbeat text-danger"></i> ความดันตัวบน (SBP):</strong> {{ $check->blood_pressure_sbp ?? 'N/A' }} mmHg</p>
                                                <p><strong><i class="fas fa-heartbeat text-danger"></i> ความดันตัวล่าง (DBP):</strong> {{ $check->blood_pressure_dbp ?? 'N/A' }} mmHg</p>
                                                @php
                                                    $pressureRisk = ($check->blood_pressure_sbp > 140 || $check->blood_pressure_dbp > 90) ? 'มีความเสี่ยง' : 'ปกติ';
                                                @endphp
                                                <p class="text-warning"><strong><i class="fas fa-exclamation-circle"></i> ความเสี่ยงความดันโลหิตสูง:</strong> {{ $pressureRisk }}</p>
                                            </div>

                                            <!-- FPG -->
                                            <div class="col-md-6">
                                                <p><strong><i class="fas fa-syringe text-info"></i> FPG:</strong> {{ $check->fpg ?? 'N/A' }} mg/dL</p>
                                                @php
                                                    $diabetesRisk = ($check->fpg > 126) ? 'มีความเสี่ยง' : 'ปกติ';
                                                @endphp
                                                <p class="text-danger"><strong><i class="fas fa-exclamation-circle"></i> เสี่ยงโรคเบาหวาน:</strong> {{ $diabetesRisk }}</p>
                                            </div>

                                            <!-- การได้ยิน -->
                                            <div class="col-md-6">
                                                <p><strong><i class="fas fa-deaf text-info"></i> การได้ยิน หูซ้าย:</strong> {{ $check->hearing_left ?? 'N/A' }}</p>
                                                <p><strong><i class="fas fa-deaf text-info"></i> การได้ยิน หูขวา:</strong> {{ $check->hearing_right ?? 'N/A' }}</p>
                                                @php
                                                    $hearingRisk = ($check->hearing_left === 'ไม่ได้ยิน' || $check->hearing_right === 'ไม่ได้ยิน') ? 'มีปัญหาการได้ยิน' : 'ปกติ';
                                                @endphp
                                                <p class="text-warning"><strong><i class="fas fa-exclamation-circle"></i> สถานะการได้ยิน:</strong> {{ $hearingRisk }}</p>
                                            </div>

                                            <!-- กระดูกพรุน -->
                                            <div class="col-md-6">
                                                <p><strong><i class="fas fa-bone text-info"></i> อายุ:</strong> {{ $check->age ?? 'N/A' }} ปี</p>
                                                <p><strong><i class="fas fa-bone text-info"></i> น้ำหนักตัว:</strong> {{ $check->weight ?? 'N/A' }} กิโลกรัม</p>
                                                @php
                                                    $ostaIndex = ($check->weight && $check->age) ? 0.2 * ($check->weight - $check->age) : 'N/A';
                                                    $osteoporosisRisk = 'N/A';
                                                    if ($ostaIndex !== 'N/A') {
                                                        $osteoporosisRisk = ($ostaIndex < -4) ? 'สูง' : (($ostaIndex >= -4 && $ostaIndex <= -1) ? 'ปานกลาง' : 'ต่ำ');
                                                    }
                                                @endphp
                                                <p><strong><i class="fas fa-calculator text-info"></i> คะแนน OSTA Index:</strong> {{ $ostaIndex }}</p>
                                                <p><strong><i class="fas fa-exclamation-circle"></i> ความเสี่ยงกระดูกพรุน:</strong> {{ $osteoporosisRisk }}</p>
                                            </div>

                                            <!-- หมายเหตุ -->
                                            <div class="col-12">
                                                <p><strong><i class="fas fa-file-alt text-primary"></i> หมายเหตุ:</strong> {{ $check->blood_test_results ?? 'ไม่มีข้อมูลเพิ่มเติม' }}</p>
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




                        <!-- ปุ่มเพิ่มข้อมูล -->
                        <div class="mt-3 text-end">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addHealthCheckModal{{ $user->id }}">
                                เพิ่มข้อมูลการตรวจสุขภาพ
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal: เพิ่มข้อมูลการตรวจสุขภาพ -->
        <div class="modal fade" id="addHealthCheckModal{{ $user->id }}" tabindex="-1" aria-labelledby="addHealthCheckModalLabel{{ $user->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">
                            <i class="fas fa-notes-medical"></i> เพิ่มข้อมูลการตรวจสุขภาพ
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('health_checks.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <input type="hidden" name="user_id" value="{{ $user->id }}">

                            <!-- ข้อมูลพื้นฐาน -->
                            <h6 class="text-secondary mt-4"><i class="fas fa-calendar-alt"></i> ข้อมูลพื้นฐาน</h6>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="check_date" class="form-label">วันที่ตรวจ</label>
                                    <input type="date" class="form-control" name="check_date" required>
                                </div>
                            </div>

                            <!-- ความดันโลหิต -->
                            <h6 class="text-secondary mt-4"><i class="fas fa-heartbeat"></i> ความดันโลหิต</h6>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="blood_pressure_sbp" class="form-label">ความดันตัวบน (SBP)</label>
                                    <input type="number" class="form-control" name="blood_pressure_sbp" placeholder="เช่น 120 mmHg">
                                </div>
                                <div class="col-md-6">
                                    <label for="blood_pressure_dbp" class="form-label">ความดันตัวล่าง (DBP)</label>
                                    <input type="number" class="form-control" name="blood_pressure_dbp" placeholder="เช่น 80 mmHg">
                                </div>
                            </div>

                            <!-- ระดับน้ำตาลในเลือด -->
                            <h6 class="text-secondary mt-4"><i class="fas fa-vial"></i> ระดับน้ำตาลในเลือด (DTX)</h6>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="fpg" class="form-label">ระดับน้ำตาลในเลือด (DTX)</label>
                                    <input type="number" class="form-control" name="fpg" placeholder="mg/dL">
                                </div>
                                <div class="col-md-6">
                                    <label for="fpg_risk" class="form-label">เสี่ยงโรคเบาหวาน</label>
                                    <select class="form-select" name="fpg_risk" required>
                                        <option value="1">ใช่</option>
                                        <option value="0">ไม่ใช่</option>
                                    </select>
                                </div>
                            </div>

                            <!-- การได้ยิน -->
                            <h6 class="text-secondary mt-4"><i class="fas fa-ear-listen"></i> การคัดกรองการได้ยิน</h6>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="hearing_left" class="form-label">ผลการได้ยิน (หูซ้าย)</label>
                                    <select class="form-select" name="hearing_left">
                                        <option value="ได้ยิน">ได้ยิน</option>
                                        <option value="ไม่ได้ยิน">ไม่ได้ยิน</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="hearing_right" class="form-label">ผลการได้ยิน (หูขวา)</label>
                                    <select class="form-select" name="hearing_right">
                                        <option value="ได้ยิน">ได้ยิน</option>
                                        <option value="ไม่ได้ยิน">ไม่ได้ยิน</option>
                                    </select>
                                </div>
                            </div>

                            <!-- การคัดกรองกระดูกพรุน -->
                            <h6 class="text-secondary mt-4"><i class="fas fa-bone"></i> การคัดกรองกระดูกพรุน</h6>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="age" class="form-label">อายุ</label>
                                    <input type="number" class="form-control" name="age" placeholder="ปี">
                                </div>
                                <div class="col-md-6">
                                    <label for="weight" class="form-label">น้ำหนักตัว</label>
                                    <input type="number" class="form-control" name="weight" placeholder="กิโลกรัม">
                                </div>
                            </div>

                            <!-- หมายเหตุ -->
                            <h6 class="text-secondary mt-4"><i class="fas fa-file-alt"></i> หมายเหตุ</h6>
                            <div class="mb-3">
                                <label for="blood_test_results" class="form-label">ผลตรวจเลือด</label>
                                <textarea class="form-control" name="blood_test_results" rows="3" placeholder="ระบุผลตรวจเลือดเพิ่มเติม..."></textarea>
                            </div>
                        </div>

                        <!-- Footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                <i class="fas fa-times"></i> ปิด
                            </button>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save"></i> บันทึก
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        @empty
        <p class="text-center text-muted">ไม่มีข้อมูลผู้ป่วย</p>
        @endforelse
    </div>
</div>
@endsection



<style>
    /* การตกแต่งการ์ดผู้ป่วย */
    .patient-card {
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .patient-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
    }

    .patient-card-header {
        padding: 15px;
        border-bottom: 1px solid #ddd;
    }

    .patient-card img {
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .btn-info {
        background-color: #17a2b8;
        border-color: #17a2b8;
    }

    .btn-info:hover {
        background-color: #138496;
        border-color: #117a8b;
    }
    
</style>
