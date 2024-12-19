@extends('layouts.carefield')

@section('title', 'CareField')

@section('content')
<div class="container-fluid my-3 mx-2">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('carefield.index') }}" class="text-decoration-none">หน้าหลัก</a></li>
            <li class="breadcrumb-item active" aria-current="page">การจัดการแบบฟอร์ม</li>
        </ol>
    </nav>
    <h1 class="mb-4">แบบฟอร์ม</h1>
    
    <div class="row g-4">
        <!-- Card: ลงทะเบียนผู้รับการตรวจ -->
        <div class="col-md-4">
            <div class="card card-hover text-center shadow border-0">
                <div class="card-body">
                    <div class="icon-container mb-3">
                        <i class="fas fa-user-plus fa-3x text-primary"></i>
                    </div>
                    <h5 class="card-title">ลงทะเบียนผู้รับการตรวจ</h5>
                    <p class="card-text">ลงทะเบียนข้อมูลของผู้ที่ต้องการรับการตรวจ</p>
                    <button class="btn btn-primary btn-animated" data-bs-toggle="modal" data-bs-target="#registerPatientModal">เปิด</button>
                </div>
            </div>
        </div>

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

<!-- Modals -->
<!-- Modal: ลงทะเบียนผู้รับการตรวจ -->
<div class="modal fade" id="registerPatientModal" tabindex="-1" aria-labelledby="registerPatientModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animate__animated animate__fadeInDown">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="registerPatientModalLabel">ลงทะเบียนผู้รับการตรวจ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('patients.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <!-- Section: ข้อมูลบัญชี -->
                    <h5 class="mb-3 text-secondary">ข้อมูลบัญชี</h5>
                    <div class="row g-3 align-items-end">
                        <div class="col-md-12">
                            <label for="email" class="form-label">
                                อีเมล <small class="text-muted">(กรุณากรอกชื่อจริงตามบัตรประจำตัวประชาชนเป็นภาษาอังกฤษ)</small>
                            </label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="name_english" placeholder="กรอกชื่อเป็นภาษาอังกฤษ" required>
                                <span class="input-group-text">@gmail.com</span>
                                <input type="hidden" id="email" name="email">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="password" class="form-label">รหัสผ่าน <small class="text-muted">(กรุณากรอกวัน/เดือน/ปีเกิดก่อนสร้างรหัสผ่าน)</small></label>
                            <input type="text" class="form-control" id="password" name="password" placeholder="รหัสผ่านจะถูกสร้างอัตโนมัติ" readonly>
                        </div>
                        <div class="col-md-12 text-end">
                            <button type="button" class="btn btn-outline-secondary" onclick="generateCredentials()">สร้างรหัสผ่าน</button>
                        </div>
                    </div>

                    <!-- Section: ข้อมูลส่วนตัว -->
                    <h5 class="mt-4 text-secondary">ข้อมูลส่วนตัว</h5>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label">ชื่อผู้ใช้งาน</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="ชื่อผู้ป่วย" required>
                        </div>
                        <div class="col-md-6">
                            <label for="date_of_birth" class="form-label">วันเกิด</label>
                            <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" required>
                        </div>
                        <div class="col-md-6">
                            <label for="gender" class="form-label">เพศ</label>
                            <select class="form-select" id="gender" name="gender" required>
                                <option value="male">ชาย</option>
                                <option value="female">หญิง</option>
                                <option value="other">อื่น ๆ</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label for="phone" class="form-label">เบอร์โทรศัพท์</label>
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="เบอร์โทรศัพท์ เช่น 081-234-5678">
                        </div>
                        <div class="col-md-12">
                            <label for="address" class="form-label">ที่อยู่</label>
                            <textarea class="form-control" id="address" name="address" rows="3" placeholder="กรอกที่อยู่ปัจจุบัน" required></textarea>
                        </div>
                    </div>

                    <!-- Section: ข้อมูลทางการแพทย์ -->
                    <h5 class="mt-4 text-secondary">ข้อมูลทางการแพทย์</h5>
                    <div class="mb-3">
                        <label for="medical_history" class="form-label">ประวัติทางการแพทย์</label>
                        <textarea class="form-control" id="medical_history" name="medical_history" rows="3" placeholder="เช่น เบาหวาน, ความดันโลหิตสูง"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="allergies" class="form-label">ประวัติการแพ้ยา</label>
                        <textarea class="form-control" id="allergies" name="allergies" rows="3" placeholder="ระบุรายการยา หรือ ไม่มี"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="medications" class="form-label">การใช้ยาปัจจุบัน</label>
                        <textarea class="form-control" id="medications" name="medications" rows="3" placeholder="เช่น Paracetamol, Aspirin"></textarea>
                    </div>
                </div>

                <!-- Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                    <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
                </div>
            </form>
        </div>
    </div>
</div>



<!-- Modal: บันทึกการตรวจเลือด -->
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
</div>

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

<script>
    function generateCredentials() {
        // รับค่าชื่อภาษาอังกฤษและวันเกิด
        const nameEnglish = document.getElementById('name_english').value.trim();
        const dob = document.getElementById('date_of_birth').value;

        if (!nameEnglish || !dob) {
            alert('กรุณากรอกวันเดือนปีเกิดก่อนสร้างรหัสผ่าน');
            return;
        }

        // สร้างอีเมลโดยใช้ชื่อภาษาอังกฤษและ @gmail.com
        const email = `${nameEnglish.toLowerCase().replace(/[^a-zA-Z0-9]/g, '')}@gmail.com`;

        // สร้างรหัสผ่านในรูปแบบ CB-<วันเดือนปีเกิด>
        const password = `CB-${dob.replace(/-/g, '')}`;

        // อัปเดตค่าฟิลด์
        document.getElementById('email').value = email;
        document.getElementById('password').value = password;
    }

</script>