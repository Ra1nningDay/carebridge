@extends('layouts.carefield')

@section('title', 'CareField')

@section('content')
<div class="container-fluid my-3 mx-2">
    <!-- Breadcrumb -->
    @include('carefield.partials.breadcrumb')

    <h1 class="mb-4">แบบฟอร์ม</h1>
    <div class="row g-4">
        <!-- Card: ลงทะเบียนผู้รับการตรวจ -->
        @include('carefield.form.register.register')

        {{-- <!-- Card: บันทึกการตรวจเลือด -->
        <div class="col-md-4">
            <div class="card card-hover text-center shadow border-0">
                <div class="card-body">
                    <div class="icon-container mb-3">
                        <i class="fas fa-tint fa-3x text-danger"></i>
                    </div>
                    <h5 class="card-title">บันทึกการตรวจเลือด</h5>
                    <p class="card-text">บันทึกผลการตรวจเลือดของผู้ป่วย</p>
                    <button class="btn btn-danger btn-animated" data-bs-toggle="modal" data-bs-target="#bloodTestModal">เปิด</button>
                </div>
            </div>
        </div>

        <!-- Card: บันทึกตรวจความดัน -->
        <div class="col-md-4">
            <div class="card card-hover text-center shadow border-0">
                <div class="card-body">
                    <div class="icon-container mb-3">
                        <i class="fas fa-heartbeat fa-3x text-success"></i>
                    </div>
                    <h5 class="card-title">บันทึกตรวจความดัน</h5>
                    <p class="card-text">บันทึกผลการตรวจความดันของผู้ป่วย</p>
                    <button class="btn btn-success btn-animated" data-bs-toggle="modal" data-bs-target="#pressureTestModal">เปิด</button>
                </div>
            </div>
        </div> --}}
    </div>
</div>

{{-- <!-- Modal: บันทึกการตรวจเลือด -->
<div class="modal fade" id="bloodTestModal" tabindex="-1" aria-labelledby="bloodTestModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animate__animated animate__fadeInDown">
            <div class="modal-header">
                <h5 class="modal-title" id="bloodTestModalLabel">บันทึกการตรวจเลือด</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="patient_id" class="form-label">รหัสผู้ป่วย</label>
                        <input type="text" class="form-control" id="patient_id" name="patient_id" required>
                    </div>
                    <div class="mb-3">
                        <label for="blood_result" class="form-label">ผลตรวจเลือด</label>
                        <textarea class="form-control" id="blood_result" name="blood_result" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">บันทึก</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal: บันทึกตรวจความดัน -->
<div class="modal fade" id="pressureTestModal" tabindex="-1" aria-labelledby="pressureTestModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animate__animated animate__fadeInDown">
            <div class="modal-header">
                <h5 class="modal-title" id="pressureTestModalLabel">บันทึกตรวจความดัน</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="patient_id" class="form-label">รหัสผู้ป่วย</label>
                        <input type="text" class="form-control" id="patient_id" name="patient_id" required>
                    </div>

                    <div class="mb-3">
                        <label for="sbp" class="form-label">ระดับความดันโลหิตตัวบน (SBP) <small class="text-muted">(มม.ปรอท)</small></label>
                        <input type="number" class="form-control" id="sbp" name="sbp" placeholder="กรอกค่า SBP เช่น 120" required>
                    </div>

                    <div class="mb-3">
                        <label for="dbp" class="form-label">ระดับความดันโลหิตตัวล่าง (DBP) <small class="text-muted">(มม.ปรอท)</small></label>
                        <input type="number" class="form-control" id="dbp" name="dbp" placeholder="กรอกค่า DBP เช่น 80" required>
                    </div>

                    <div class="alert alert-info" role="alert">
                        <strong>การพิจารณา:</strong> ความดันโลหิตสูงเมื่อ:
                        <ul>
                            <li>SBP ≥ 140 มม.ปรอท</li>
                            <li>หรือ DBP ≥ 90 มม.ปรอท</li>
                        </ul>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">บันทึก</button>
                </div>
            </form>
        </div>
    </div>
</div> --}}

@endsection

<style>
    .card-hover {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card-hover:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }

    .btn-animated {
        position: relative;
        overflow: hidden;
    }

    .btn-animated::before {
        content: "";
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.2);
        transition: left 0.3s ease;
    }

    .btn-animated:hover::before {
        left: 100%;
    }

</style>
