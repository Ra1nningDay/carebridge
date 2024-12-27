<!-- Card: ลงทะเบียนผู้รับการตรวจ -->
<div class="col-md-4">
    <div class="card card-hover text-center shadow border-0">
        <div class="card-body">
            <div class="icon-container mb-3">
                <i class="fas fa-user-plus fa-3x text-primary"></i>
            </div>
            <h5 class="card-title">ลงทะเบียนผู้รับการตรวจและผู้ดูแล</h5>
            <p class="card-text">ลงทะเบียนข้อมูลของผู้ที่ต้องการรับการตรวจ</p>
            <button class="btn btn-primary btn-animated" data-bs-toggle="modal" data-bs-target="#registerPatientModal">เปิด</button>
        </div>
    </div>
</div>

<!-- Modal: ลงทะเบียนผู้รับการตรวจ -->
<div class="modal fade" id="registerPatientModal" tabindex="-1" aria-labelledby="registerPatientModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animate__animated animate__fadeInDown">
            <div class="modal-header bg-primary text-white border-0">
                <h5 class="modal-title" id="registerPatientModalLabel">ลงทะเบียนผู้รับการตรวจ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('patients.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row g-3">
                        <!-- Left Column: ข้อมูลผู้รับการตรวจ -->
                        <div class="col-md-6">
                            <h6 class="text-secondary">ข้อมูลผู้รับการตรวจ</h6>
                            <!-- Citizen ID -->
                            <div class="mb-3">
                                <label for="citizen_id" class="form-label">
                                    <i class="bi bi-card-id"></i> รหัสบัตรประชาชนของผู้รับการตรวจ
                                </label>
                                <input type="text" class="form-control" name="citizen_id" id="citizen_id" placeholder="กรอกรหัสบัตรประจำตัวประชาชน 13 หลัก" maxlength="13" required pattern="^\d{13}$">
                            </div>

                            <!-- Full Name -->
                            <div class="mb-3">
                                <div class="row">
                                    <!-- First Name -->
                                    <div class="col-md-6">
                                        <label for="first_name" class="form-label">
                                            <i class="bi bi-person"></i> ชื่อ
                                        </label>
                                        <input type="text" class="form-control" name="first_name" id="first_name" placeholder="กรุณากรอกชื่อ" required maxlength="255">
                                    </div>

                                    <!-- Last Name -->
                                    <div class="col-md-6">
                                        <label for="last_name" class="form-label">
                                            <i class="bi bi-person"></i> นามสกุล
                                        </label>
                                        <input type="text" class="form-control" name="last_name" id="last_name" placeholder="กรุณากรอกนามสกุล" required maxlength="255">
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="row">
                                    <!-- First Name -->
                                    <div class="col-md-6">
                                        <label for="password" class="form-label">
                                            <i class="bi bi-lock"></i> รหัสผ่าน
                                        </label>
                                        <input type="text" class="form-control" id="password" name="password" placeholder="รหัสผ่านจะถูกสร้างอัตโนมัติเมื่อกรอกวันเกิด" readonly>
                                    </div>

                                    <!-- Last Name -->
                                    <div class="col-md-6">
                                        <label for="date_of_birth" class="form-label">
                                            <i class="bi bi-calendar-date"></i> วัน/เดือน/ปีเกิด
                                        </label>
                                        <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" required onchange="generateCredentials(); convertToBuddhistEra();">
                                    </div>
                                </div>
                            </div>

                            <!-- Gender -->
                            <div class="mb-3">
                                <label for="gender" class="form-label">
                                    <i class="bi bi-gender-ambiguous"></i> เพศ
                                </label>
                                <select class="form-select" id="gender" name="gender" required>
                                    <option value="male">ชาย</option>
                                    <option value="female">หญิง</option>
                                    <option value="other">อื่นๆ</option>
                                </select>
                            </div>

                            <!-- Weight -->
                            <div class="mb-3">
                                <label for="weight" class="form-label">
                                    <i class="bi bi-speedometer2"></i> น้ำหนัก (กิโลกรัม)
                                </label>
                                <input type="number" class="form-control" id="weight" name="weight" placeholder="กรุณากรอกน้ำหนัก" step="0.1" min="0">
                            </div>

                            <!-- Height -->
                            <div class="mb-3">
                                <label for="height" class="form-label">
                                    <i class="bi bi-rulers"></i> ส่วนสูง (เซนติเมตร)
                                </label>
                                <input type="number" class="form-control" id="height" name="height" placeholder="กรุณากรอกส่วนสูง" step="0.1" min="0">
                            </div>

                            <!-- Blood Type -->
                            <div class="mb-3">
                                <label for="blood_type" class="form-label">
                                    <i class="bi bi-droplet"></i> ประเภทเลือด
                                </label>
                                <select class="form-select" id="blood_type" name="blood_type">
                                    <option value="">กรุณาเลือกประเภทเลือด</option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="AB">AB</option>
                                    <option value="O">O</option>
                                    <option value="Other">อื่นๆ</option>
                                </select>
                            </div>

                            <!-- Phone -->
                            <div class="mb-3">
                                <label for="phone" class="form-label">
                                    <i class="bi bi-telephone"></i> เบอร์โทรศัพท์
                                </label>
                                <input type="tel" class="form-control" id="phone" name="phone" placeholder="กรุณากรอกเบอร์โทรศัพท์" maxlength="10" pattern="^\d{10}$">
                            </div>

                            <!-- Address -->
                            <div class="mb-3">
                                <label for="address" class="form-label">
                                    <i class="bi bi-house-door"></i> ที่อยู่
                                </label>
                                <input type="text" class="form-control" id="address" name="address" placeholder="กรุณากรอกที่อยู่" maxlength="255">
                            </div>

                            <!-- Medical History -->
                            <div class="mb-3">
                                <label for="medical_history" class="form-label">
                                    <i class="bi bi-clipboard"></i> ประวัติการรักษา
                                </label>
                                <textarea class="form-control" id="medical_history" name="medical_history" rows="3" placeholder="กรุณากรอกประวัติการรักษา"></textarea>
                            </div>

                            <!-- Allergies -->
                            <div class="mb-3">
                                <label for="allergies" class="form-label">
                                    <i class="bi bi-syringe"></i> อาการแพ้
                                </label>
                                <textarea class="form-control" id="allergies" name="allergies" rows="3" placeholder="กรุณากรอกอาการแพ้ (ถ้ามี)"></textarea>
                            </div>

                            <!-- Medications -->
                            <div class="mb-3">
                                <label for="medications" class="form-label">
                                    <i class="bi bi-capsule"></i> ยาที่ใช้อยู่
                                </label>
                                <textarea class="form-control" id="medications" name="medications" rows="3" placeholder="กรุณากรอกยาที่ใช้อยู่ (ถ้ามี)"></textarea>
                            </div>
                        </div>

                        <!-- Right Column: ข้อมูลผู้ดูแล -->
                        <div class="col-md-6">
                            <h6 class="text-secondary">ข้อมูลผู้ดูแล</h6>

                            <!-- Caregiver Citizen ID -->
                            <div class="mb-3">
                                <label for="caregiver_citizen_id" class="form-label">
                                    <i class="bi bi-card-id"></i> รหัสบัตรประชาชนของผู้ดูแล
                                </label>
                                <input type="text" class="form-control" name="caregiver_citizen_id" id="caregiver_citizen_id" required placeholder="กรอกรหัสบัตรประจำตัวประชาชน 13 หลัก" maxlength="13" required pattern="^\d{13}$">
                            </div>

                            <!-- Caregiver Name -->
                            <div class="mb-3">
                                <div class="row">
                                    <!-- First Name -->
                                    <div class="col-md-6">
                                        <label for="first_name" class="form-label">
                                            <i class="bi bi-person"></i> ชื่อ
                                        </label>
                                        <input type="text" class="form-control" name="caregiver_fname" id="caregiver_fname" placeholder="กรุณากรอกชื่อ" required maxlength="255">
                                    </div>

                                    <!-- Last Name -->
                                    <div class="col-md-6">
                                        <label for="last_name" class="form-label">
                                            <i class="bi bi-person"></i> นามสกุล
                                        </label>
                                        <input type="text" class="form-control" name="caregiver_lname" id="caregiver_lname" placeholder="กรุณากรอกนามสกุล" required maxlength="255">
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="row">
                                    <!-- First Name -->
                                    <div class="col-md-6">
                                        <label for="password" class="form-label">
                                            <i class="bi bi-lock"></i> รหัสผ่าน
                                        </label>
                                        <input type="text" class="form-control" id="caregiver_password" name="caregiver_password" placeholder="รหัสผ่านจะถูกสร้างอัตโนมัติเมื่อกรอกวันเกิด" readonly>
                                    </div>

                                    <!-- Last Name -->
                                    <div class="col-md-6">
                                        <label for="date_of_birth" class="form-label">
                                            <i class="bi bi-calendar-date"></i> วัน/เดือน/ปีเกิด
                                        </label>
                                        <input type="date" class="form-control" id="caregiver_date_of_birth" name="caregiver_date_of_birth" required onchange="generateCredentials(); convertToBuddhistEra();">
                                    </div>
                                </div>
                            </div>

                            <!-- Caregiver Phone -->
                            <div class="mb-3">
                                <label for="caregiver_phone" class="form-label">
                                    <i class="bi bi-telephone"></i> เบอร์โทรศัพท์ของผู้ดูแล
                                </label>
                                <input type="text" class="form-control" name="caregiver_phone" id="caregiver_phone" required placeholder="กรุณากรอกเบอร์โทรศัพท์">
                            </div>

                            <!-- Caregiver Address -->
                            <div class="mb-3">
                                <label for="caregiver_address" class="form-label">
                                    <i class="bi bi-house-door"></i> ที่อยู่ของผู้ดูแล
                                </label>
                                <input type="text" class="form-control" name="caregiver_address" id="caregiver_address" required placeholder="กรุณากรอกที่อยู่">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                    <button type="submit" class="btn btn-success">บันทึกข้อมูล</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    function generateCredentials(event) {
        // รับค่าจากวันที่เกิด
        const dob = document.getElementById('date_of_birth').value;

        if (!dob) {
            // ถ้ายังไม่ได้กรอกวันเกิด
            document.getElementById('password').value = '';
            return;
        }

        // สร้างรหัสผ่านจากวัน/เดือน/ปีเกิด
        // ใช้ฟอร์แมต YYYYMMDD เช่น 1990-01-01 -> 19900101
        const password = `${dob.replace(/-/g, '')}`;

        // ใส่รหัสผ่านในช่องกรอก
        document.getElementById('password').value = password;

        // ส่งฟอร์มหลังจากที่รหัสผ่านถูกตั้งค่า
        event.preventDefault();  // ป้องกันการส่งฟอร์มก่อน
        event.target.submit();   // ส่งฟอร์มหลังจากตั้งค่ารหัสผ่าน
    }

    function validateIdCard(input) {
        // กรองเฉพาะตัวเลข
        input.value = input.value.replace(/[^0-9]/g, '');
    }

</script>
