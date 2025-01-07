<div class="question-block mb-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-semibold text-primary">ความดันโลหิตสูง</h5>
        <p class="text-muted mb-0">กรุณากรอกข้อมูลเกี่ยวกับความดันโลหิตที่ตรวจได้</p>
    </div>
    
    <div class="card border p-3 rounded-lg shadow-sm">
       <!-- สถานะความดันโลหิตสูง -->
        {{-- <div class="form-group mb-4">
            <label for="hypertension_status" class="form-label">สถานะความดันโลหิตสูง:</label>
            <select name="hypertension_status" id="hypertension_status" class="form-select form-control-lg" required>
                <option value="high">สูง</option>
                <option value="normal">ปกติ</option>
            </select>
        </div> --}}

        <!-- SBP (Systolic Blood Pressure) -->
        <div class="form-group mb-4">
            <label for="sbp" class="form-label">SBP (Systolic Blood Pressure):</label>
            <input type="number" name="sbp" id="sbp" class="form-control form-control-lg" placeholder="กรอกค่า SBP" min="0" step="any">
        </div>

        <!-- DBP (Diastolic Blood Pressure) -->
        <div class="form-group mb-4">
            <label for="dbp" class="form-label">DBP (Diastolic Blood Pressure):</label>
            <input type="number" name="dbp" id="dbp" class="form-control form-control-lg" placeholder="กรอกค่า DBP" min="0" step="any">
        </div>

        <p class="text-center text-info mt-3">การตรวจความดันโลหิตเป็นส่วนหนึ่งของการดูแลสุขภาพผู้สูงอายุอย่างดี ควรตรวจอย่างสม่ำเสมอและมีการปรับปรุงสุขภาพตามคำแนะนำของแพทย์</p>
    </div>
</div>
