<div class="question-block mb-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-semibold text-primary">โรคเบาหวาน</h5>
        <p class="text-muted mb-0">กรุณากรอกข้อมูลเกี่ยวกับโรคเบาหวาน</p>
    </div>

    <div class="card border p-3 rounded-lg shadow-sm">
        <!-- สถานะโรคเบาหวาน -->
        {{-- <div class="form-group mb-3">
            <label for="diabetes_status" class="form-label">สถานะโรคเบาหวาน:</label>
            <select name="diabetes_status" id="diabetes_status" class="form-control" required>
                <option value="" disabled selected>กรุณาเลือกสถานะ</option>
                <option value="diabetic">Diabetic (ผู้ป่วยโรคเบาหวาน)</option>
                <option value="non_diabetic">Non-Diabetic (ไม่เป็นโรคเบาหวาน)</option>
            </select>
        </div> --}}

        <!-- ค่า FPG -->
        <div class="form-group mb-3">
            <label for="fpg" class="form-label">ค่า FPG (Fasting Plasma Glucose):</label>
            <input type="number" name="fpg" id="fpg" class="form-control" placeholder="กรุณากรอกค่า FPG เช่น 80, 120" min="0" step="any">
            <small class="text-muted">กรอกค่าระดับน้ำตาลในเลือดหลังงดอาหารอย่างน้อย 8 ชั่วโมง (ค่าปกติ: 70–100 mg/dL)</small>
        </div>

        <!-- ค่า Random Glucose -->
        <div class="form-group mb-3">
            <label for="random_glucose" class="form-label">ค่า Random Glucose:</label>
            <input type="number" name="random_glucose" id="random_glucose" class="form-control" placeholder="กรุณากรอกค่า Random Glucose เช่น 140, 200" min="0" step="any">
            <small class="text-muted">กรอกค่าระดับน้ำตาลในเลือดที่วัดแบบสุ่ม (ค่าปกติ: ต่ำกว่า 140 mg/dL)</small>
        </div>
    </div>
</div>
