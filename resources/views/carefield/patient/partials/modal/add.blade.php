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