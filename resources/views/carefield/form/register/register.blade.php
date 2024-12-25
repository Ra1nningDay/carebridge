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
                            <label for="id_card" class="form-label">
                                รหัสบัตรประจำตัวประชาชน <small class="text-muted">(กรุณากรอกรหัสบัตรประจำตัวประชาชน 13 หลัก)</small>
                            </label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="id_card" placeholder="กรอกรหัสบัตรประจำตัวประชาชน 13 หลัก" maxlength="13" required pattern="^\d{13}$" title="กรุณากรอกเฉพาะตัวเลข 13 หลัก" inputmode="numeric" oninput="validateIdCard(this)">
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

<script>
    function generateCredentials() {
        // รับค่าชื่อภาษาอังกฤษและวันเกิด
        const dob = document.getElementById('date_of_birth').value;

        if (!dob) {
            alert('กรุณากรอกวันเดือนปีเกิดก่อนสร้างรหัสผ่าน');
            return;
        }

        // สร้างรหัสผ่านในรูปแบบ CB-<วันเดือนปีเกิด>
        const password = `${dob.replace(/-/g, '')}`;

        document.getElementById('password').value = password;
    }

    function validateIdCard(input) {
        // กรองเฉพาะตัวเลข
        input.value = input.value.replace(/[^0-9]/g, '');
    }

</script>
